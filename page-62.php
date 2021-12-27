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

<?php echo get_template_part( 'template-parts/content', 'partners', ['class' => 'service-style-two','custom_title' => 'Эти компании доверяют нам', 'custom_text' => 'Компании, с которыми мы работаем давно']);?>


<?php get_footer(); ?>