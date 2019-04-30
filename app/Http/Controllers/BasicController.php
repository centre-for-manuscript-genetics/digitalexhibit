<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

class BasicController extends Controller
{
    /**
     * Show the profile for the given user.
     *
     * @param  array  $grid
     * @return Response
     */
    public function show($slug = null) {
        return view('layouts.basic', $this->getViewParams($slug, false));
    }

    public function showLimited($slug = null) {
        return view('layouts.basic', $this->getViewParams($slug, true));
    }

    private function getViewParams($slug, $isLimited) {
        $mainGridId = '57ced7828ec86doc453852088';
        $mainGrid = (object)collection('Grid')->findOne(['_id' => $mainGridId]);

        $mainGridNav = [
            'mainGrid'=> $mainGrid,
            'slide'=> null
        ];

        $data = (object)collection('Page')->findOne(['title_slug' => $slug]);

        return  [
            'data' => $data,
            'mainGridNav' => $mainGridNav,
            'isLimited' => $isLimited,
            'root' => $isLimited ? '/museum' : ''
        ];
    }
}