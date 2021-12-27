<?php get_header(); ?>

<!--MAIN BANNER AREA START -->
<div class="page-banner-area page-contact" id="page-banner">
  <div class="overlay dark-overlay"></div>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-8 m-auto text-center col-sm-12 col-md-12">
        <div class="banner-content content-padding">
          <h1 class="text-white"><?php the_title(); ?></h1>
          <p><?php echo get_post_meta($post->ID, 'subtitle', true); ?></p>
        </div>
      </div>
    </div>
  </div>
</div>
<!--MAIN HEADER AREA END -->
<!-- PRICE AREA START  -->

      <?php echo get_template_part( 'template-parts/content', 'price', ['custom_title' => 'Доступные тарифы для вас', 'custom_text' => 'Подберите тот, который подходит вам больше всего']);?>

<!-- PRICE AREA END  -->

<!--  TESTIMONIAL AREA START  -->
<?php echo get_template_part('template-parts/content', 'testimonial', ['custom_title' => 'Клиенты, которые доверяют нам', 'custom_text' => 'Ниже представлены отзывы от клиентов, с которыми<br />
            мы работаем уже несколько лет подряд']); ?>
<!--  TESTIMONIAL AREA END  -->

<!--  PARTNER START  -->
<?php echo get_template_part('template-parts/content', 'partners'); ?>
<!--  PARTNER END  -->

<?php get_footer(); ?>