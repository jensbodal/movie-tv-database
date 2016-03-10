
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
<!doctype html>
<html lang="en">
<head>
    <title><?php echo $title ?></title>
    <meta charset="UTF-8" />
    
    <!-- *********************************   CSS   ********************************* -->
    <!-- Our stylesheet -->
    <link rel="stylesheet" href=<?=$css_dir?> type="text/css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" type="text/css">
    <!-- Bootstrap Theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" type="text/css">
    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">

    <!-- ********************************* SCRIPTS ********************************* -->
    <!-- Our layout handler -->
    <script src=<?=$js_dir?> type="text/javascript"></script>
    <!-- Jquery 1.12.0 -->
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</head>
<body>

<nav class="navbar navbar-inverse navbar-static-top">
    <div class="container">
        <div class="navbar-header">
            <a class="navbar-brand" href=<?=$home_dir?>>Movie/Actor DB</a>
        </div>
        <div id="navbar">
            <ul class="nav navbar-nav">
                <li><a href=<?=$home_dir?>>Home</a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Views <span class="caret"></span></a> 
                    <ul class="dropdown-menu" role="menu">
                        <li><a href=<?=$root_dir."/views/movieView"?>>Movies</a></li>
                        <li><a href=<?=$root_dir."/views/tvshowView"?>>TV Shows</a></li>
                        <li><a href=<?=$root_dir."/views/actorView"?>>Actors</a></li>
                        <li><a href=<?=$root_dir."/views/directorView"?>>Directors</a></li>
                        <li><a href=<?=$root_dir."/views/personView"?>>People</a></li>
                    </ul>
                </li>
                <li><a href=<?=$home_dir.'add.html'?>>Add</a></li>
            </ul>
        </div>
    </div>
</nav>

<script>
$(document.body).append('</html>');
</script>
