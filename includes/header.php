<?php
if (empty($title)) {
    $title = "Movie/TV Show Database";
}

$root_dir = dirname(dirname(__FILE__));
$pattern = '/\/nfs.*public_html(.*)/';
preg_match($pattern, $root_dir, $matches);
$user = get_current_user();
$root_dir = '/~'.$user.$matches[1];
$css_dir = $root_dir . '/public/stylesheets/style.css';
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
    <!-- Bootstrap toggle buttons CSS -->
    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.0/css/bootstrap-toggle.min.css" rel="stylesheet">
    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <!-- Our stylesheet -->
    <link rel="stylesheet" href=<?=$css_dir?> type="text/css">

    <!-- ********************************* SCRIPTS ********************************* -->
    <!-- Jquery 1.12.0 -->
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <!-- Boostrap toggle buttons JS -->
    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.0/js/bootstrap-toggle.min.js"></script>
</head>
