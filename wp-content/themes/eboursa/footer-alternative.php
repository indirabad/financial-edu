<footer class="footer-wrapper app-footer">	 
    <div class="footer-nav">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-5">
                    <div class="footer-items group-flex group-end-md group-column-xs">
                        <div class="group-wrapper">
                            <div class="select-language">
                                <div class="dropdown">
                                    <a class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <div class="language-flag"></div>
                                        <svg class="icon arrow-down">
                                            <use xlink:href="<?= get_template_directory_uri() ?>/assets/img/main-icon.svg#arrow-down"></use>
                                        </svg>
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item" href="<?php echo site_url(); ?>/en/join/">
                                        <div class="language-flag">
                                            <img src="<?= get_template_directory_uri() ?>/assets/img/flag/EN-flag.svg">
                                        </div>
                                        <span>English</span>
                                    </a>
                                     <a class="dropdown-item" href="<?php echo site_url(); ?>/ar/join/">
                                        <div class="language-flag">
                                            <img src="<?= get_template_directory_uri() ?>/assets/img/flag/AE-flag.svg">
                                        </div>
                                        <span>
                                            العربية
                                        </span>
                                    </a>
                                </div>
                                </div>
                            </div>
                            <?php dynamic_sidebar('footer_bottom_text'); ?>
    					</div>

    					<div class="footer-email">
                            <a class="grey-link" href="mailto:info@eboursa.com">info@eboursa.com </a>
                        </div>
    				</div>
    			</div>
	    		<div class="col-lg-7">
	    			<div class="footer-items group-flex group-right group-end-md group-left-xs group-column-xs">
	    				<div class="footer-menu">
	    					<ul>
	    						<li><a href="<?php echo site_url(); ?>/en/terms-and-conditions/">Terms and Conditions</a></li>
	    						<li><a href="<?php echo site_url(); ?>/en/privacy-policy/">Privacy policy</a></li>
	    					</ul>
	    				</div>
<!--	    				<div class="group-flex">-->
<!--	    					<a class="btn btn-default btn-app" href="#">-->
<!--	    						<div class="btn-app-icon">-->
<!--	    							<img src="--><?//= get_template_directory_uri() ?><!--/assets/img/google-play-white.svg" alt="">-->
<!--	    						</div>-->
<!--	    						<div class="btn-app-body">-->
<!--	    							<div class="btn-app-text text-upper">get it on</div>-->
<!--	    							<div class="btn-app-title">Google Play</div>-->
<!--	    						</div>-->
<!--	    					</a>-->
<!--	    					<a class="btn btn-default btn-app" href="#">-->
<!--	    						<div class="btn-app-icon">-->
<!--	    							<img src="--><?//= get_template_directory_uri() ?><!--/assets/img/apple-icon.svg" alt="">-->
<!--	    						</div>-->
<!--	    						<div class="btn-app-body">-->
<!--	    							<div class="btn-app-text">Download on the</div>-->
<!--	    							<div class="btn-app-title">App Store</div>-->
<!--	    						</div>-->
<!--	    					</a>  					-->
<!--	    				</div>-->
	    			</div>
	    		</div>
            </div>
        </div>
    </div>
    <div class="copyright-wrapper text-center">Copyright &copy;&nbsp; <?php echo date('Y'); ?> eBoursa. All rights reserved.</div>
</footer>

<div class="modal fade eBoursa-modal" id="eBoursaModal" tabindex="-1" role="dialog" aria-labelledby="eBoursaModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <svg class="icon icon-close">
                        <use xlink:href="<?= get_template_directory_uri() ?>/assets/img/main-icon.svg#icon-close"></use>
                    </svg>
                </button>
            </div>
            <div class="modal-body text-center">
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
</div>
<div class="modal fade eBoursa-modal" id="eBoursaModalMobile" tabindex="-1" role="dialog" aria-labelledby="eBoursaModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <svg class="icon icon-close">
                        <use xlink:href="<?= get_template_directory_uri() ?>/assets/img/main-icon.svg#icon-close"></use>
                    </svg>
                </button>
            </div>
            <div class="modal-body text-center">
                <div class="form-wrapper">
                   <form class="app-subscribe-form">
                        <img src="<?= get_template_directory_uri() ?>/assets/img/eBoursa.svg" alt="">
                        <p>eBoursa is launching soon! Join the waitlist to get early access to an investment platform designed to seamlessly invest your money.</p>
                        <input type="email" name="email" class="form-control form-input" aria-describedby="email" placeholder="Enter email address">
                        <button type="submit" class="btn btn-primary btn-xl">Get Early Access</button>
                        <span class="error" style="display: none;"></span>
                        <span class="success" style="display: none;"></span>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>