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

  public function profile() {
    $menu = MenuLink::getMenu();
    return view($this->getView('profile'), compact('menu'));
  }

  public function orders() {
    $menu = MenuLink::getMenu();
    return view($this->getView('orders'), compact('menu'));
  }

  private function getView($str) {
    return 'themes.' . $this->theme . '.pages.user.' . $str;
  }
}
