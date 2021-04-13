<!DOCTYPE html>
<html <?php language_attributes() ?> class="no-js" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="<?php bloginfo("charset") ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php is_front_page() ? bloginfo("description") : wp_title("") ?></title>
    <link rel="icon" type="image/png" sizes="16x16" href="<?= get_template_directory_uri() ?>/assets/img/favicons/favicon.svg">
    <?php wp_head() ?>
</head>
