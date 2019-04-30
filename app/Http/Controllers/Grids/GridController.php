<?php

namespace App\Http\Controllers\Grids;

use App\Http\Controllers\Controller;

class GridController extends Controller
{
    /**
     * Show the profile for the given user.
     *
     * @param  array  $grid
     * @return Response
     */
    public function show($slug = null){
        return view('layouts.grid', $this->getViewParams($slug, false));
    }

    public function showLimited($slug = null){
        return view('layouts.grid', $this->getViewParams($slug, true));
    }

    private function sortByOrder($a, $b) {
        return $a['custom-order'] - $b['custom-order'];
    }

    private function getViewParams($slug, $isLimited) {

        $mainGridId = '57ced7828ec86doc453852088';
        $mainGrid = (object)collection('Grid')->findOne(['_id' => $mainGridId]);
        $grid = $slug == null
            ? $mainGrid
            : (object)collection('Grid')->findOne(['name_slug' => $slug]);

        $allGrids = (object)collection('Grid')->find()->toArray();
        $grids = [];

        foreach ($allGrids as $key => $value) {
            $grids[] = [
                'isActive' => ($value['_id'] === $grid->_id),
                'isMainGrid' => ($value['_id'] === $mainGridId),
                'name' => $value['name'],
                'slug' => "/" . $value['name_slug'],
                'order' => $value['custom-order']
            ];
        }

        usort($grids, function($a, $b) {
            return $a['order'] - $b['order'];
        });

        $mainGridNav = [
            'mainGrid'=> $mainGrid,
            'slide'=> $this->getRelatedSlideLink($grid, $mainGrid)
        ];

        $slides=[];

        if(isset($grid->slides)){
            foreach($grid->slides as $slideId){
                $slideContent = $this->modifyModel((object)collection('Slide')->findOne(['_id' => $slideId]));

                $slide = [
                    'content' => $slideContent,
                    'impress' => (object)collection('Impress attributes')->findOne(['_id' => $slideContent->impress_configuration])
                ];

                array_push($slides, $slide);
            }
        }

        return [
            'grid' => $grid,
            'grids' => $grids,
            'slides' => $slides,
            'isMainGrid' => $grid->_id == $mainGridId,
            'mainGridNav' => $mainGridNav,
            'isLimited' => $isLimited,
            'root' => $isLimited ? '/museum' : '',
        ];
    }

    private function getRelatedSlideLink($currentGrid, $mainGrid) {

        if($currentGrid->_id == $mainGrid->_id) {
            return '';
        }

        $relatedSlides = collection('Slide')->find(['subgrid' => $currentGrid->_id]);

        if(count($relatedSlides) < 1){
            return '';
        }

        foreach ($relatedSlides as $slide) {
            $slide = (object)$slide;
            if(in_array($slide->_id, $mainGrid->slides)){
                return '#/' . $slide->title_slug;
            }
        }

        return '';
    }

    private function modifyModel($slideContent){
        $modifiedSlideContent = $slideContent;

        if(isset($slideContent->text)) {
            $modifiedSlideContent->text = cockpit('cockpit')->markdown($slideContent->text);
        }

        if(isset($slideContent->subgrid)){
            $grid = (object)collection('Grid')->findOne(['_id' => $slideContent->subgrid]);

            if(isset($grid)) {
                $modifiedSlideContent->subgrid = "/".$grid->name_slug;
            }
        }

        return $modifiedSlideContent;
    }
}