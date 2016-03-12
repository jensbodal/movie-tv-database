<?php

class ENGRhelper {
  private $root_dir;

  public function __construct() {
    $this->setRootDir();
  }

  public function setRootDir() {
    $root_dir = dirname(dirname(__FILE__));
    $pattern = '/\/nfs.*public_html(.*)/';
    preg_match($pattern, $root_dir, $matches);
    $user = get_current_user();
    $this->root_dir = '/~'.$user.$matches[1];
  }

  public function getRootDir() {
    return ($this->root_dir);
  }

  public function getCurrentDir() {
    return $this->remove_ENGR_dirs(getcwd());
  }

  private function remove_ENGR_dirs($path) {
    $pattern = '/\/nfs.*public_html(.*)/';
    preg_match($pattern, $path, $matches);
    $user = get_current_user();
    return '/~'.$user.$matches[1];
  }

}

?>
