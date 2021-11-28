<?php

namespace App\Http\Controllers;
use App\Topic;

use Illuminate\Http\Request;

class TopicController extends Controller
{
    public function index(Request $request)
    {
        if ($request->has('type')) {
            if ($request->type == "all") {
                $topic = Topic::all();
                if ($topic) {
                    return ['response' => 'ok','body' => $topic];
                }
            }
        }

        if($request->has('web')){
            $topic = Topic::all();
                if ($topic) {
                    $html = view('components.topic-view',['topic'=> $topic])->render();
                    return ['response' => 'ok','html' => $html];
                }
        }
    }


    public function store(Request $request)
    {
        if ($request->has('type')) {
            if ($request->has('tid') && (!empty($request->tid))) {
                $topic = Topic::find($request->tid);
            }else{
                $topic = new Topic();
            }

            $topic->tname = str_replace("'", "\'",$request->tname);
            $topic->url = str_replace("'", "\'",$request->url);

            try{
                if ($topic->save()) {
                    return ['response' => 'ok'];
                }
            }catch(\Exception $e){
                return ['response' => $e->getMessage()];
            }

        }
    }
}
