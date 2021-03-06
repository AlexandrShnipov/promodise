<?php

if (!function_exists('alexander_shnipov_setup')) {
  function alexander_shnipov_setup()
  {

    load_theme_textdomain( 'alexander_shnipov', get_template_directory() . '/languages' );

    // !добавляем пользовательский логотип
    add_theme_support('custom-logo', [
      'height'      => 50,
      'width'       => 130,
      'flex-width'  => false,
      'flex-height' => false,
      'header-text' => '',
      'unlink-homepage-logo' => false, // WP 5.5
    ]);

    //! добаляется свой класс в HTML
    add_filter('get_custom_logo', 'change_logo_class');
    function change_logo_class($classes)
    {
      //  $html = str_replace('class="custom-logo"', 'class="navbar-brand"', $html);
      $classes = str_replace('class="custom-logo-link"', 'class="navbar-brand"', $classes);
      return $classes;
    }
    // !

    // ! подключаем поддержку HTML5 тегов
    add_theme_support('html5', array(
      'comment-list',
      'comment-form',
      'search-form',
      'gallery',
      'caption',
      'script',
      'style',
    ));

    // ! добавляем динамический <title>
    add_theme_support('title-tag');

    // включаем миниатюры для постов из страниц (картинки)
    add_theme_support('post-thumbnails');
    set_post_thumbnail_size(730, 480, true); // размер миниатюры поста по умолчани

  }

  add_action('after_setup_theme', 'alexander_shnipov_setup');
}

// ! Создание новой роли
//Удаляем роль при деактивации нашей темы
add_action( 'switch_theme', 'deactivate_my_theme' );
function deactivate_my_theme() {
	remove_role( 'project_manager' );
}

//Добавляем роль при активации нашей темы
add_action( 'after_switch_theme', 'activate_my_theme' );
function activate_my_theme() {
  $author = get_role( 'author' );
	add_role( 'project_manager', 'Менеджер', $author->capabilities
		// [
		// 	'read'         => true,  // true разрешает эту возможность
		// 	'edit_posts'   => false,  // true разрешает редактировать посты
    //   'edit_dashboard'   => false,  // true разрешает редактировать посты
		// 	'upload_files' => true,  // может загружать файлы
    //   'publish_posts' => true,  // может публиковать посты
		// ]
	);

  $administrator = get_role( 'administrator' );
	add_role( 'developer', 'Разработчик', $administrator->capabilities	
	);
}

//! подключение стилей и скриптов

add_action('wp_enqueue_scripts', 'alexander_shnipov_scripts');

function alexander_shnipov_scripts()
{
  wp_enqueue_style('main', get_stylesheet_uri());



  // подключаем bootstrap
  wp_enqueue_style('bootstrap', get_template_directory_uri() . '/plugins/bootstrap/css/bootstrap.css', array('main'), null);

  //  подключаем fontawesome
  wp_enqueue_style('fontawesome', get_template_directory_uri() . '/plugins/fontawesome/css/all.css', array('main'), null);

  //  подключаем animate
  wp_enqueue_style('animate', get_template_directory_uri() . '/plugins/animate-css/animate.css', array('main'), null);

  //  подключаем icofont
  wp_enqueue_style('icofont', get_template_directory_uri() . '/plugins/icofont/icofont.css', array('main'), null);

  // подключаем основные стили
  wp_enqueue_style('alexander-shnipov', get_template_directory_uri() . '/css/style.css', array('icofont'), null);

  //! переподключаем jQuery
  wp_deregister_script('jquery');
  wp_register_script('jquery', get_template_directory_uri() . '/plugins/jquery/jquery.min.js');
  wp_enqueue_script('jquery');

  // pooper
  wp_enqueue_script('popper', get_template_directory_uri() . '/plugins/bootstrap/js/popper.min.js', array('jquery'), '1.0.0', true);

  // bootstrap
  wp_enqueue_script('bootstrap', get_template_directory_uri() . '/plugins/bootstrap/js/bootstrap.min.js', array('jquery'), '1.0.0', true);

  //  wow
  wp_enqueue_script('wow', get_template_directory_uri() . '/plugins/counterup/wow.min.js', array('jquery'), '1.0.0', true);

  // easing
  wp_enqueue_script('easing', get_template_directory_uri() . '/plugins/counterup/jquery.easing.1.3.js', array('jquery'), '1.0.0', true);

  // waypoints
  wp_enqueue_script('waypoints', get_template_directory_uri() . '/plugins/counterup/jquery.waypoints.js', array('jquery'), '1.0.0', true);

  // counterup
  wp_enqueue_script('counterup', get_template_directory_uri() . '/plugins/counterup/jquery.counterup.min.js', array('jquery'), '1.0.0', true);

  // google-map
  wp_enqueue_script('google-map', get_template_directory_uri() . '/plugins/google-map/gmap3.min.js', array('jquery'), '1.0.0', true);

  // contact
  wp_enqueue_script('contact', get_template_directory_uri() . '/plugins/form/contact.js', array('jquery'), '1.0.0', true);

  // custom
  wp_enqueue_script('custom', get_template_directory_uri() . '/js/custom.js', array('jquery'), '1.0.0', true);
}

