<?php

namespace App\Http\Controllers;

use App\MenuLink;
use App\Theme;
use Illuminate\Http\Request;

class VladanController extends Controller {
  private $theme;

  public function __construct() {
    $this->theme = Theme::getTheme();
  }

  public function render($view) {
    $menu = MenuLink::getMenu();
    return view($this->getView($view), compact('menu'));
  }

  private function getView($str) {
    return 'themes.' . $this->theme . '.pages.user.' . $str;
  }
}
