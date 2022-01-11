<?php get_header(); ?>
<!--MAIN BANNER AREA START -->
<div class="page-banner-area page-contact" id="page-banner">
  <div class="overlay dark-overlay"></div>
  <div class="container">
    <div class="row">
      <div class="col-lg-8 col-sm-12 col-md-12">
        <div class="banner-content content-padding">

          <!-- заголовок результатов поиска -->
          <h1 class="text-white">
            <?php printf(esc_html__('Результаты поиска по&nbsp;фразе: %s', 'alexander_shnipov'), '<span>' . get_search_query() . '</span>'); ?>
          </h1>
          <!-- заголовок результатов поиска -->

        </div>
      </div>
    </div>
  </div>
</div>
<!--MAIN HEADER AREA END -->

<section class="section blog-wrap ">
  <div class="container">
    <div class="row">
      <div class="col-lg-8">

        <!--цикл WP поста блога -->
        <div class="row">

          <!-- php -->
          <?php $cnt = 0; // объявляем счетчик постов
          if (have_posts()) : while (have_posts()) : the_post(); // проеверяем есть ли посты
              $cnt++; // увеличиваем счетчик на +1
              switch ($cnt) { // выводим для третьего поста стр.32
                case '3': ?>
                  <div class="col-lg-12">
                    <div class="blog-post">

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

                      <div class="mt-4 mb-3 d-flex">
                        <div class="post-author mr-3">
                          <i class="fa fa-user"></i>
                          <span class="h6 text-uppercase"><?php the_author(); ?></span>
                        </div>

                        <div class="post-info">
                          <i class="fa fa-calendar-check"></i>
                          <span><?php the_time('j F Y'); ?></span>
                        </div>
                      </div>
                      <a href="<?php echo get_the_permalink(); ?>" class="h4 "><?php the_title(); ?></a>
                      <p class="mt-3"><?php the_excerpt(); ?></p>
                      <a href="<?php echo get_the_permalink(); ?>" class="read-more">Читать статью <i class="fa fa-angle-right"></i></a>
                    </div>
                  </div>
                <?php
                  break; // останавливаем счетчик при выполнении условия и см. ниже - в остальных случаях

                default: ?>
                  <div class="col-lg-6">
                    <div class="blog-post">

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

                      <div class="mt-4 mb-3 d-flex">
                        <div class="post-author mr-3">
                          <i class="fa fa-user"></i>
                          <span class="h6 text-uppercase"><?php the_author(); ?></span>
                        </div>

                        <div class="post-info">
                          <i class="fa fa-calendar-check"></i>
                          <span><?php the_time('j F Y'); ?></span>
                        </div>
                      </div>
                      <a href="<?php echo get_the_permalink(); ?>" class="h4 "><?php the_title(); ?></a>
                      <p class="mt-3"><?php the_excerpt(); ?></p>
                      <a href="<?php echo get_the_permalink(); ?>" class="read-more">Читать статью <i class="fa fa-angle-right"></i></a>
                    </div>
                  </div>
            <?php break; // при выполнении останавливаем счетчик
              }
            endwhile;
          else : ?>
            Записей нет.
          <?php endif; ?>

          <!-- пагинация -->
          <div class="col-lg-12 mb-3">
            <?php the_posts_pagination(array(
              'prev_text'    => __('<span class="p-2 border">« Предыдущие посты</span> ', 'alexander_shnipov'),
              'next_text'    => __('<span class="p-2 border">Следующие посты »</span> ', 'alexander_shnipov'),
              'before_page_number' => '<span class="p-2 border">',
              'after_page_number'  => '</span>',
            )); ?>
          </div>
          <!-- пагинация -->
          <!-- php -->
        </div>
        <!--цикл WP поста блога -->

      </div>
      <div class="col-lg-4">
        <div class="row">
          <div class="col-lg-12">
            <!-- php -->
            <?php if (!dynamic_sidebar('sidebar-blog')) : ?>
              <?php dynamic_sidebar('sidebar-blog'); ?>
            <?php endif; ?>
            <!-- php -->
          </div>

        </div>
      </div>
    </div>
  </div>
  </div>
</section>
<?php get_footer(); ?>