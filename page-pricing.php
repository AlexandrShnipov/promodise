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
<section id="testimonial" class="section-padding">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-8 text-center">
        <div class="mb-5">
          <h3 class="mb-2">Клиенты, которые доверяют нам</h3>
          <p>
            Ниже представлены отзывы от клиентов, с которыми<br />
            мы работаем уже несколько лет подряд
          </p>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-lg-8 m-auto col-sm-12 col-md-12">
        <div class="carousel slide" id="test-carousel2">
          <div class="carousel-inner">
            <ol class="carousel-indicators">
              <li data-target="#test-carousel2" data-slide-to="0" class="active"></li>
              <li data-target="#test-carousel2" data-slide-to="1"></li>
              <li data-target="#test-carousel2" data-slide-to="2"></li>
            </ol>

            <div class="carousel-item active">
              <div class="row">
                <div class="col-lg-12 col-sm-12">
                  <div class="testimonial-content style-2">
                    <div class="author-info">
                      <div class="author-img">
                        <img src="images/author/3b.jpg" alt="" class="img-fluid" />
                      </div>
                    </div>

                    <p>
                      <i class="icofont icofont-quote-left"></i>Это отличная платформа для тех, кто хочет начать
                      бизнес, но не может принять правильное решение. Это действительно отличное место для того,
                      чтобы начать свой бизнес правильно! <i class="icofont icofont-quote-right"></i>
                    </p>
                    <div class="author-text">
                      <h5>Рыбаков Виталий</h5>
                      <p>Старший инженер</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="carousel-item">
              <div class="row">
                <div class="col-lg-12 col-sm-12">
                  <div class="testimonial-content style-2">
                    <div class="author-info">
                      <div class="author-img">
                        <img src="images/author/5b.jpg" alt="" class="img-fluid" />
                      </div>
                    </div>

                    <p>
                      <i class="icofont icofont-quote-left"></i>Это отличная платформа для тех, кто хочет начать
                      бизнес, но не может принять правильное решение. Это действительно отличное место для того,
                      чтобы начать свой бизнес правильно! <i class="icofont icofont-quote-right"></i>
                    </p>
                    <div class="author-text">
                      <h5>Вострецов Денис</h5>
                      <p>Маркетолог</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!--  ITEM END  -->

            <div class="carousel-item">
              <div class="row">
                <div class="col-lg-12 col-sm-12">
                  <div class="testimonial-content style-2">
                    <div class="author-info">
                      <div class="author-img">
                        <img src="images/author/3b.jpg" alt="" class="img-fluid" />
                      </div>
                    </div>

                    <p>
                      <i class="icofont icofont-quote-left"></i>Это отличная платформа для тех, кто хочет начать
                      бизнес, но не может принять правильное решение. Это действительно отличное место для того,
                      чтобы начать свой бизнес правильно! <i class="icofont icofont-quote-right"></i>
                    </p>
                    <div class="author-text">
                      <h5>Киренков Алексей</h5>
                      <p>Младший менеджер</p>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!--  ITEM END  -->
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!--  TESTIMONIAL AREA END  -->
<!--  PARTNER START  -->
<section class="section-padding">
  <div class="container">
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