// ! регистрируем несколько областей меню
function alexander_shnipov_menus()
{

  $locations = array(

    // собираем несколько зон (областей ) меню 
    'header'   => __('Header Menu', 'alexander_shnipov'),
    'footer_left'   => __('Footer Left Menu', 'alexander_shnipov'),
    'footer_right'   => __('Footer Right Menu', 'alexander_shnipov'),
  );

  // регистрируем области меню, которые лежат в переменной $locations
  register_nav_menus($locations);
}
// хук событие
add_action('init', 'alexander_shnipov_menus');

//! добавить класс к пунктам меню
// add_filter( 'nav_menu_css_class', 'custom_nav_menu_css_class', 10, 1);
// function custom_nav_menu_css_class($classes){
//   $classes[] = 'nav-item';
//   return $classes;
// }

// ! повесить на все ссылки класс
// add_filter( 'nav_menu_link_attributes', 'custom_nav_menu_link_attributes', 10, 1 );
// function custom_nav_menu_link_attributes ($atts) {
//   $atts['class'] = 'nav-link';
//   return $atts;
// }


// menu Bootstrap
class bootstrap_4_walker_nav_menu extends Walker_Nav_menu
{

  function start_lvl(&$output, $depth = 0, $args = array())
  { // ul
    $indent = str_repeat("\t", $depth); // indents the outputted HTML
    $submenu = ($depth > 0) ? ' sub-menu' : '';
    $output .= "\n$indent<ul class=\"dropdown-menu$submenu depth_$depth\">\n";
  }

  function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0)
  { // li a span

    $indent = ($depth) ? str_repeat("\t", $depth) : '';

    $li_attributes = '';
    $class_names = $value = '';

    $classes = empty($item->classes) ? array() : (array) $item->classes;

    $classes[] = ($args->walker->has_children) ? 'dropdown' : '';
    $classes[] = ($item->current || $item->current_item_anchestor) ? 'active' : '';
    $classes[] = 'nav-item';
    $classes[] = 'nav-item-' . $item->ID;
    if ($depth && $args->walker->has_children) {
      $classes[] = 'dropdown-menu';
    }

    $class_names =  join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item, $args));
    $class_names = ' class="' . esc_attr($class_names) . '"';

    $id = apply_filters('nav_menu_item_id', 'menu-item-' . $item->ID, $item, $args);
    $id = strlen($id) ? ' id="' . esc_attr($id) . '"' : '';

    $output .= $indent . '<li ' . $id . $value . $class_names . $li_attributes . '>';

    $attributes = !empty($item->attr_title) ? ' title="' . esc_attr($item->attr_title) . '"' : '';
    $attributes .= !empty($item->target) ? ' target="' . esc_attr($item->target) . '"' : '';
    $attributes .= !empty($item->xfn) ? ' rel="' . esc_attr($item->xfn) . '"' : '';
    $attributes .= !empty($item->url) ? ' href="' . esc_attr($item->url) . '"' : '';

    $attributes .= ($args->walker->has_children) ? ' class="nav-link dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"' : ' class="nav-link"';

    $item_output = $args->before;
    $item_output .= ($depth > 0) ? '<a class="dropdown-item"' . $attributes . '>' : '<a' . $attributes . '>';
    $item_output .= $args->link_before . apply_filters('the_title', $item->title, $item->ID) . $args->link_after;
    $item_output .= '</a>';
    $item_output .= $args->after;

    $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
  }
}

// ! отключаем создание миниатюр файлов для указанных размеров
add_filter('intermediate_image_sizes', 'delete_intermediate_image_sizes');
function delete_intermediate_image_sizes($sizes)
{
  // размеры которые нужно удалить
  return array_diff($sizes, [
    'medium_large',
    'large',
    '1536x1536',
    '2048x2048',
  ]);
}

// ! выводим пагинацию
the_posts_pagination(array(
  'end_size' => 2,
));

// ! удаляет H2 из шаблона пагинации
add_filter('navigation_markup_template', 'my_navigation_template', 10, 2);
function my_navigation_template($template, $class)
{

  return '
	<nav class="navigation %1$s" role="navigation">
		<div class="nav-links">%3$s</div>
	</nav>    
	';
}

// ! сайдбар
add_action('widgets_init', 'alexander_shnipov_widgets_init');
function alexander_shnipov_widgets_init()
{
  register_sidebar(array(
    'name'          => esc_html__('Blog sidebar', 'alexander_shnipov'),
    'id'            => "sidebar-blog",
    'before_widget' => '<section id="%1$s" class="sidebar-widget %2$s">',
    'after_widget'  => '</section>',
    'before_title'  => '<h5 class="widget-title mb-3">',
    'after_title'   => '</h5>'
  ));

  register_sidebar(array(
    'name'          => esc_html__('Footer text', 'alexander_shnipov'),
    'id'            => "sidebar-footer-text",
    'before_widget' => '<div class="footer-widget footer-link %2$s">',
    'after_widget'  => '</div>',
    'before_title'  => '<h4>',
    'after_title'   => '</h4>'
  ));

  register_sidebar(array(
    'name'          => esc_html__('Contacts in the footer', 'alexander_shnipov'),
    'id'            => "sidebar-footer-contacts",
    'before_widget' => '<div class="footer-widget footer-text %2$s">',
    'after_widget'  => '</div>',
    'before_title'  => '<h4>',
    'after_title'   => '</h4>'
  ));
}

