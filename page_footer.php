<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

  // if ($footer_social = mso_get_option('footer_social', 'templates', '')) { 
  //   echo $footer_social;
  // }



  // $CI = & get_instance();  
  // echo '<p>'.sprintf('Работает на <a href="http://max-3000.com/">MaxSite CMS</a> | Время: {elapsed_time} | SQL: %s | Память: {memory_usage}', $CI->db->query_count).' | <a href="/admin">Управление</a></p>';

  // echo NR . mso_load_jquery();



  // определим дату модификации js
  $js_mod_date = '';
  $js_file_template_path = 'assets/js/script.min.js';
  $js_file_path = getinfo('template_dir') . $js_file_template_path;
  if (file_exists($js_file_path)) {
    $js_mod_date = '?' . filemtime($js_file_path);
  }



  echo NR . '<script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>' . NR . '<script>window.jQuery || document.write(\'<script src="' . getinfo('template_url') . 'assets/js/jquery.2.1.3.min.js"><\/script>\')</script>';

  mso_hook('head');

  echo NR . '<script src="' . getinfo('template_url') . $js_file_template_path . $js_mod_date . '"></script>';



  if (function_exists('ushka')) {
    echo ushka('google_analytics');
    echo ushka('body_end');
  }

  mso_hook('body_end'); 

?>
</body>
</html>