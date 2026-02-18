<div class="page-sidebar">
    <nav id="site-navigation" class="main-navigation navbar navbar-expand-lg">
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <div>
                <?php
                    wp_nav_menu(
                        array(
                            'theme_location' => 'menu-1',
                            'menu_id'        => 'primary-menu',
                        )
                    );
                ?>

                <div class="legal-box">
                    <img src="<?php echo get_template_directory_uri(); ?>/img/18.png" class="label-18" width="40px">
                    <div class="text">
                        Interdit aux moins de 18 ans
                    </div>
                </div>
            </div>

            <div>
                <img src="<?php echo get_stylesheet_directory_uri() . '/img/PRINT.png' ?>" alt="gold" class="d-none d-lg-block mt-4 mx-auto sidebar-img" width="178px" height="119px" style="margin: 0 auto">
            </div>
        </div>
    </nav><!-- #site-navigation -->
</div>