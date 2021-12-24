<?php get_header(); ?>

<!--MAIN BANNER AREA START -->
<div class="page-banner-area page-service" id="page-banner">
  <div class="overlay dark-overlay"></div>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-8 m-auto text-center col-sm-12 col-md-12">
        <div class="banner-content content-padding">
          <h1 class="text-white"><?php the_title(); ?></h1>
          <p> <?php echo get_post_meta($post->ID, 'subtitle', true); ?></p>
        </div>
      </div>
    </div>
  </div>
</div>
<!--MAIN HEADER AREA END -->
<div class="container">
  <?php the_content(); ?>
</div>

<?php echo get_template_part( 'template-parts/content', 'service', ['class' => 'service-style-two','custom_title' => 'Диджитал Полного Цикла']);?>

<!--  PARTNER START  -->
<section class="section-padding">
  <div class="container">
    <div class="row">
      <div class="col-lg-8 text-center text-lg-left">
        <div class="mb-5">
          <h3 class="mb-2"><?php echo get_post_meta($post->ID, 'subtitle_partners', true); ?></h3>
          <p><?php echo get_post_meta($post->ID, 'partners_text', true); ?></p>
        </div>
      </div>
    </div>
    <div class="row">

      <?php
      global $post;
      $query = new WP_Query([
        'posts_per_page' => 9,
        'post_type'      => 'partners',
      ]);

      if ($query->have_posts()) {
        while ($query->have_posts()) {
          $query->the_post();
      ?>
          <div class="col-lg-3 col-sm-6 col-md-3 text-center">
            <img src="<?php echo the_post_thumbnail_url(); ?>" alt="partner" class="img-fluid" />
          </div>
        <?php
        }
      } else {
        // Постов не найдено
        ?>
        <p>Партнеров пока нет</p>
      <?php
      }
      wp_reset_postdata(); // Сбрасываем $post
      ?>

    </div>
  </div>
</section>
<!--  PARTNER END  -->

<?php get_footer(); ?>