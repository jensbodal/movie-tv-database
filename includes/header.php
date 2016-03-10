<?php
if (empty($title)) {
    $title = "Actor/Movie Database";
}

$root_dir = dirname(dirname(__FILE__));
$pattern = '/\/nfs.*public_html(.*)/';
preg_match($pattern, $root_dir, $matches);
$root_dir = $matches[1];
$css_dir = $root_dir . '/public/stylesheets/style.css';
$js_dir = $root_dir . '/public/javascripts/htmlTagHandler.js';
$home_dir = $root_dir . '/';

?>
<head>
    <title><?php echo $title ?></title>
    <meta charset="UTF-8" />
    
    <!-- *********************************   CSS   ********************************* -->
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" type="text/css">
    <!-- Bootstrap Theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" type="text/css">
    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <!-- Our stylesheet -->
    <link rel="stylesheet" href=<?=$css_dir?> type="text/css">

    <!-- ********************************* SCRIPTS ********************************* -->
    <!-- Our layout handler -->
    <script src=<?=$js_dir?> type="text/javascript"></script>
    <!-- Jquery 1.12.0 -->
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</head>