/**
 * ! Добавление нового виджета Download_Widget.
 */
class Download_Widget extends WP_Widget
{

  // Регистрация виджета используя основной класс
  function __construct()
  {
    // вызов конструктора выглядит так:
    // __construct( $id_base, $name, $widget_options = array(), $control_options = array() )
    parent::__construct(
      'download_widget', // ID виджета, если не указать (оставить ''), то ID будет равен названию класса в нижнем регистре: download_widget
      'Полезные файлы',
      array('description' => 'Прикрепите ссылки на полезные файлы', 'classname' => 'download',)
    );

    // скрипты/стили виджета, только если он активен
    if (is_active_widget(false, false, $this->id_base) || is_customize_preview()) {
      add_action('wp_enqueue_scripts', array($this, 'add_download_widget_scripts'));
      add_action('wp_head', array($this, 'add_download_widget_style'));
    }
  }

  /**
   * Вывод виджета во Фронт-энде
   *
   * @param array $args     аргументы виджета.
   * @param array $instance сохраненные данные из настроек
   */
  function widget($args, $instance)
  {
    $title = apply_filters('widget_title', $instance['title']);
    $file_name = $instance['file_name'];
    $file = $instance['file'];
    $file2_name = $instance['file2_name'];
    $file2 = $instance['file2'];

    echo $args['before_widget'];
    if (!empty($title)) {
      echo $args['before_title'] . $title . $args['after_title'];
    }
    echo '<a href="' . $file . '" download=""><i class="fa fa-file-pdf"></i> ' . $file_name . '</a>';
    echo '<a href="' . $file2 . '" download=""><i class="fa fa-file-pdf"></i> ' . $file2_name . '</a>';
    echo $args['after_widget'];
  }

  /**
   * Админ-часть виджета
   *
   * @param array $instance сохраненные данные из настроек
   */
  function form($instance)
  {
    $title = @$instance['title'] ?: __('Useful files', 'alexander_shnipov');
    $file = @$instance['file'] ?: __('URL file', 'alexander_shnipov');
    $file2 = @$instance['file2'] ?: __('URL file2', 'alexander_shnipov');
    $file_name = @$instance['file_name'] ?: __('File name', 'alexander_shnipov');
    $file2_name = @$instance['file2_name'] ?: __('File name2', 'alexander_shnipov');

?>
    <p>
      <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title', 'alexander_shnipov'); ?></label>
      <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo esc_attr($title); ?>">
    </p>
    <p>
      <label for="<?php echo $this->get_field_id('file_name'); ?>"><?php _e('File name', 'alexander_shnipov'); ?></label>
      <input class="widefat" id="<?php echo $this->get_field_id('file_name'); ?>" name="<?php echo $this->get_field_name('file_name'); ?>" type="text" value="<?php echo esc_attr($file_name); ?>">
    </p>
    <p>
      <label for="<?php echo $this->get_field_id('file'); ?>"><?php _e('URL file:', 'alexander_shnipov'); ?></label>
      <input class="widefat" id="<?php echo $this->get_field_id('file'); ?>" name="<?php echo $this->get_field_name('file'); ?>" type="text" value="<?php echo esc_attr($file); ?>">
    </p>

    <p>
      <label for="<?php echo $this->get_field_id('file2_name'); ?>"><?php _e('File name2', 'alexander_shnipov'); ?></label>
      <input class="widefat" id="<?php echo $this->get_field_id('file2_name'); ?>" name="<?php echo $this->get_field_name('file2_name'); ?>" type="text" value="<?php echo esc_attr($file2_name); ?>">
    </p>
    <p>
      <label for="<?php echo $this->get_field_id('file2'); ?>"><?php _e('URL file2:', 'alexander_shnipov'); ?></label>
      <input class="widefat" id="<?php echo $this->get_field_id('file2'); ?>" name="<?php echo $this->get_field_name('file2'); ?>" type="text" value="<?php echo esc_attr($file2); ?>">
    </p>
  <?php
  }

