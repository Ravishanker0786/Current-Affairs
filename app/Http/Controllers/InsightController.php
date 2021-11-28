<?php

namespace App\Http\Controllers;
use App\Insight;
use Illuminate\Http\Request;

class InsightController extends Controller
{


    public function index(Request $request){
        $insight = Insight::get();
        if ($request->has('web')) {

            if ($request->has('in_id')) {
                $insight = Insight::where('in_id',$request->in_id)->first();
                $html = view('components.insight-inner-view',['insight'=> $insight])->render();
                return ['response' => 'ok','html' => $html];
            }
            $html = view('components.insight-view',['insight'=> $insight])->render();
            return ['response' => 'ok','html' => $html];
        }

        return ['response' => 'ok','body' => $insight,'count' => count($insight)];
    }


    public function store (Request $request){
        $in_background = $request->in_background;
        $in_data = $request->in_data;

        $Insight = new Insight();

        if (!empty($request->in_id)) {
            $Insight = $Insight->where('in_id',$request->in_id)->first();
        }

        $Insight->in_background = $in_background;
        $Insight->in_data = $in_data;

        if ($Insight->save()) {
            return ['response' => 'ok'];
        }                 
    }

    public function create()
    {
        $html = view('components.insight-inner-view',['insight'=> []])->render();
        return $html;
    }
}
