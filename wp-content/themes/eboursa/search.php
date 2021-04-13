<?php
/*
Template Name: Search Page
*/
$posts = search_posts();
?>
<?= render_template_part("template-parts/head") ?>
<body <?php body_class()  ?>>    
    <?php get_header() ?>
    
    <main id="main" class="site-main" role="main">
        <?php get_search_form() ?>
        <div>
            <?php if (!empty($posts)) { ?>
                <?php global $post ?>
                <?php foreach (search_posts() as $post) { ?>
                    <?php setup_postdata($post) ?>
                    <a href="<?php the_permalink() ?>">                        
                        <?php the_title() ?>
                    </a>
                <?php } ?>
                <?php wp_reset_postdata() ?>               
            <?php } else { ?>
                <p>Nothing found :(</p>
            <?php } ?>
        </div>
    </main>

    <?php get_footer() ?>
    <?php wp_footer() ?>
</body>
</html>
