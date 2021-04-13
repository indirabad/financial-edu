<?php
/* ENV */
if (!defined("ENV")) {
    define("ENV", "dev");
}





/* Settings */
if (ENV === "dev") {
    define("WP_SCSS_ALWAYS_RECOMPILE", true);
}





/* Core autoload */
spl_autoload_register(function($class) {
    $prefix = "App";
    $baseDir = __DIR__ . "/Core/";
    $length = strlen($prefix);
    
    if (strncmp($prefix, $class, $length) !== 0) {
        return;
    }

    $relativeClass = substr($class, $length);
    $file = $baseDir . str_replace("\\", "/", $relativeClass) . ".php";
    
    if (file_exists($file)) {
        require $file;
    }
});





/* Session */
$startSession = function() { 
    if (!session_id()) {
        session_start();
    }
};
$endSession = function() { 
    session_destroy();
};
add_action("init", $startSession, 1);
add_action("wp_logout", $endSession);
add_action("wp_login", $endSession);





/* Version */
if (!function_exists("getThemeVersion")) { 
    function getThemeVersion() {
        if (!defined("ENV") || ENV === "dev") {
            return uniqid();
        }

        $themeFile = __DIR__ . "/style.css";
        $theme = new \WP_Theme(basename(dirname($themeFile)), dirname(dirname($themeFile)));

        return $theme->get("Version");
    }
}





/* Functions */
if (!function_exists("group")) { 
    function group(array $elements, callable $getUniqueKey) {
        $grouped = [];
        
        foreach ($elements as $element) {
            $uniqueKeys = (array)$getUniqueKey($element);
            foreach ($uniqueKeys as $uniqueKey) {
                $grouped[$uniqueKey][] = $element;
            }
        }
        
        return $grouped;
    }
}

if (!function_exists("set_query_vars")) { 
    function set_query_vars(array $vars) {
        foreach ($vars as $name=>$value) {
            set_query_var($name, $value);
        }
    }
}

if (!function_exists("create_link")) { 
    function create_link($path=null, array $params = []) {
        $path = is_null($path) ? str_replace("?{$_SERVER['QUERY_STRING']}", "", $_SERVER['REQUEST_URI']) : $path;
        parse_str($_SERVER['QUERY_STRING'], $query);
        $query = array_merge($query, $params);
        
        foreach ($query as $i=>$param) {
            if (empty($param)) {
                unset($query[$i]);
            }
        }
        
        return empty($query) ? $path : $path. "?" . http_build_query($query);   
    }
}

if (!function_exists("get_current_url")) { 
    function get_current_url(array $parts = ["protocol", "host", "requestUri", "queryString"]) {
        $protocol = isset($_SERVER['HTTPS']) && strcasecmp($_SERVER['HTTPS'], "off") ? "https://" : "http://";
        $host = isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : (isset($_SERVER['SERVER_NAME']) ? $_SERVER['SERVER_NAME'] : "");
        $requestUri = $_SERVER['REQUEST_URI'];
        $queryString = !empty($_SERVER['QUERY_STRING']) ? "?" . $_SERVER['QUERY_STRING'] : null;
        $values = compact("protocol", "host", "requestUri", "queryString");

        $url = "";
        foreach ($parts as $part) {
            if (array_key_exists($part, $values)) {
                $url .= $values[$part];
            }
        }
        
        return $url;
    }
}

if (!function_exists("render_template_part")) { 
    function render_template_part($part, array $vars=[]) {
        set_query_vars($vars);
        ob_start();
        get_template_part($part); 
        return ob_get_clean();    
    }
}

if (!function_exists("search_posts")) { 
    function search_posts($typed=null) {
        if (is_null($typed)) {
            global $query_string;
            wp_parse_str($query_string, $typed);            
        }        
        return (new WP_Query($typed))->posts;
    }
}





/* Assets */
add_filter("clean_url", function($url) {
    if (strpos($url, "#asyncload") === false) {
        return $url;
    } else if (is_admin()) {
        return str_replace("#asyncload", "", $url);
    } else {
        return str_replace("#asyncload", "", $url) . "' async='async"; 
    }
}, 11, 1);

