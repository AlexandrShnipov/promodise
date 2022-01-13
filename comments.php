<?php

if (post_password_required()) {
  return;
}
?>

<div id="comments" class="comments my-4">

  <?php
  // You can start editing here -- including this comment!
  if (have_comments()) :
  ?>
    <h3 class="mb-5">Комментарии:</h3>

    <?php the_comments_navigation(); ?>

    <div class="comment-list p-0">
      <?php
      wp_list_comments(
        array(
          'walker'            => new Bootstrap_Walker_Comment(), // какой шаблон использовать для коментов
          'max_depth'         => '2',    // максимальная вложенность
          'style'             => 'ol', // во что оборачиваем комменты
          // 'callback'          => null, // какая функция будет отрисовывать комменты
          // 'end-callback'      => null, // какая функция будет отрисовывать конец комментов
          'type'              => 'all',
          'reply_text'        => __('Reply' , 'alexander_shnipov') . '<i class="fa fa-reply"></i>',
          // 'page'              => '', // к какой странице коментарий
          'per_page'          => '10', //коментариев на странице, далее появятся перелистывания
          'avatar_size'       => 80,
          'format'            => 'html5', // или xhtml, если HTML5 не поддерживается темой
          'echo'              => true,     // true или false
        )
      );
      ?>
      </в><!-- .comment-list -->

      <?php
      the_comments_navigation();

      // If comments are closed and there are comments, let's leave a little note, shall we?
      if (!comments_open()) :
      ?>
        <p class="no-comments"><?php esc_html_e('Comments are closed.', 'word'); ?></p>
    <?php
      endif;

    endif; // Check for have_comments().

    $defaults = [
      'fields'               => [
        'author' => '<div class="row"><div class="col-lg-6 mb-3">
					<input class="form-control" id="author" name="author" type="text" value="' . esc_attr($commenter['comment_author']) . '" size="30" placeholder="Имя"/>
		</div>',

        'email'  => '<div class="col-lg-6">
             <input id="email" name="email" class="form-control" type="email" value="' . esc_attr($commenter['comment_author_email']) . '" size="30" aria-describedby="email-notes" placeholder="E-mail"/>
      </div></div>',

        'cookies' => '<p class="comment-form-cookies-consent">' .
          '<input id="wp-comment-cookies-consent" name="wp-comment-cookies-consent" type="checkbox" value="yes"%s />', '
      <label class="label" for="wp-comment-cookies-consent">' . __('Save my name, email, and website in this browser for the next time I comment.', 'alexander_shnipov') . '</label>
   </p>',
      ],

      'comment_field'        => '<div class="comment-form-comment mb-3">
           <textarea class="form-control" id="comment" name="comment" cols="45" rows="8"  aria-required="true" required="required" placeholder="Комментарий"></textarea>
    </div>',

      'must_log_in'          => '<p class="must-log-in">' .
        sprintf(esc_html__('You need <a href="%s">to come in</a> to leave a comment.', 'alexander_shnipov'), wp_login_url(apply_filters('the_permalink', get_permalink($post->ID)))) . '
     </p>',

      'logged_in_as'         => '<p class="logged-in-as">' .
        sprintf(__('<a href="%1$s" aria-label="You are logged in as">You are logged in as %2$s</a>. <a href="%3$s">Log off?</a>', 'alexander_shnipov'), get_edit_user_link(), $user_identity, wp_logout_url(apply_filters('the_permalink', get_permalink()))) . '
     </p>',

      'comment_notes_before' => '<p class="comment-notes">
      <span id="email-notes">' . __('Your E-mail is protected from spam', 'alexander_shnipov') . '</span>
    </p>',

      'comment_notes_after'  => '',
      'id_form'              => 'commentform',
      'id_submit'            => 'submit',
      'class_form'           => 'comment-form',
      'class_submit'         => 'btn btn-hero btn-circled',
      'name_submit'          => 'submit',
      'title_reply'          => __('Leave a comment', 'alexander_shnipov'),
      'title_reply_to'       => esc_html__('Reply %s', 'alexander_shnipov'),
      'title_reply_before'   => '<h3 id="reply-title" class="comment-reply-title">',
      'title_reply_after'    => '</h3>',
      'cancel_reply_before'  => ' <small>',
      'cancel_reply_after'   => '</small>',
      'cancel_reply_link'    => __('Cancel sending', 'alexander_shnipov'),
      'label_submit'         => __('Send a comment', 'alexander_shnipov'),
      'submit_button'        => '<button name="%1$s" type="submit" id="%2$s" class="%3$s"> %4$s</button>',
      'submit_field'         => '<p class="form-submit">%1$s %2$s</p>',
      'format'               => 'xhtml5',
    ];

    comment_form($defaults);
    ?>

    </div><!-- #comments -->

