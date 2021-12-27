<!--  PARTNER START  -->
<section class="section-padding">
  <div class="container">
    <div class="row">
      <div class="col-lg-8 text-center text-lg-left">
        <div class="mb-5">
          <h3 class="mb-2">
            <?php if (!empty($args['custom_title'])) {
              echo $args['custom_title'];
            } else echo NULL; ?>
          </h3>
          <p>
            <?php if (!empty($args['custom_text'])) {
              echo $args['custom_text'];
            } else echo NULL; ?>

          </p>
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