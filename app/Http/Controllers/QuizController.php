<?php

namespace App\Http\Controllers;
use App\Quiz;

use Illuminate\Http\Request;

class QuizController extends Controller
{
    public function index(Request $request){
        $quiz = Quiz::groupBy('qno')->get();

        if ($request->has('web')) {

            if ($request->has('qno')) {
                $quiz = Quiz::where('qno',$request->qno)->get();
                $html = view('components.quiz-ques-view',['quiz'=> $quiz,'qno' => $request->qno])->render();
                return ['response' => 'ok','html' => $html];
            }
            $html = view('components.quiz-view',['quiz'=> $quiz])->render();
            return ['response' => 'ok','html' => $html];
        }

        return ['response' => 'ok','body' => $quiz,'count' => count($quiz)];
    }

    public function store (Request $request){
        $qno = $request->qno;
        $qid = $request->qid;
        $ques = $request->ques;
        $option1 = $request->option1;
        $option2 = $request->option2;
        $option3 = $request->option3;
        $option4 = $request->option4;
        $ans = $request->ans;

        if (!empty($qno)) {
            $quiz = Quiz::whereNotIn('qid',$qid)->where('qno',$qno)->delete();
        }else{
            $qno = Quiz::max('qno') + 1;
        }
        foreach ($ques as $key => $value) {
            if (!empty($ques[$key])) {
                if (!empty($qid[$key])) {
                    $quiz = Quiz::find($qid[$key]);
                    $quiz->ques = $ques[$key];
                    $quiz->option1 = $option1[$key];
                    $quiz->option2 = $option2[$key];
                    $quiz->option3 = $option3[$key];
                    $quiz->option4 = $option4[$key];
                    $quiz->ans = $ans[$key];
                    $quiz->qno = $qno;
                    $quiz->save();

                }else{
                    if ((!empty($ques[$key])) && (!empty($option1[$key])) && (!empty($option2[$key])) && (!empty($option3[$key])) && (!empty($option4[$key])) && (!empty($ans[$key]))) {
                        $quiz = new Quiz();
                        $quiz->ques = $ques[$key];
                        $quiz->option1 = $option1[$key];
                        $quiz->option2 = $option2[$key];
                        $quiz->option3 = $option3[$key];
                        $quiz->option4 = $option4[$key];
                        $quiz->ans = $ans[$key];
                        $quiz->qno = $qno;
                        $quiz->save();
                    }
                }
                
            }
        }
        
        return ['response' => 'ok'];
    }


    public function create()
    {
        $html = view('components.quiz-ques-view',['quiz'=> []])->render();
        return $html;
    }
}
