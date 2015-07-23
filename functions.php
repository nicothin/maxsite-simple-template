<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); 



# файл functions.php подключается при инициализации сайта
# в этом файле нельзя выводить данные в браузер!



  # регистрируем сайдбары - имя, заголовок.
  # если имя совпадает, то берется последний заголовок
  // mso_register_sidebar('1', tf('Сайдбар'));



  // дополнительные стили для body
  $add_body_class = '';
  if ( stristr($_SERVER['HTTP_USER_AGENT'], 'Firefox') )       $add_body_class = 'firefox';
  elseif ( stristr($_SERVER['HTTP_USER_AGENT'], 'Chrome') )    $add_body_class = 'chrome';
  elseif ( stristr($_SERVER['HTTP_USER_AGENT'], 'Safari') )    $add_body_class = 'safari';
  elseif ( stristr($_SERVER['HTTP_USER_AGENT'], 'Opera') )     $add_body_class = 'opera';
  elseif ( stristr($_SERVER['HTTP_USER_AGENT'], 'MSIE 6.0') )  $add_body_class = 'ie6';
  elseif ( stristr($_SERVER['HTTP_USER_AGENT'], 'MSIE 7.0') )  $add_body_class = 'ie7';
  elseif ( stristr($_SERVER['HTTP_USER_AGENT'], 'MSIE 8.0') )  $add_body_class = 'ie8';
  elseif ( stristr($_SERVER['HTTP_USER_AGENT'], 'MSIE 9.0') )  $add_body_class = 'ie9';
  elseif ( stristr($_SERVER['HTTP_USER_AGENT'], 'MSIE 10.0') ) $add_body_class = 'ie10';
  elseif ( stristr($_SERVER['HTTP_USER_AGENT'], 'Trident/7') ) $add_body_class = 'ie11';
  elseif ( stristr($_SERVER['HTTP_USER_AGENT'], 'Edge/12') )   $add_body_class = 'edge';
  $add_body_class .= ' is-type-'.getinfo('type');

  if (is_type('home')) mso_set_val('body_class', 'body-home ' . $add_body_class);
  else                 mso_set_val('body_class', 'body-' . getinfo('type') . ' ' . $add_body_class);



  // возвращает путь к странице через связи дочерние-родительские страницы
  function parents_out_way_to ($page_id = 0) {
    $cache_key = 'parents_out_way_to' . $page_id;
    $k = mso_get_cache($cache_key);
    if ($k) return $k; // да есть в кэше
    $r ='';
    $CI = & get_instance();
    $CI->db->select('page_id, page_id_parent, page_title, page_slug');
    $CI->db->where('page_id', $page_id);
    $CI->db->order_by('page_menu_order');
    $query = $CI->db->get('page');
    $result = $query->result_array();
    if ($result)
    {
      foreach ($result as $key=>$page2)
      {
          extract($page2);
        $r = $page_title; 
        if ($page_id_parent > 0)
        {
         $parents = parents_out_way_parents($page_id_parent);
         if ( $parents )
          {
            $r = $parents.' <span class="arr">→</span> '.$page_title;
          }
        }
      } 
    }
    mso_add_cache($cache_key, $r); // в кэш
    return $r;
  }

  function parents_out_way_parents ($page_id = 0) { //рекурентная для parents_out_way_to
    $r = '';
    $CI = & get_instance();
    $CI->db->select('page_id, page_id_parent, page_title, page_slug');
    $CI->db->where('page_id', $page_id);
    $CI->db->order_by('page_menu_order');
    $query = $CI->db->get('page');
    $result = $query->result_array();
     
    global $MSO;
    if ($result)
    {
      foreach ($result as $key=>$page2)
      {
           extract($page2);
           $page_link = '<a href="' . $MSO->config['site_url'] . $page_slug . '" title="' . mso_strip($page_title) . '">' . $page_title . '</a>';
           $r = $page_link; 
           if ($page_id_parent>0)
           {
             $parents = parents_out_way_parents($page_id_parent);
             $r = $parents.'->'.$page_link; 
           } 
      } 
    }
    return $r;
  }



# end file