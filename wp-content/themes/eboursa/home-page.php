<?php 
/**
 * Template name: Main page
 */
 ?>
<?= render_template_part("template-parts/head") ?>
<body <?php body_class()  ?>>  
    <div class="page-block">
    <?php get_header() ?>    
    
    <div id="primary" class="content-area">
        <main id="main" class="site-main" role="main">          
            <div class="container">
                <?php if (have_posts()) { ?>
                    <?php while (have_posts()) { ?>
                        <?php the_post() ?>
                        <article>
                            <?php the_content() ?> 
                        </article>
                    <?php } ?>
                <?php } else { ?>
                    There is no content
                <?php } ?>
            </div>
        </main>
    </div>

    <?php get_footer() ?>
    </div>
    <?php get_template_part('template-parts/modal'); ?>
    <?php wp_footer() ?>
</body>