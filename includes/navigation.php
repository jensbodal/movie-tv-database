<?php
if (empty($title)) {
    $title = "Actor/Movie Database";
}

$root_dir = dirname(dirname(__FILE__));
$pattern = '/\/nfs.*public_html(.*)/';
preg_match($pattern, $root_dir, $matches);
$root_dir = $matches[1];
$home_dir = $root_dir . '/';

?>
<nav class="navbar navbar-inverse navbar-static-top">
    <div class="container">
      <div class="navbar-header">
        <a class="navbar-brand" href=<?=$home_dir?>>Movie/Actor DB</a>
      </div>
      <div id="navbar">
        <ul class="nav navbar-nav">
          <li id='home_btn'><a href=<?=$home_dir?>>Home</a></li>
          <li id='view_btn'class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Views <span class="caret"></span></a> 
            <ul class="dropdown-menu" role="menu">
              <li><a href=<?=$root_dir."/views/actorView"?>>Actors</a></li>
              <li><a href=<?=$root_dir."/views/directorView"?>>Directors</a></li>
              <li><a href=<?=$root_dir."/views/movieView"?>>Movies</a></li>
              <li><a href=<?=$root_dir."/views/personView"?>>People</a></li>
              <li><a href=<?=$root_dir."/views/tvshowView"?>>TV Shows</a></li>
            </ul>
          </li>
          <li id='add_btn'><a href=<?=$root_dir."/adds/add"?>>Add</a></li>
        </ul>
      </div>
    </div>
</nav>
