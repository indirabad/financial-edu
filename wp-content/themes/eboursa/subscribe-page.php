<?php 
/**
 * Template name: Subscribe form page
 */
 ?>
<?= render_template_part("template-parts/head") ?>
<body <?php body_class()  ?>>  
    <div class="page-block">
    <?php get_header('alternative') ?>    
    
    <div id="primary" class="content-area">
        <main id="main" class="site-main" role="main"> 
            <div class="page-wrapper subscribe-page">
                <div class="container">
                    <div class="row justify-content-center text-center">
                        <div class="form-wrapper">
                            <form class="app-subscribe-form">
                                <img src="<?= get_template_directory_uri() ?>/assets/img/eBoursa.svg" alt="">
                                <p>eBoursa is launching soon! Join the waitlist to get early access to an investment platform designed to seamlessly invest your money.</p>
                                <div class="form-input-area">
                                    <input type="email" name="email" class="form-control form-input" aria-describedby="email" placeholder="Enter email address">
                                    <button type="submit" class="btn btn-primary btn-xl">Get Early Access</button>
                                    <span class="error" style="display: none;"></span>
                                    <span class="success" style="display: none;"></span>
                                </div>
                            </form>
                        </div>
                    </div>                    
                </div>
            </div> 
        </main>
    </div>

    <?php get_footer('alternative') ?>
    </div>
    <?php get_template_part('template-parts/modal'); ?>
    <?php wp_footer() ?>
</body>