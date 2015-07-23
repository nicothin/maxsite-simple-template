<?php

  header('HTTP/1.0 404 Not Found');

  // подключим шапку
  require_once(getinfo('template_dir') . 'page_header.php');

  echo '404';

  // подключим подвал
  require_once(getinfo('template_dir') . 'page_footer.php');



# end file