add_filter("clean_url", function($url) {
    if (strpos($url, "#deferload") === false) {
        return $url;
    } else if (is_admin()) {
        return str_replace("#deferload", "", $url);
    } else {
        return str_replace("#deferload", "", $url) . "' defer='defer"; 
    }
}, 11, 1);

add_action("wp_enqueue_scripts", function() {
    wp_enqueue_style("font-awesome-style", "https://use.fontawesome.com/releases/v5.12.1/css/all.css", [], "5.12.1");
    wp_enqueue_style("bootstrap-style", "https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css", [], "4.4.1");
    wp_enqueue_style("roboto-font-style", "https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap", [], "");
    wp_enqueue_style("source-sans-font-style", "https://fonts.googleapis.com/css2?family=Source+Sans+Pro&display=swapSource Sans", [], "");
 /*   wp_enqueue_script("theme-main", get_stylesheet_directory_uri() . "/assets/css/main.css", [], getThemeVersion());*/
    wp_enqueue_style("customer-style", get_stylesheet_directory_uri() . "/assets/css/main.css", []);

    wp_enqueue_script('gtag', 'https://www.googletagmanager.com/gtag/js?id=UA-171563954-1#asyncload', [], getThemeVersion(), true);

    wp_enqueue_script('popper', 'https://unpkg.com/popper.js@1.15.0/dist/umd/popper.min.js', [], "1.15.0", true);
    wp_enqueue_script("bootstrap", "https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js", [], "4.4.1", true);   
    wp_enqueue_script("theme-analytics",  get_template_directory_uri() . "/assets/js/analytics.js", ["gtag"], getThemeVersion(), true);
    wp_enqueue_script("theme-common",  get_template_directory_uri() . "/assets/js/common.js", ["jquery", "bootstrap"], getThemeVersion(), true);
    
    /* Move all scripts to footer */
    if (!is_admin()) {
        remove_action("wp_head", "wp_print_scripts"); 
        remove_action("wp_head", "wp_print_head_scripts", 9); 
        remove_action("wp_head", "wp_enqueue_scripts", 1);

        add_action("wp_footer", "wp_print_scripts", 5);
        add_action("wp_footer", "wp_enqueue_scripts", 5);
        add_action("wp_footer", "wp_print_head_scripts", 5); 
    }
});

/* Use latest verion of JQuery */
if (!is_admin()) {
    wp_deregister_script("jquery"); 
    wp_register_script("jquery", "https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js", [], "3.4.1", true); 
    wp_enqueue_script("jquery");
}

/* Disable the emoji's */
add_action("init", function() {
    remove_action("wp_head", "print_emoji_detection_script", 7);
    remove_action("admin_print_scripts", "print_emoji_detection_script");
    remove_action("wp_print_styles", "print_emoji_styles");
    remove_action("admin_print_styles", "print_emoji_styles");    
    remove_filter("the_content_feed", "wp_staticize_emoji");
    remove_filter("comment_text_rss", "wp_staticize_emoji");  
    remove_filter("wp_mail", "wp_staticize_emoji_for_email");
});

/* Remove Gutenberg Block Library CSS from loading on the frontend */
add_action("wp_enqueue_scripts", function() { 
    wp_dequeue_style("wp-block-library");
    wp_dequeue_style("wp-block-library-theme");
});





/* Menu */
add_action("init", function() {
	register_nav_menus([
        'top-menu' => __("Top Menu"),
        'footer-menu' => __("Footer Menu")
    ]);
});





/* Theme Сapabilities */
add_theme_support("post-thumbnails"); 





/* Sidebars */
add_action("widgets_init", function() {
    register_sidebar([
        'id' => "footer_bottom_text",
        'name' => "Footer Bottom Text",
        'description' => "Used for footer widget area",
        'before_widget' => "",
        'after_widget' => "",
        'before_title' => "<span class='hidden'>",
        'after_title' => "</span>",
    ]);

    /* Widgets */
    register_widget('\App\Widgets\SocialWidget');
});





add_shortcode("template-part", function($attr) {
    if (empty($attr['page'])) {
        return "";
    }

    return render_template_part($attr['page']);
});

/* Mailchimp */
\App\Mailchimp::init();
