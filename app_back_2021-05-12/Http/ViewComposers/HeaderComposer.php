<?php

namespace App\Http\ViewComposers;

use Illuminate\ {
    View\View,
    Support\Facades\Route
};

class HeaderComposer
{
    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        // Breadcrumb
        $elements = config ('breadcrumbs');
        $segments = request()->segments();
        // dd($elements, $segments);
        foreach ($segments as $segment) {
            if (!is_numeric($segment)) {
                // dd($elements);
                $elements[$segment]['name'] = __('admin.breadcrumbs.' . $elements[$segment]['name'] . '-name');
                if($segment === end($segments)) {
                    $elements[$segment]['url'] = '#';
                }
                $breadcrumbs[] = $elements[$segment];
            }
        }
        // dd(Route::currentRouteName());
        // Title
        $title = config('titles.' . Route::currentRouteName());
        // echo $title;die;
        $title = __('admin.titles.' . $title);
        $base_url = url('/');

        // Notifications
        $countNotifications = 0;
        // $countNotifications = auth()->user()->unreadNotifications()->count();
        $view->with(compact('breadcrumbs', 'title', 'countNotifications', 'base_url'));
    }
}