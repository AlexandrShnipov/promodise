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
              <h5 class="subtitle bg-danger">
                <?php
                echo __('error 404', 'alexander_shnipov');
                ?>
              </h5>
              <h1 class="banner-title">
                <?php
                echo __('This page','alexander_shnipov') ?>
                <br />
                <?php
                echo __('doesn&nbsp;exist', 'alexander_shnipov');
                ?>
              </h1>
              <p>
                <?php
                echo __('  You are trying to access a page that does not exist. Perhaps it used to be at this address, but now we have moved it to a new location. Try to find the information you need in the search. Or go to the main page.', 'alexander_shnipov');
                ?>

              </p>

              <?php the_widget('WP_Widget_Search'); ?>

              <a href="/" class="btn btn-white btn-circled">
                <?php
                echo __('Go to main page', 'alexander_shnipov');
                ?>
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!--MAIN HEADER AREA END -->

<?php get_footer() ?>