  /**
   * Сохранение настроек виджета. Здесь данные должны быть очищены и возвращены для сохранения их в базу данных.
   *
   * @see WP_Widget::update()
   *
   * @param array $new_instance новые настройки
   * @param array $old_instance предыдущие настройки
   *
   * @return array данные которые будут сохранены
   */
  function update($new_instance, $old_instance)
  {
    $instance = array();
    $instance['title'] = (!empty($new_instance['title'])) ? strip_tags($new_instance['title']) : '';
    $instance['file_name'] = (!empty($new_instance['file_name'])) ? strip_tags($new_instance['file_name']) : '';
    $instance['file'] = (!empty($new_instance['file'])) ? strip_tags($new_instance['file']) : '';
    $instance['file2_name'] = (!empty($new_instance['file2_name'])) ? strip_tags($new_instance['file2_name']) : '';
    $instance['file2'] = (!empty($new_instance['file2'])) ? strip_tags($new_instance['file2']) : '';

    return $instance;
  }

  // скрипт виджета
  function add_download_widget_scripts()
  {
    // фильтр чтобы можно было отключить скрипты
    if (!apply_filters('show_download_widget_script', true, $this->id_base))
      return;

    $theme_url = get_template_directory_uri();

    // wp_enqueue_script('download_widget_script', $theme_url .'/js/download_widget_script.js' );
  }

  // стили виджета
  function add_download_widget_style()
  {
    // фильтр чтобы можно было отключить стили
    if (!apply_filters('show_download_widget_style', true, $this->id_base))
      return;
  ?>
    <style type="text/css">
      .download_widget a {
        display: inline;
      }
    </style>
  <?php
  }
}
// конец класса Download_Widget

// регистрация Download_Widget в WordPress
function register_download_widget()
{
  register_widget('Download_Widget');
}
add_action('widgets_init', 'register_download_widget');


// ! готовим шаблон для комментариев

class Bootstrap_Walker_Comment extends Walker
{

  /**
   * What the class handles.
   *
   * @since 2.7.0
   * @var string
   *
   * @see Walker::$tree_type
   */
  public $tree_type = 'comment';

  /**
   * Database fields to use.
   *
   * @since 2.7.0
   * @var array
   *
   * @see Walker::$db_fields
   * @todo Decouple this
   */
  public $db_fields = array(
    'parent' => 'comment_parent',
    'id'     => 'comment_ID',
  );

  /**
   * Starts the list before the elements are added.
   *
   * @since 2.7.0
   *
   * @see Walker::start_lvl()
   * @global int $comment_depth
   *
   * @param string $output Used to append additional content (passed by reference).
   * @param int    $depth  Optional. Depth of the current comment. Default 0.
   * @param array  $args   Optional. Uses 'style' argument for type of HTML list. Default empty array.
   */
  public function start_lvl(&$output, $depth = 0, $args = array())
  {
    $GLOBALS['comment_depth'] = $depth + 1;

    switch ($args['style']) {
      case 'div':
        break;
      case 'ol':
        $output .= '<ol class="children">' . "\n";
        break;
      case 'ul':
      default:
        $output .= '<ul class="children">' . "\n";
        break;
    }
  }

  /**
   * Ends the list of items after the elements are added.
   *
   * @since 2.7.0
   *
   * @see Walker::end_lvl()
   * @global int $comment_depth
   *
   * @param string $output Used to append additional content (passed by reference).
   * @param int    $depth  Optional. Depth of the current comment. Default 0.
   * @param array  $args   Optional. Will only append content if style argument value is 'ol' or 'ul'.
   *                       Default empty array.
   */
  public function end_lvl(&$output, $depth = 0, $args = array())
  {
    $GLOBALS['comment_depth'] = $depth + 1;

    switch ($args['style']) {
      case 'div':
        break;
      case 'ol':
        $output .= "</ol><!-- .children -->\n";
        break;
      case 'ul':
      default:
        $output .= "</ul><!-- .children -->\n";
        break;
    }
  }

  /**
   * Traverses elements to create list from elements.
   *
   * This function is designed to enhance Walker::display_element() to
   * display children of higher nesting levels than selected inline on
   * the highest depth level displayed. This prevents them being orphaned
   * at the end of the comment list.
   *
   * Example: max_depth = 2, with 5 levels of nested content.
   *     1
   *      1.1
   *        1.1.1
   *        1.1.1.1
   *        1.1.1.1.1
   *        1.1.2
   *        1.1.2.1
   *     2
   *      2.2
   *
   * @since 2.7.0
   *
   * @see Walker::display_element()
   * @see wp_list_comments()
   *
   * @param WP_Comment $element           Comment data object.
   * @param array      $children_elements List of elements to continue traversing. Passed by reference.
   * @param int        $max_depth         Max depth to traverse.
   * @param int        $depth             Depth of the current element.
   * @param array      $args              An array of arguments.
   * @param string     $output            Used to append additional content. Passed by reference.
   */
  public function display_element($element, &$children_elements, $max_depth, $depth, $args, &$output)
  {
    if (!$element) {
      return;
    }

    $id_field = $this->db_fields['id'];
    $id       = $element->$id_field;

    parent::display_element($element, $children_elements, $max_depth, $depth, $args, $output);

    /*
		 * If at the max depth, and the current element still has children, loop over those
		 * and display them at this level. This is to prevent them being orphaned to the end
		 * of the list.
		 */
    if ($max_depth <= $depth + 1 && isset($children_elements[$id])) {
      foreach ($children_elements[$id] as $child) {
        $this->display_element($child, $children_elements, $max_depth, $depth, $args, $output);
      }

      unset($children_elements[$id]);
    }
  }

