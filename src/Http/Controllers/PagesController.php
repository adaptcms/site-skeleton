<?php

namespace Adaptcms\Site\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Arr;

use Adaptcms\Pages\Models\Page;
use App\Http\Controllers\Controller;

use Route;

class PagesController extends Controller
{
  /**
  * Show
  *
  * @param Request $request
  *
  * @return Response
  */
  public function show(Request $request)
  {
    // find page
    $routeName = Route::currentRouteName();

    $slug = Arr::last(explode('.', $routeName));

    $page = Page::where('slug', '=', $slug)
      ->with([ 'packageFields', 'packageFields.field' ])
      ->firstOrFail();

    // transform package field data
    $page = $page->transformCustomData($page, $page->packageFields);

    return $this->renderUiView('pages/' . $page->slug, compact('page'));
  }

  /**
  * Home
  *
  * @param Request $request
  *
  * @return Response
  */
  public function home(Request $request)
  {
    // get page
    $page = Page::where('name', '=', 'home')
      ->with([ 'packageFields', 'packageFields.field' ])
      ->first();

    // transform package field data
    $page = $page->transformCustomData($page, $page->packageFields);

    return $this->renderUiView('pages/home', compact('page'));
  }
}
