<?php
// initialize variables
$theme_dir	= get_template_directory_uri();
$base_url       = str_replace("/wp-content/themes/lifestyle", "", $theme_dir);
$page_id	= get_the_ID();
$page		= get_page($page_id);

// select the template by page
switch ($page_id) {
    case 4:
        // home
        include "templates/_master.php";
        break;
    case 14:
        include "templates/_contact.php";
        break;
    default:
        include "templates/_master.php";
        break;
}
?>