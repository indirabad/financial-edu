<?= render_template_part("template-parts/head") ?>
<body <?php body_class()  ?>>    
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
    <?php wp_footer() ?>
</body>
