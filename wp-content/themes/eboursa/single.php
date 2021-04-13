<?= render_template_part("template-parts/head") ?>
<body <?php body_class() ?>>
    <?php get_header() ?>
    
    <div class="blog-single">
        <div class="main-container">
            <?php while (have_posts()) { ?>
                <?php the_post() ?>
                <?php if (!empty(get_the_post_thumbnail_url($post->ID))) { ?>
                    <div class="post-thumbnail-image" style="background-image:url('<?= get_the_post_thumbnail_url($post->ID) ?>')"></div>
                <?php } else { ?> 
                    <div class="post-thumbnail-image-empty post-thumbnail-image"></div>
                <?php }  ?> 
                <div class="post-head"> 
                    <div class="post-content-box content-box">                   
                        <h1 class="post-title"><?php the_title() ?></h1>
                        <div class="post-head-excerpt">
                            <?php the_excerpt() ?>
                        </div>
                        <div class="post-head-date">
                            <?= date("M j, Y", strtotime($post->post_date)) ?>
                        </div>
                    </div>
                </div>
                <div class="container">
                    <div class="post-single-wrapper">
                        <div class="content post-single-content">
                            <?php the_content() ?>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
    
    <?php get_footer() ?>
    <?php wp_footer() ?>
</body>
</html>
