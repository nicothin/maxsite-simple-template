<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

  // определим дату модификации CSS
  $css_mod_date = '';
  $css_file_template_path = 'assets/css/style.min.css';
  $css_file_path = getinfo('template_dir') . $css_file_template_path;
  if (file_exists($css_file_path)) {
    $css_mod_date = '?' . filemtime($css_file_path);
  }


  // выводим кодэ
  echo '<!DOCTYPE HTML>
<html' . mso_get_val('head_section_html_add') . '>
<head>' . mso_hook('head-start') . '

<meta charset="UTF-8">
<title>' . mso_head_meta('title') . '</title>
<meta name="description" content="' . mso_head_meta('description') . '">
<meta name="keywords" content="' . mso_head_meta('keywords') . '">
<meta property="og:title" content="' . mso_head_meta('title') . '">
<meta property="og:description" content="' . mso_head_meta('description') . '">

<!-- <meta name="viewport" content="width=device-width, initial-scale=1"> -->
<link rel="stylesheet" href="' . getinfo('template_url') . $css_file_template_path . $css_mod_date . '">

<!--[if lt IE 9]><script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script><![endif]-->
';

  // cтили заданные в админке
  if ($my_style = mso_get_option('my_style', 'templates', '')) 
    echo NR . '<style>' . NR . $my_style . NR . '</style>' . NR;

  echo NT . mso_rss();
  
  mso_hook('head-end');

  if (function_exists('ushka')) echo ushka('google_analytics_top');
  if (function_exists('ushka')) echo ushka('head');
  
  echo NR . '</head>' . NR;
  
  if (!$_POST) flush();

?>

<body class="<?= mso_get_val('body_class') ?>">

<?= mso_hook('body_start') ?>

<ul>
<?php 
  $menu = mso_get_option('main-menu', 'templates', '');
  echo mso_menu_build($menu, 'active', false);
?>
</ul>

<?= getinfo('siteurl') ?> <br>
<?= getinfo('stylesheet_url') ?> <br>
<?= getinfo('template_dir') ?> <br>
<?= getinfo('uploads_url') ?> <br>
<?= getinfo('name_site') ?> <br>
<?= getinfo('description_site') ?> <br>