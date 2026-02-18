<?php
$query_args = array(
    'post_type'      => 'betting',
    'post_status'    => 'publish',
    'posts_per_page' => -1,
    'order'          => 'ASC',
);

$bet_query = new WP_Query($query_args);
$items = $bet_query->posts;
?>

<section class="section section-list-loop">
    <div class="list-wrapp">
        <div class="list-items">
            <div class="row">
                <div class="col-md-12">
                    <?php foreach ($items as $k => $item) {
                        $k++;
                        $post_id = $item->ID;
                        $post_title = $item->post_title;
                        $url = get_field('offer_url', $post_id);
                        $badge = get_field('offer_badge', $post_id);
                        $subtitle = get_field('offer_sub_title', $post_id);
                        $description = get_field('offer_description', $post_id);
                        $score = get_field('rating_score', $post_id);
                        $offer_options = get_field('offer_options', $post_id);
                        $payment_methods = get_field('payment_methods', $post_id);
                        $payment_methods_mob = get_field('payment_methods_mobile', $post_id);
                        $button_label = get_field('button_label', $post_id);
                    ?>
                        <!-- ITEM -->
                        <div class="list-item">
                            <div class="row">
                                <!-- THIS WILL ONLY BE SEEN ON MOBILE  -->
                                <div class="col-12 mode-mobile-content">
                                    <div class="row mobile-justify-between">
                                        <div class="col-6 d-flex">
                                            <div class="badge d-lg-block content-text-nouve">
                                                <span><?= $badge ?></span>
                                            </div>
                                        </div>
                                        <div class="col-6 d-flex justify-content-lg-center justify-content-end">
                                            <?php if (! empty($score)) { ?>
                                                <div class="d-flex flex-column align-items-center circle-mobile">
                                                    <div class="rating-circle">
                                                        <span class="rating-number"><?= $score ?></span>
                                                    </div>
                                                    <div class="rating-label">Évaluation</div>
                                                </div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                                <!-- END THIS WILL ONLY BE SEEN ON MOBILE  -->

                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mode-desk-content">
                                    <div class="badge d-lg-block content-text-nouve">
                                        <span class=""><?= $badge ?></span>
                                    </div>
                                </div>
                                <div class="col-md-12 padding-content-home-banner">
                                    <div class="row">
                                    <div class="col-lg-2 col-md-12 col-sm-12 col-xs-12 content-banner-number content-items-1">
                                    <span class="number"><?= $k ?></span>
                                    <div class="img-wrapp">
                                        <a href="<?= $url ? $url : '#' ?>" target="_blank">
                                            <?php echo get_the_post_thumbnail($post_id); ?>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-12 col-sm-12 col-xs-12 content-items-2">
                                    <div class="item-description">
                                        <div class="title"><span class="text-white"><?= $post_title ?></span></div>
                                            <?= $description ?>
                                            <span class="bonus-bienvenue">Bonus de Bienvenue</span>
                                    </div>
                                </div>
                                <div class="col-lg-1 col-md-12 col-sm-12 col-xs-12 content-items-3 mode-desk-content">
                                    <?php if (! empty($score)) { ?>
                                        <div class="d-flex flex-column align-items-center justify-content-center gap-1">
                                            <div class="rating-circle">
                                                <span class="rating-number"><?= $score ?></span>
                                            </div>
                                            <div class="rating-label">Évaluation</div>
                                        </div>
                                    <?php } ?>
                                </div>

                                <div class="col-lg-2 col-md-12 col-sm-12 content-items-4 d-flex justify-content-center">
                                    <div class="row">
                                        <!-- PRIMER ÍTEM -->
                                        <div class="col-12 mb-2 content-justify-4">
                                            <span class="d-inline-flex align-items-center check-text" style="gap: 8px;">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" style="color: #FFDA71;" fill="currentColor" class="bi bi-check-circle" viewBox="0 0 16 16">
                                                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16" />
                                                    <path d="m10.97 4.97-.02.022-3.473 4.425-2.093-2.094a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05" />
                                                </svg>
                                                1er Pari Remboursé
                                            </span>
                                        </div>

                                        <!-- SEGUNDO ÍTEM -->
                                        <div class="col-6 col-lg-12 mb-2 content-justify-4">
                                            <span class="d-inline-flex align-items-center check-text" style="gap: 8px;">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" style="color: #FFDA71;" fill="currentColor" class="bi bi-check-circle" viewBox="0 0 16 16">
                                                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16" />
                                                    <path d="m10.97 4.97-.02.022-3.473 4.425-2.093-2.094a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05" />
                                                </svg>
                                                1er Site de Paris
                                            </span>
                                        </div>

                                        <!-- TERCER ÍTEM -->
                                        <div class="col-6 col-lg-12 mb-2 content-justify-4">
                                            <span class="d-inline-flex align-items-center check-text" style="gap: 8px;">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" style="color: #FFDA71;" fill="currentColor" class="bi bi-check-circle" viewBox="0 0 16 16">
                                                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16" />
                                                    <path d="m10.97 4.97-.02.022-3.473 4.425-2.093-2.094a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05" />
                                                </svg>
                                                Programme VIP
                                            </span>
                                        </div>
                                    </div>
                                </div>


                                <div class="col-lg-3 col-md-12 col-sm-12 col-xs-12 button-bonus content-items-5">
                                    <a href="<?= $url ?>" class="btn-action-new" target="_blank">
                                        <span>OBTENEZ LE BONUS</span>
                                    </a>
                                    <div class="paiment-opt">
                                        <!-- REMOVE IMAGE, NEW UX TEMPLATE -->
                                        <a href="<?= $url ?>" target="_blank" class="link-site-web">Aller au site Web
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" style="margin-left: 5px;" fill="currentColor" class="bi bi-arrow-right" viewBox="0 0 16 16">
                                                <path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8" />
                                            </svg>
                                        </a>
                                        <!-- <img src="<?= $payment_methods_mob['url'] ?>" alt="" width="220px" height="31px"> -->
                                    </div>
                                </div>
                                    </div>
                                </div>



                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <!-- END ITEM -->
                                    <div class="legal-operator">
                                        <img src="<?php echo get_template_directory_uri(); ?>/img/img-flag/France.png" alt="France Flag" class="flag-img">
                                        <span>Opérateur légal en France</span>
                                    </div>
                                </div>
                            </div>

                        </div>

                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</section>