<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); 



# глобальное кэширование выполняется на уровне хука при наличии соответствующего плагина
# если хук вернул true, значит данные выведены из кэша, то есть выходим
if (mso_hook('global_cache_start', false)) return;



  # подключаем библиотеки
  require_once(getinfo('common_dir') . 'page.php');          // функции страниц 
  require_once(getinfo('common_dir') . 'category.php');      // функции рубрик



  # если нужен RSS
  //  if ( mso_segment(1) == 'feed' ) {
  //    require_once(getinfo('template_dir') . 'type/rss_home.php');
  //    exit();
  //  }



  // получим GET
  // $get = mso_parse_url_get(mso_url_get());
  // pr($get['lang']);



  // для rss
  if (is_feed()) {
    require_once(getinfo('template_dir') . 'type/rss.php');
    exit; // выходим
  }



  // подключения типов страниц
  if(is_type('home')) {
    require_once(getinfo('template_dir') . 'type/home.php');
  }
  elseif(is_type('category')) {
    require_once(getinfo('template_dir') . 'type/category.php');
  }
  elseif(is_type('page')) {
   require_once(getinfo('template_dir') . 'type/page.php');
  }
  else {
    require_once(getinfo('template_dir') . 'type/404.php');
  }



  # хук глобального кэша
  mso_hook('global_cache_end');



# end file