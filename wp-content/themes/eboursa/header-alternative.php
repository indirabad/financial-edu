<header class="header-wrapper app-header">
    <div class="header-main">
    	<div class="container-fluid">
    		<div class="row">
    			<div class="col-5">
    				<div class="header-logo">
    					<a href="/"><img src="<?= get_template_directory_uri() ?>/assets/img/eboursa-logo.svg" alt=""></a>
    				</div>
    			</div>
    			<div class="col-7">
    				<div class="group-flex justify-content-end">
<!--    					<a class="btn btn-black btn-app" href="#">-->
<!--    						<div class="btn-app-icon">-->
<!--    							<img src="--><?//= get_template_directory_uri() ?><!--/assets/img/google-play-icon.svg" alt="">-->
<!--    						</div>-->
<!--    						<div class="btn-app-body">-->
<!--    							<div class="btn-app-text text-upper">get it on</div>-->
<!--    							<div class="btn-app-title">Google Play</div>-->
<!--    						</div>-->
<!--    					</a>-->
<!--    					<a class="btn btn-black btn-app" href="#">-->
<!--    						<div class="btn-app-icon">-->
<!--    							<img src="--><?//= get_template_directory_uri() ?><!--/assets/img/apple-icon.svg" alt="">-->
<!--    						</div>-->
<!--    						<div class="btn-app-body">-->
<!--    							<div class="btn-app-text">Download on the</div>-->
<!--    							<div class="btn-app-title">App Store</div>-->
<!--    						</div>-->
<!--    					</a> -->
    					<div class="select-language">
                            <div class="dropdown">
                                <a class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <div class="language-flag">
                                    </div>
                                    <svg class="icon arrow-down">
                                        <use xlink:href="<?= get_template_directory_uri() ?>/assets/img/main-icon.svg#arrow-down"></use>
                                    </svg>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
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
                                        <span>العربية</span>
                                    </a>
                                </div>
                            </div>
                        </div> 					
    				</div>
    			</div>    			
    		</div>    		
    	</div>
    </div>
</header>