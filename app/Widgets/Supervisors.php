<?php

namespace App\Widgets;
namespace App\Http\Controllers\Auth;

use TCG\Voyager\Widgets\BaseDimmer;
use Illuminate\Support\Str;
use TCG\Voyager\Facades\Voyager;

class Supervisors extends BaseDimmer
{
    /**
     * The configuration array.
     *
     * @var array
     */
    protected $config = [];

    /**
     * Treat this method as a controller action.
     * Return view() or other content to display.
     */
    public function run()
    {
        $count = \App\Supervisor::count();
        $string = 'Supervisors';

        return view('voyager::dimmer', array_merge($this->config, [
            'icon'   => 'voyager-people',
            'title'  => "{$count} {$string}",
            'text'   => __('voyager::dimmer.post_text', ['count' => $count, 'string' => Str::lower($string)]),
            'button' => [
                'text' => 'Supervisors',
                'link' => route('voyager.supervisor-signup.index'),
            ],
            'image' => voyager_asset('images/widget-backgrounds/04.jpg'),
        ]));
    }

    /**
     * Determine if the widget should be displayed.
     *
     * @return bool
     */
    public function shouldBeDisplayed()
    {
        return app('VoyagerAuth')->user()->can('browse', Voyager::model('Post'));
    }
}
