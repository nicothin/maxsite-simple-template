<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); 



  mso_page_view_count_first(); // для подсчета количества прочтений страницы



  // получим страницы
  $par = array( 
    'cut' => false, 
    'cat_order' => 'category_id_parent', 
    'cat_order_asc' => 'asc', 
    'type' => false); 
  $pages = mso_get_pages($par, $pagination); // получим все

  // определим метаданные
  mso_head_meta('title', $pages, '%page_title%');
  mso_head_meta('description', $pages);
  mso_head_meta('keywords', $pages);



  // если страницы были получены
  if ($pages) {

    // подключим шапку
    require_once(getinfo('template_dir') . 'page_header.php');
    
    // подключим выводящий файл
    require_once(getinfo('template_dir') . 'type/echo_page.php');
    
    // подключим подвал
    require_once(getinfo('template_dir') . 'page_footer.php');

  }

  // если страницы не были получены
  else {
    require_once(getinfo('template_dir') . 'type/404.php');
  }



# end file