  /**
   * Starts the element output.
   *
   * @since 2.7.0
   *
   * @see Walker::start_el()
   * @see wp_list_comments()
   * @global int        $comment_depth
   * @global WP_Comment $comment       Global comment object.
   *
   * @param string     $output  Used to append additional content. Passed by reference.
   * @param WP_Comment $comment Comment data object.
   * @param int        $depth   Optional. Depth of the current comment in reference to parents. Default 0.
   * @param array      $args    Optional. An array of arguments. Default empty array.
   * @param int        $id      Optional. ID of the current comment. Default 0 (unused).
   */
  public function start_el(&$output, $comment, $depth = 0, $args = array(), $id = 0)
  {
    $depth++;
    $GLOBALS['comment_depth'] = $depth;
    $GLOBALS['comment']       = $comment;

    if (!empty($args['callback'])) {
      ob_start();
      call_user_func($args['callback'], $comment, $args, $depth);
      $output .= ob_get_clean();
      return;
    }

    if ('comment' === $comment->comment_type) {
      add_filter('comment_text', array($this, 'filter_comment_text'), 40, 2);
    }

    if (('pingback' === $comment->comment_type || 'trackback' === $comment->comment_type) && $args['short_ping']) {
      ob_start();
      $this->ping($comment, $depth, $args);
      $output .= ob_get_clean();
    } elseif ('html5' === $args['format']) {
      ob_start();
      $this->html5_comment($comment, $depth, $args);
      $output .= ob_get_clean();
    } else {
      ob_start();
      $this->comment($comment, $depth, $args);
      $output .= ob_get_clean();
    }

    if ('comment' === $comment->comment_type) {
      remove_filter('comment_text', array($this, 'filter_comment_text'), 40);
    }
  }

  /**
   * Ends the element output, if needed.
   *
   * @since 2.7.0
   *
   * @see Walker::end_el()
   * @see wp_list_comments()
   *
   * @param string     $output  Used to append additional content. Passed by reference.
   * @param WP_Comment $comment The current comment object. Default current comment.
   * @param int        $depth   Optional. Depth of the current comment. Default 0.
   * @param array      $args    Optional. An array of arguments. Default empty array.
   */
  public function end_el(&$output, $comment, $depth = 0, $args = array())
  {
    if (!empty($args['end-callback'])) {
      ob_start();
      call_user_func($args['end-callback'], $comment, $args, $depth);
      $output .= ob_get_clean();
      return;
    }
    if ('div' === $args['style']) {
      $output .= "</div><!-- #comment-## -->\n";
    } else {
      $output .= "</li><!-- #comment-## -->\n";
    }
  }

  /**
   * Outputs a pingback comment.
   *
   * @since 3.6.0
   *
   * @see wp_list_comments()
   *
   * @param WP_Comment $comment The comment object.
   * @param int        $depth   Depth of the current comment.
   * @param array      $args    An array of arguments.
   */
  protected function ping($comment, $depth, $args)
  {
    $tag = ('div' === $args['style']) ? 'div' : 'li';
  ?>
    <<?php echo $tag; ?> id="comment-<?php comment_ID(); ?>" <?php comment_class('', $comment); ?>>
      <div class="comment-body">
        <?php _e('Pingback:'); ?> <?php comment_author_link($comment); ?> <?php edit_comment_link(__('Edit', 'alexander_shnipov'), '<span class="edit-link">', '</span>'); ?>
      </div>
    <?php
  }

  /**
   * Filters the comment text.
   *
   * Removes links from the pending comment's text if the commenter did not consent
   * to the comment cookies.
   *
   * @since 5.4.2
   *
   * @param string          $comment_text Text of the current comment.
   * @param WP_Comment|null $comment      The comment object. Null if not found.
   * @return string Filtered text of the current comment.
   */
  public function filter_comment_text($comment_text, $comment)
  {
    $commenter          = wp_get_current_commenter();
    $show_pending_links = !empty($commenter['comment_author']);

    if ($comment && '0' == $comment->comment_approved && !$show_pending_links) {
      $comment_text = wp_kses($comment_text, array());
    }

    return $comment_text;
  }

