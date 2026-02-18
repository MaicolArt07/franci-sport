<?php
get_header();
$casino_name = get_field('casino_name');
?>

<main id="primary" class="site-main">
  <div class="page-container">
    <div class="container padding-content">

      <?php
      // Verificamos si la página actual es 'safe-betting'
      if (is_page('safe-betting')) {
        // Aquí va el contenido personalizado solo para safe-betting
      ?>
        <div class="hero-container">
          <img src="<?php echo get_template_directory_uri(); ?>/img/Hero-banner.png" alt="" class="hero-img">
          <div class="hero-text">
            <h1 class="title-box-wrapper-pbt-h1">
              <?php
              if ($casino_name) {
                echo esc_html($casino_name);
              } else {
                echo "CASINO_NAME"; 
              }
              ?>
              <br>
              L’Expérience Complète des Paris Sportifs
            </h1>
            <!-- <p>Découvrez les meilleures cotes et bonus <br> pour vos paris sportifs.</p> -->
          </div>
        </div>

        <section style="margin-top: 2rem;">
          <?php
          include get_template_directory() . '/page/safe-betting/safe-betting.php';
          ?>
        </section>
      <?php
      } else if (is_page('ligue-1')) {
        // Aquí va el contenido personalizado solo para safe-betting
      ?>
        <div class="hero-container">
          <img src="<?php echo get_template_directory_uri(); ?>/img/Hero-banner.png" alt="" class="hero-img">
          <div class="hero-text">
            <h1>
              Paris Sportifs
            </h1>
            <h1>
              <?= $casino_name ?> Offres Spéciales
            </h1>
          </div>
        </div>

        <section style="margin-top: 2rem;">
          <?php
          include get_template_directory() . '/page/ligue-1/ligue-1.php';
          ?>
        </section>
      <?php
      } else if (is_page('premiere-league')) {
        // Aquí va el contenido personalizado solo para safe-betting
      ?>
        <div class="hero-container">
          <img src="<?php echo get_template_directory_uri(); ?>/img/Hero-banner.png" alt="" class="hero-img">
          <div class="hero-text">
            <h1>
              Paris Sportifs
            </h1>
            <h1>
              <?= $casino_name ?> Offres Spéciales
            </h1>
          </div>
        </div>

        <section style="margin-top: 2rem;">
          <?php
          include get_template_directory() . '/page/premiare-league/premiare-league.php';
          ?>
        </section>
      <?php
      } else if (is_front_page()) {
        // Código para todas las demás páginas, el original
      ?>
        <div class="hero-container">
          <img src="<?php echo get_template_directory_uri(); ?>/img/Hero-banner.png" alt="" class="hero-img">

          <div class="hero-text">
            <h1>Offres Spéciales <br> Paris Sportifs</h1>
            <p>Découvrez les meilleures cotes et bonus <br> pour vos paris sportifs.</p>
          </div>
        </div>

        <?php
        $top_header_options = get_field('top_header', 'option');
        if ($top_header_options) { ?>
          <!-- <div class="header-top">
              <?= $top_header_options; ?>
            </div> -->
        <?php } ?>

        <?php
        while (have_posts()) :
          the_post();

          get_template_part('template-parts/content', 'page');

        endwhile; // End of the loop.
        ?>
      <?php
      } else if (is_page('termes-et-conditions')) 
      {
        ?>
          <section style="margin-top: 2rem;">
            <?php
            include get_template_directory() . '/page/conditions/conditions.php';
            ?>
          </section>
      <?php
      }else if (is_page('jeu-responsable')) 
      {
        ?>
          <section style="margin-top: 2rem;">
            <?php
            include get_template_directory() . '/page/jeu-responsable/jeu-responsable.php';
            ?>
          </section>
      <?php
      }else if (is_page('termes-et-conditions')) 
      {
        ?>
          <section style="margin-top: 2rem;">
            <?php
            include get_template_directory() . '/page/conditions/conditions.php';
            ?>
          </section>
      <?php
      }else if (is_page('donnees-personnelles')) 
      {
        ?>
          <section style="margin-top: 2rem;">
            <?php
            include get_template_directory() . '/page/donnees-personnelles/donnees-personnelles.php';
            ?>
          </section>
      <?php
      }else if (is_page('anj-2')) 
      {
        ?>
          <section style="margin-top: 2rem;">
            <?php
            include get_template_directory() . '/page/anj/anj.php';
            ?>
          </section>
      <?php
      }else if (is_page('contactez-nous')) 
      {
          include get_template_directory() . '/page/form/contact-form.php';
      }
      ?>


    </div>
  </div>
</main>

<?php get_footer(); ?>