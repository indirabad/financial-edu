<?= render_template_part("template-parts/head") ?>
<body  <?php body_class(); ?>>    
    <?php get_header() ?>
    
    <div id="primary" class="content-area">
        <main id="main" class="site-main" role="main">
            <div class="container">
                <div class="boxed-content-padding text-center">
                    <h2 class="">
                        Error 404
                    </h2>
                    <p>Sorry, the page you were looking for at this URL was not found. </p>
                </div>
            </div>
        </main>
    </div>

    <?php get_footer() ?>
    <?php wp_footer() ?>
</body>
</html>
