<?php get_header(); ?>

<!--MAIN BANNER AREA START -->
<div class="page-banner-area page-contact" id="contact">
  <div class="overlay dark-overlay"></div>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-lg-8 m-auto text-center col-sm-12 col-md-12">
        <div class="banner-content content-padding">
          <h1 class="text-white">Давайте обсудим работу над&nbsp;вашим проектом</h1>
          <p>Напишите нам и вам ответит проектный менеджер</p>
        </div>
      </div>
    </div>
  </div>
</div>
<!--MAIN HEADER AREA END -->
<!--  Contact START  -->
<section class="section-padding">
  <div class="container">
    <div class="row">
      <div class="col-lg-6 col-sm-12 col-md-12">
        <div class="mb-5">
          <h2 class="mb-2">Напишите нам</h2>
          <p>
            Обычно, мы видим заявку сразу, а перезваниваем или пишем в ответ в течение часа. Иногда ответ может
            занять до одного дня.
          </p>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-7 col-sm-12">
      <?php echo do_shortcode( '[contact-form-7 id="643" title="Виджет формы"]')?>
      </div>

      <div class="col-lg-5 pl-4 mt-4 mt-lg-0">
        <h4>Адрес офиса</h4>
        <address class="mb-3"><?php the_field('address', get_the_ID());?></address>
        <h4>Телефон</h4>
        <p class="mb-3"><?php the_field('phone', get_the_ID());?></p>
        <h4>E-Mail</h4>
        <p class="mb-3"><?php the_field('email', get_the_ID());?></p>
      </div>
    </div>
  </div>
</section>
<!--  CONTACT END  -->

<!--  Map START  -->
<?php the_content();?>
<!--   Map END  -->

<?php get_footer(); ?>