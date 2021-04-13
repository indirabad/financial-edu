<?php
namespace App;

class Mailchimp extends AbstractComponent
{
    public static function getAjaxActions()
    {
        return [
            [
                'name' => 'mailchimp_subscription',
                'callback' => ['\App\Mailchimp', 'ajaxMailchimpSubscription'],
                'adminOnly' => false
            ],
        ];
    }

    public static function init()
    {
        self::registerAjaxActions();

        add_action('wp_enqueue_scripts', function() {
            wp_enqueue_script("theme-subscribe",  get_template_directory_uri() . "/assets/js/subscribe.js", ["jquery"], getThemeVersion(), true);
        });
        
        // Mailchimp API Key Setting Field
        self::addSettingField('Mailchimp API Key', 'mailchimp_api_key', ['\App\Mailchimp', 'renderApiKeySettingField']);

        // Mailchimp Subscribe List Id Setting Field
        self::addSettingField('Mailchimp Subscribe List Id', 'mailchimp_subscribe_list', ['\App\Mailchimp', 'renderSubscribeListIdSettingField']);
    }

    public static function renderApiKeySettingField($info)
    {
        echo render_template_part('template-parts/admin/mailchimp-api-key', [
            'info' => $info
        ]);
    }

    public static function renderSubscribeListIdSettingField($info)
    {
        echo render_template_part('template-parts/admin/mailchimp-subscribe-list-id', [
            'info' => $info
        ]);
    }

    public static function ajaxMailchimpSubscription()
    {
        if(empty($_POST['email'])) {
            return false;
        }

        try {
            \App\Library\Mailchimp::subscribe($_POST['email'], null, !empty($_POST['name']) && $_POST['name'] !== 'undefined' ? $_POST['name'] : null, null, get_option('mailchimp_subscribe_list'));
        }
        catch(\Throwable $e) {
            $errorMessage = $e->getMessage();
            $mailchimpErrorMessage = json_decode($errorMessage);

            if(json_last_error() === JSON_ERROR_NONE) {
                $errorMessage = $mailchimpErrorMessage->detail;
            }

            return [
                'exception' => $errorMessage,
                'message' => 'Internal Error',
                'result' => 0
            ];
        }

        return true;
    }
}
