<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); 



  // получим массив всех рубрик
  $cats = mso_cat_array_single('page', 'category_menu_order', 'ASC', '', true, false);
  // pr($cats);



  // если массив рубрик получен
  if( $cats ) {

    // найдем нужную рубрику и получим данные о ней
    foreach($cats as $cat) {
      if( mso_segment(2) == $cat['category_slug'] ) {
        $cat_id = $cat['category_id'];
        $cat_descr = $cat['category_desc'];
        $cat_name = $cat['category_name'];
        break;
      }
    }

    // сделаем запрос за записями этой рубрики
    $par = array( 
      'type' => false,
      'get_page_count_comments' => false,
      'cat_id' => $cat_id,
      'limit' => mso_get_option('limit_post', 'templates', '10'),
      'cut' => mso_get_option('more', 'templates', 'Читать полностью »'),
      'cat_order' => 'category_id_parent',
      'cat_order_asc' => 'asc',
      'type' => false,
    );  
    $pages = mso_get_pages($par, $pag); 
    // pr($pages);

    // определим метаданные
    mso_head_meta('title',       $cat_name . ' - ' . getinfo('name_site'));
    mso_head_meta('description', $cat_descr);
    mso_head_meta('keywords',    $cat_descr);

    // подключим шапку
    require_once(getinfo('template_dir') . 'page_header.php');

    // pr($pages);

    // какой-то заголовок перед выводом записей
    // echo '<div class="content__item  content__item--thumbs-wrapp"><h2 class="first-header  first-header--category-header"><a href="'. getinfo('siteurl') . $link_end .'">'. $с_home .'</a> <span class="arr"></span> ' . $cat_name . '</h2><ul class="albums" id="category_photos">';

    // подключим выводящий файл
    require_once(getinfo('template_dir') . 'type/echo_page.php');

    // подключим подвал
    require_once(getinfo('template_dir') . 'page_footer.php');
  }

  // если массив рубрик не получен, это не категория, это 404
  else {
    require_once(getinfo('template_dir') . 'type/404.php');
  }



# end file