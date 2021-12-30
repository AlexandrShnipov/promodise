<?php get_header(); ?>

<!--MAIN BANNER AREA START -->
<div class="banner-area banner-3">
  <div class="overlay dark-overlay"></div>
  <div class="d-table">
    <div class="d-table-cell">
      <div class="container">
        <div class="row">
          <div class="col-lg-8 m-auto text-center col-sm-12 col-md-12">
            <div class="banner-content content-padding">
              <h5 class="subtitle">
                <?php the_field('subtitle', $post->ID); ?>
              </h5>
              <h1 class="banner-title">
                <?php the_field('title', $post->ID); ?>
              </h1>
              <p>
                <?php the_field('banner-description', $post->ID); ?>
              </p>

              <a href="/contact" class="btn btn-white btn-circled"><?php the_field('banner-link', $post->ID);?></a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!--MAIN HEADER AREA END -->

<!-- ! php -->
<section class="section-padding" id="intro">
  <div class="container">
    <?php the_content(); ?>
  </div>
</section>
<!-- php -->

<!--  SERVICE AREA START  -->
<section id="about" class="bg-light">
  <div class="about-bg-img d-none d-lg-block d-md-block"></div>
  <div class="container">
    <div class="row">
      <div class="col-lg-7 col-sm-12 col-md-8">
        <div class="about-content">
          <h5 class="subtitle"><?php the_field('about-title', $post->ID);?></h5>
          <h3><?php the_field('about-subtitle', $post->ID);?></h3>
          <p>
          <?php the_field('about-text', $post->ID);?>
          </p>

          <ul class="about-list">
            <li><i class="icofont icofont-check-circled"></i> Адаптивный</li>
            <li><i class="icofont icofont-check-circled"> </i> С анимацией</li>
            <li><i class="icofont icofont-check-circled"> </i> С чистым кодом</li>
            <li><i class="icofont icofont-check-circled"> </i> Готовый к использованию</li>
            <li><i class="icofont icofont-check-circled"> </i> Настроенный под SEO</li>
            <li><i class="icofont icofont-check-circled"></i> Кроссбраузерный</li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</section>
<!--  SERVICE AREA END  -->

<!--  SERVICE  -->
<?php echo get_template_part('template-parts/content', 'service', ['class' => 'bg-feature', 'custom_title' => 'Наши услуги']); ?>
<!--  SERVICE  -->

<!-- PRICE AREA START  -->
<?php echo get_template_part('template-parts/content', 'price', ['custom_title' => 'Доступные тарифы для вас', 'custom_text' => 'Подберите тот, который подходит вам больше всего']); ?>
<!-- PRICE AREA END  -->

<?php echo get_template_part('template-parts/content', 'testimonial', ['custom_title' => 'Клиенты, которые доверяют нам', 'custom_text' => 'Ниже представлены отзывы от клиентов, с которыми<br />
            мы работаем уже несколько лет подряд']); ?>

<?php echo get_template_part('template-parts/content', 'partners'); ?>

<!--  BLOG AREA START  -->
<section id="blog" class="section-padding bg-main">
  <div class="container">
    <div class="row">
      <div class="col-lg-12 col-sm-12 m-auto">
        <div class="section-heading">
          <h4 class="section-title"><?php the_field('journal-title', $post->ID);?></h4>
          <div class="line"></div>
          <p>
          <?php the_field('journal-text', $post->ID);?>
          </p>
        </div>
      </div>
    </div>

    <div class="row">

      <?php
      global $post;

      $query = new WP_Query([
        'posts_per_page' => 3,
        'poast_type' => 'post'
      ]);

      if ($query->have_posts()) {
        while ($query->have_posts()) {
          $query->the_post();
      ?>
          <!-- Вывода постов, функции цикла: the_title() и т.д. -->
          <div class="col-lg-4 col-sm-6 col-md-4">
            <div class="blog-block">
              <?php
              //должно находится внутри цикла
              if (has_post_thumbnail()) {
                the_post_thumbnail(
                  'post-thumbnail',
                  array(
                    'class' => "img-fluid w-100"
                  )
                );
              } else {
                echo '<img class="mg-fluid w-100" src="' . get_template_directory_uri() . '/images/blog/dummy.jpg"/>';
              }
              ?>

              <div class="blog-text">
                <h6 class="author-name"><span>

                    <?php $category = get_the_category();
                    echo $category[0]->name; ?>

                  </span><?php the_author(); ?></h6>
                <a href="<?php echo get_the_permalink(); ?>" class="h5 my-2 d-inline-block"> <?php the_title(); ?> </a>
                <p><? the_excerpt(); ?></p>
              </div>
            </div>
          </div>
      <?php
        }
      } else {
        // Постов не найдено
      }

      wp_reset_postdata(); // Сбрасываем $post
      ?>
    </div>
  </div>
</section>
<!--  BLOG AREA END  -->
<!--  COUNTER AREA START  -->
<section id="counter" class="section-padding">
  <div class="overlay dark-overlay"></div>
  <div class="container">
    <div class="row">
      <div class="col-lg-3 col-sm-6 col-md-6">
        <div class="counter-stat">
          <i class="icofont icofont-heart"></i>
          <span class="counter"><?php the_field('clients', $post->ID); ?></span>
          <h5>счастливых клиентов</h5>
        </div>
      </div>
      <div class="col-lg-3 col-sm-6 col-md-6">
        <div class="counter-stat">
          <i class="icofont icofont-rocket"></i>
          <span class="counter"><?php the_field('done-projects', $post->ID); ?></span>
          <h5>выполненных проектов</h5>
        </div>
      </div>
      <div class="col-lg-3 col-sm-6 col-md-6">
        <div class="counter-stat">
          <i class="icofont icofont-hand-power"></i>
          <span class="counter"><?php the_field('team', $post->ID); ?></span>
          <h5>людей в команде</h5>
        </div>
      </div>
      <div class="col-lg-3 col-sm-6 col-md-6">
        <div class="counter-stat">
          <i class="icofont icofont-shield-alt"></i>
          <span class="counter"><?php the_field('current-project', $post->ID); ?></span>
          <h5>Проектов в работе</h5>
        </div>
      </div>
    </div>
  </div>
  
</section>
<div class="row mt-5 mb-5">
  <div class="container">
  <h4 class="section-title"><?php the_field('contacts', $post->ID); ?></h4>
      <?php echo do_shortcode( '[contact-form-7 id="643" title="Виджет формы"]')?>
  </div>

</div>

<!--  COUNTER AREA END  -->

<?php get_footer(); ?>