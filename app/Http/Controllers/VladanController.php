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

  public function index() {
    $menu = MenuLink::getMenu();
    return view('themes.' . $this->theme . '.pages.user.profile', compact('menu'));
  }
}