  /**
   * Outputs a single comment.
   *
   * @since 3.6.0
   *
   * @see wp_list_comments()
   *
   * @param WP_Comment $comment Comment to display.
   * @param int        $depth   Depth of the current comment.
   * @param array      $args    An array of arguments.
   */
  protected function comment($comment, $depth, $args)
  {
    if ('div' === $args['style']) {
      $tag       = 'div';
      $add_below = 'comment';
    } else {
      $tag       = 'li';
      $add_below = 'div-comment';
    }

    $commenter          = wp_get_current_commenter();
    $show_pending_links = isset($commenter['comment_author']) && $commenter['comment_author'];

    if ($commenter['comment_author_email']) {
      $moderation_note = __('Your comment is awaiting moderation.', 'alexander_shnipov');
    } else {
      $moderation_note = __('Your comment is awaiting moderation. This is a preview; your comment will be visible after it has been approved.', 'alexander_shnipov');
    }
    ?>
      <<?php echo $tag; ?> <?php comment_class($this->has_children ? 'parent' : '', $comment); ?> id="comment-<?php comment_ID(); ?>">
        <?php if ('div' !== $args['style']) : ?>
          <div id="div-comment-<?php comment_ID(); ?>" class="comment-body">
          <?php endif; ?>
          <div class="comment-author vcard">
            <?php
            if (0 != $args['avatar_size']) {
              echo get_avatar($comment, $args['avatar_size']);
            }
            ?>
            <?php
            $comment_author = get_comment_author_link($comment);

            if ('0' == $comment->comment_approved && !$show_pending_links) {
              $comment_author = get_comment_author($comment);
            }

            printf(
              /* translators: %s: Comment author link. */
              __('%s <span class="says">says:</span>'),
              sprintf('<cite class="fn">%s</cite>', $comment_author)
            );
            ?>
          </div>
          <?php if ('0' == $comment->comment_approved) : ?>
            <em class="comment-awaiting-moderation"><?php echo $moderation_note; ?></em>
            <br />
          <?php endif; ?>

          <div class="comment-meta commentmetadata">
            <?php
            printf(
              '<a href="%s">%s</a>',
              esc_url(get_comment_link($comment, $args)),
              sprintf(
                /* translators: 1: Comment date, 2: Comment time. */
                __('%1$s at %2$s', 'alexander_shnipov'),
                get_comment_date('', $comment),
                get_comment_time()
              )
            );

            edit_comment_link(__('(Edit)', 'alexander_shnipov'), ' &nbsp;&nbsp;', '');
            ?>
          </div>

          <?php
          comment_text(
            $comment,
            array_merge(
              $args,
              array(
                'add_below' => $add_below,
                'depth'     => $depth,
                'max_depth' => $args['max_depth'],
              )
            )
          );
          ?>

          <?php
          comment_reply_link(
            array_merge(
              $args,
              array(
                'add_below' => $add_below,
                'depth'     => $depth,
                'max_depth' => $args['max_depth'],
                'before'    => '<div class="reply">',
                'after'     => '</div>',
              )
            )
          );
          ?>

          <?php if ('div' !== $args['style']) : ?>
          </div>
        <?php endif; ?>
      <?php
    }

