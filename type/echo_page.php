<?php



  // выводим контент страниц(ы) в цикле
  foreach ($pages as $page) {

    // pr($page);
    
    if( $page ) {

      echo '<section>';

        echo '<header>';

          echo '<h1>'.$page['page_title'].'</h1>';

          // если это админ — выведем ссылку редактирования
          if(is_login()) echo '<p><a href="/admin/page_edit/'.$page['page_id'].'">Редактировать</a></p>';

        echo '</header>';

        echo $page['page_content'];

      echo '</section>';

    }

  }



# end file