<?php
namespace App;

abstract class AbstractComponent
{
    public static function registerAjaxActions()
    {
        foreach (static::getAjaxActions() as $action) {
            $handler = function() use ($action) { 
                error_reporting(0);
                header("Content-Type: application/json");
                $response = ['result'=>0, 'data'=>null, 'message'=>null]; 
                               
                try {
                    $actionResponse = call_user_func($action['callback']);              
                    if (is_array($actionResponse) && array_key_exists("result", $actionResponse)) {
                        $response = array_merge($response, $actionResponse);
                    } else {
                        $response['data'] = $actionResponse;
                        $response['result'] = 1;    
                        $response['message'] = "Success";       
                        if (is_array($actionResponse) && array_key_exists("message", $actionResponse)) {
                            $response['message'] = $actionResponse['message'];
                        }
                    }
                } catch (\App\Exception\AjaxException $e) {
                    $response['message'] = $e->getMessage();
                    $response['result'] = 0;
                } catch (\Throwable $e) {
                    $response['message'] = "Internal Error";
                    $response['exception'] = $e->getMessage() . "; file: " . $e->getFile() . "; line: " . $e->getLine(); // Only for DEV Mode
                    $response['result'] = 0;
                } finally  {
                    die(json_encode($response));
                }
            };
        
            add_action("wp_ajax_{$action['name']}", $handler);            
            if (!$action['adminOnly']) {
                add_action("wp_ajax_nopriv_{$action['name']}", $handler);
            }
        }
    }
    
    
    
    
    
    
    public static function addMetabox($postTypes, $fieldName, $title, $template, $context="advanced", $dataType="single")
    {
        $renderFunction = is_callable($template) 
            ? $template
            : function() use ($fieldName, $template) {
                global $post;
                set_query_vars(compact("post", "fieldName"));
                get_template_part($template);
            }
        ;
        
        add_action("add_meta_boxes", function() use ($postTypes, $fieldName, $title, $renderFunction, $context) {
            global $post;            

            if (in_array($post->post_type, $postTypes)) {            
                add_meta_box($fieldName, $title, $renderFunction, null,$context);
            }
        });
        
        add_action("save_post", function($postId) use ($postTypes, $fieldName, $dataType) {
            $post = get_post($postId);

            if(empty($_GET['action']) || !in_array($_GET['action'], ['trash', 'untrash'])) {
                if (in_array($post->post_type, $postTypes)) {
                    switch ($dataType) {
                        case "list":                         
                            $value = array_key_exists($fieldName, $_POST) ? implode(",", $_POST[$fieldName]): "";
                            update_post_meta($postId, $fieldName, $value);
                            break;
                        
                        case "single":
                            $value = array_key_exists($fieldName, $_POST) ? $_POST[$fieldName]: "";
                            update_post_meta($postId, $fieldName, $value);
                            break;     
                        
                        case "temporary":       
                        default: 
                            // Do nothing
                            break;
                    }
                } 
            }
        });         
    }
    
    
    public static function saveSettings(array $settings)
    {
        foreach ($settings as $settingName=>$settingValue) {
            update_option($settingName, $settingValue);
        }
    }

    public static function addSettingField($fieldName, $fieldSlug, $template, $screen = 'general')
    {
        $renderFunction = is_callable($template) 
            ? $template
            : function() use ($info) {
                global $post;
                set_query_vars(compact("info"));
                get_template_part($template);
            }
        ;

        add_action('admin_menu', function() use ($fieldName, $fieldSlug, $renderFunction, $screen) {
            $optionId = $fieldSlug . '-id';

            register_setting($screen, $fieldSlug);
            add_settings_field( 
                $optionId, 
                $fieldName, 
                $renderFunction, 
                $screen, 
                'default', 
                [
                    'id' => $optionId,
                    'option_name' => $fieldSlug
                ]
            );
        });
    }
}