    /**
     * ! Outputs a comment in the HTML5 format.
     *
     * @since 3.6.0
     *
     * @see wp_list_comments()
     *
     * @param WP_Comment $comment Comment to display.
     * @param int        $depth   Depth of the current comment.
     * @param array      $args    An array of arguments.
     */
    protected function html5_comment($comment, $depth, $args)
    {
      $tag = ('div' === $args['style']) ? 'div' : 'li';

      $commenter          = wp_get_current_commenter();
      $show_pending_links = !empty($commenter['comment_author']);

      if ($commenter['comment_author_email']) {
        $moderation_note = __('Your comment is awaiting moderation.', 'alexander_shnipov');
      } else {
        $moderation_note = __('Your comment is awaiting moderation. This is a preview; Your comment will be published after verification.', 'alexander_shnipov');
      }
      ?>
        <<?php echo $tag; ?> id="comment-<?php comment_ID(); ?>" <?php comment_class($this->has_children ? 'parent' : '', $comment); ?>>
          <article id="div-comment-<?php comment_ID(); ?>" class="media mb-4">
            <?php
            if (0 != $args['avatar_size']) {
              echo get_avatar($comment, $args['avatar_size'], 'mystery', '', array('class' => 'img-fluid d-flex mr-4 rounded'));
            }
            ?>

            <footer>
              <?php
              $comment_author = get_comment_author_link($comment);

              if ('0' == $comment->comment_approved && !$show_pending_links) {
                $comment_author = get_comment_author_link($comment);
              }

              printf(
                /* translators: %s: Comment author link. */
                __('%s', 'alexander_shnipov'),
                sprintf('<h5>%s</h5>', $comment_author)
              );
              ?>

              <div class="comment-metadata">
                <?php
                printf(
                  '<a href="%s" class="text-muted"><time datetime="%s">%s</time></a>',
                  esc_url(get_comment_link($comment, $args)),
                  get_comment_time('c'),
                  sprintf(
                    /* translators: 1: Comment date, 2: Comment time. */
                    __('%1$s at %2$s', 'alexander_shnipov'),
                    get_comment_date('j F Y', $comment),
                    get_comment_time('')
                  )
                );

                edit_comment_link(__('Edit'), ' <span class="edit-link">', '</span>', 'alexander_shnipov');
                ?>
              </div><!-- .comment-metadata -->

              <?php if ('0' == $comment->comment_approved) : ?>
                <em class="comment-awaiting-moderation"><?php echo $moderation_note; ?></em>
              <?php endif; ?>
              <div class="mt-2">
                <?php comment_text(); ?>
              </div><!-- .mt-2t -->
              <?php
              if ('1' == $comment->comment_approved || $show_pending_links) {
                comment_reply_link(
                  array_merge(
                    $args,
                    array(
                      'add_below' => 'div-comment',
                      'depth'     => $depth,
                      'max_depth' => $args['max_depth'],
                      'before'    => '<div class="reply">',
                      'after'     => '</div>',
                    )
                  )
                );
              }
              ?>
            </footer><!-- .comment-meta -->


          </article><!-- .comment-body -->
      <?php
    }
  }

  // ! регистрация нового типа записей - услуги

  add_action('init', 'my_custom_init');
  function my_custom_init()
  {
    register_post_type('service', array(
      'labels'             => array(
        'name'               => __('Services', 'alexander_shnipov'), // Основное название типа записи
        'singular_name'      => __('Service', 'alexander_shnipov'), // отдельное название записи типа Service
        'add_new'            => __('Add new', 'alexander_shnipov'),
        'add_new_item'       => __('Add new service', 'alexander_shnipov'),
        'edit_item'          => __('Edit service', 'alexander_shnipov'),
        'new_item'           => __('New service', 'alexander_shnipov'),
        'view_item'          => __('View service', 'alexander_shnipov'),
        'search_items'       => __('Search a service', 'alexander_shnipov'),
        'not_found'          => __('No services found', 'alexander_shnipov'),
        'not_found_in_trash' => __('No services found in the basket', 'alexander_shnipov'),
        'parent_item_colon'  => '',
        'menu_name'          => __('Services', 'alexander_shnipov')

      ),
      'public'             => true,
      'publicly_queryable' => true,
      'show_ui'            => true,
      'show_in_menu'       => true,
      'query_var'          => true,
      'rewrite'            => true,
      'capability_type'    => 'post',
      'menu_icon'          => 'dashicons-businessman',
      'has_archive'        => true,
      'hierarchical'       => false,
      'menu_position'      => 5,
      'supports'           => array('title', 'editor', 'author', 'thumbnail', 'excerpt')
    ));

    // ! регистрация нового типа записей - партнеры

    register_post_type('partners', array(
      'labels'             => array(
        'name'               => __('Partners', 'alexander_shnipov'), // Основное название типа записи
        'singular_name'      => __('Partners', 'alexander_shnipov'), // отдельное название записи типа Partners
        'add_new'            => __('Add new', 'alexander_shnipov'),
        'add_new_item'       => __('Add new partner', 'alexander_shnipov'),
        'edit_item'          => __('Edit partner', 'alexander_shnipov'),
        'new_item'           => __('New partner', 'alexander_shnipov'),
        'view_item'          => __('View partners', 'alexander_shnipov'),
        'search_items'       => __('Search a partners', 'alexander_shnipov'),
        'not_found'          => __('partners not found', 'alexander_shnipov'),
        'not_found_in_trash' => __('No partners found in the basket', 'alexander_shnipov'),
        'parent_item_colon'  => '',
        'menu_name'          => __('Partners', 'alexander_shnipov')

      ),
      'public'             => true,
      'publicly_queryable' => true,
      'show_ui'            => true,
      'show_in_menu'       => true,
      'query_var'          => true,
      'rewrite'            => true,
      'capability_type'    => 'post',
      'menu_icon'          => 'dashicons-thumbs-up',
      'has_archive'        => true,
      'hierarchical'       => false,
      'menu_position'      => 5,
      'supports'           => array('title', 'editor', 'author', 'thumbnail', 'excerpt')
    ));

    // function partners_posts_per_page($query)
    // {
    //   if (is_front_page()) {
    //     $query->set('posts_per_page', 2);
    //   } 
    //   if (is_page_pricing()) {
    //       $query->set('posts_per_page', 2);
    //     } 

    // }
    // add_action('pre_get_posts', 'partners_posts_per_page');

    // ! регистрация нового типа записей - тарифы

    register_post_type('price', array(
      'labels'             => array(
        'name'               => __('Prices', 'alexander_shnipov'), // Основное название типа записи
        'singular_name'      => __('Price', 'alexander_shnipov'), // отдельное название записи типа price
        'add_new'            => __('Add new', 'alexander_shnipov'),
        'add_new_item'       => __('Add new price', 'alexander_shnipov'),
        'edit_item'          => __('Edit price', 'alexander_shnipov'),
        'new_item'           => __('New price', 'alexander_shnipov'),
        'view_item'          => __('View price', 'alexander_shnipov'),
        'search_items'       => __('Search a price', 'alexander_shnipov'),
        'not_found'          => __('prices not found', 'alexander_shnipov'),
        'not_found_in_trash' => __('No prices found in the basket', 'alexander_shnipov'),
        'parent_item_colon'  => '',
        'menu_name'          => __('Prices', 'alexander_shnipov')

      ),
      'public'             => true,
      'publicly_queryable' => true,
      'show_ui'            => true,
      'show_in_menu'       => true,
      'query_var'          => true,
      'rewrite'            => true,
      'capability_type'    => 'post',
      'menu_icon'          => 'dashicons-money-alt',
      'has_archive'        => true,
      'hierarchical'       => false,
      'menu_position'      => 7,
      'supports'           => array('title', 'editor', 'author', 'thumbnail', 'excerpt', 'custom-fields')
    ));

    // ! регистрация нового типа записей - отзывы

    register_post_type('testimonial', array(
      'labels'             => array(
        'name'               => __('Testimonials', 'alexander_shnipov'), // Основное название типа записи
        'singular_name'      => __('Testimonial', 'alexander_shnipov'), // отдельное название записи типа testimonial
        'add_new'            => __('Add new', 'alexander_shnipov'),
        'add_new_item'       => __('Add new testimonial', 'alexander_shnipov'),
        'edit_item'          => __('Edit testimonial', 'alexander_shnipov'),
        'new_item'           => __('New testimonial', 'alexander_shnipov'),
        'view_item'          => __('View testimonial', 'alexander_shnipov'),
        'search_items'       => __('Search testimonial', 'alexander_shnipov'),
        'not_found'          => __('Testimonials not found', 'alexander_shnipov'),
        'not_found_in_trash' => __('Not found testimonials in trash', 'alexander_shnipov'),
        'parent_item_colon'  => '',
        'menu_name'          => __('Testimonials', 'alexander_shnipov')

      ),
      'public'             => true,
      'publicly_queryable' => true,
      'show_ui'            => true,
      'show_in_menu'       => true,
      'query_var'          => true,
      'rewrite'            => true,
      'capability_type'    => 'post',
      'menu_icon'          => 'dashicons-testimonial',
      'has_archive'        => true,
      'hierarchical'       => false,
      'menu_position'      => 8,
      'supports'           => array('title', 'thumbnail', 'excerpt', 'custom-fields')
    ));
  }

  // ! отправка сообщений со страницы contacts
  add_action('phpmailer_init', 'my_phpmailer_example');
  function my_phpmailer_example($phpmailer)
  {

    $phpmailer->isSMTP();
    $phpmailer->Host = 'smtp.timeweb.ru';
    $phpmailer->SMTPAuth = true; // Force it to use Username and Password to authenticate
    $phpmailer->Port = 25;
    $phpmailer->Username = 'info@alexander-shnipov.ru';
    $phpmailer->Password = 'iTQd335p';

    // Additional settings…
    //$phpmailer->SMTPSecure = "tls"; // Choose SSL or TLS, if necessary for your server
    $phpmailer->From = "info@alexander-shnipov.ru";
    $phpmailer->FromName = "Wordpress";
  }

  add_action('wp_ajax_my_action', 'my_action_callback');
  add_action('wp_ajax_nopriv_my_action', 'my_action_callback');
  function my_action_callback()
  {

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

      # Подставляем почту администратора
      $mail_to = get_option('admin_email');

      # Собираем данные из формы
      $phone = trim($_POST["phone"]);
      $name = trim($_POST["name"]);
      $email = trim($_POST["email"]);
      $message = trim($_POST["message"]);

      if (empty($name) or empty($email) or empty($phone) or empty($message)) {
        # Отправляем ошибку 400 (bad request).
        http_response_code(400);
        echo __("Please fill in all required fields.",'alexander_shnipov');
        exit;
      }

      # Содержимое письма
      $subject = 'Заявка с сайта:' . get_bloginfo('name');
      $content = "Name: $name\n";
      $content .= "Email: $email\n\n";
      $content .= "Phone: $phone\n\n";
      $content .= "Сообщение:\n$message\n";

      # Заголовок письма email headers.
      $headers = "From: Wordpress <info@alexander-shnipov.ru>";

      # Попытка отправить с помощью  mail().
      $success = wp_mail($mail_to, $subject, $content, $headers);
      if ($success) {
        # Set a 200 (okay) response code.
        http_response_code(200);
        echo __("Thanks! Your message has been sent." , 'alexander_shnipov');
      } else {
        # Set a 500 (internal server error) response code.
        http_response_code(500);
        echo __("Oops! Something went wrong, the message could not be sent.", 'alexander_shnipov');
      }
    } else {
      # Not a POST request, set a 403 (forbidden) response code.
      http_response_code(403);
      echo __("Failed to send, please try again later.", 'alexander_shnipov');
    }

    wp_die();
  }

  // ! shortcode
  add_shortcode('admin_email', 'admin_email_shortcode');

  function admin_email_shortcode($atts)
  {
    return '<a href="mailto:' . get_option('admin_email') . '">' . get_option('admin_email') . '</a>';
  }


  add_shortcode('youtube', 'youtube_shortcode');

  function youtube_shortcode($atts, $content)
  {
    extract(shortcode_atts(array(
      'id' => ''
    ), $atts));
    return '<p>' . $content . '</p><iframe src="https://www.youtube.com/embed/' . $id . '"></iframe>';
  }
