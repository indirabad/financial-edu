<div class="footer-social">
    <ul class="social-networks">
        <?php if(!empty($instance['facebook'])) { ?>
            <li>
                <a target="_blank" href="<?= $instance['facebook'] ?>">
                    <svg class="icon icon-facebook">
                        <use xlink:href="<?= get_template_directory_uri() ?>/assets/img/main-icon.svg#icon-facebook"></use>
                    </svg>  
                </a>
            </li>
        <?php } ?>
        <?php if(!empty($instance['linked-in'])) { ?>
            <li>
                <a target="_blank" href="<?= $instance['linked-in'] ?>">
                    <svg class="icon icon-linkedin">
                        <use xlink:href="<?= get_template_directory_uri() ?>/assets/img/main-icon.svg#icon-linkedin"></use>
                    </svg> 
                </a>
            </li>
        <?php } ?>
        <?php if(!empty($instance['twitter'])) { ?>
            <li>
                <a target="_blank" href="<?= $instance['twitter'] ?>">
                    <svg class="icon icon-twitter">
                        <use xlink:href="<?= get_template_directory_uri() ?>/assets/img/main-icon.svg#icon-twitter"></use>
                    </svg> 
                </a>
            </li>
        <?php } ?>
        <?php if(!empty($instance['instagram'])) { ?>
            <li>
                <a target="_blank" href="<?= $instance['instagram'] ?>">
                    <svg class="icon icon-instagram">
                        <use xlink:href="<?= get_template_directory_uri() ?>/assets/img/main-icon.svg#icon-instagram"></use>
                    </svg> 
                </a>
            </li>
        <?php } ?>
    </ul>
</div>