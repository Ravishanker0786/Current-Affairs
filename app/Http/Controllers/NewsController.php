<?php

namespace App\Http\Controllers;
use App\News;
use App\Topic;

use Illuminate\Http\Request;


    /**
     * @OA\Get(
     * path="/news/get",
     * summary="/news/get",
     * description="/news/get",
     * operationId="/news/get",
     * tags={"news"},
    *      @OA\Parameter(
     *         name="search",
     *         in="query",
     *         description="search",
     *         required=true,
     *      ),
     *      @OA\Parameter(
     *         name="cat",
     *         in="query",
     *         description="search",
     *         required=true,
     *      ),
     *      @OA\Parameter(
     *         name="type",
     *         in="query",
     *         description="search",
     *         required=true,
     *      ),
     * @OA\Response(
     *    response=422,
     *    description="Wrong credentials response",
     *    @OA\JsonContent(
     *       @OA\Property(property="message", type="string", example="Sorry, wrong email address or password. Please try again")
     *        )
     *     )
     * )
    */

class NewsController extends Controller
{

    public function index(Request $request){

        $news = News::whereNotNull('id');

        if ($request->has('uno')) 
        {
            $news->whereIn('id',$request->uno);
        }


        if ($request->has('search')) 
        {
            $news->where('title','like','%'.$request->search.'%');
        }

        if ($request->has('type')) {
            if ($request->type == "alll") 
            {
                
            }

            if ($request->type == "cat") 
            {
                $news->where('tid',$request->cat);
            }

            if ($request->type == "login") 
            {
                return "logged In";
            }
        }

        $news_all = $news->join('topics','topics.tid','=','news_table.tid')->orderBy('news_table.id','DESC')->paginate(5);

        if ($request->has('web')) {
            
            $html = view('components.news-view',['news'=> $news_all])->render();
            $topic = Topic::all();
            $option = '';
            if (!empty($topic)) {
                foreach($topic as $key => $val){
                    $option .= '<option value="'.$val->tid.'">'.$val->tname.'</option>';
                }
            }
            return ['response' => 'ok','html' => $html,'topic'=>$option];
        }
        
        return ['response' => 'ok','body' => $news_all,'count' => count($news_all)];
    }


    public function store(Request $request){
        if ($request->has('type')) {
            $notify = 0;
            if ($request->has('id') && (!empty($request->id))) 
            {
                $news = News::find($request->id);
                
                if ($news) 
                {
                    $notify = 1;
                    $news->rdate = date ('Y-m-d H:i:s', strtotime($request->date));
                }else{
                    $notify = 0;
                }
                
            }else{
                $news = new News();
                $notify = 0;
                $news->rdate = date ('Y-m-d H:i:s', strtotime($request->date));
            }

            $news->title = str_replace("'", "\'",$request->title);
            $news->imageurl = str_replace("'", "\'",$request->imageurl);
            $news->newsurl = str_replace("'", "\'",$request->newsurl);
            $news->description = str_replace("'", "\'",$request->description);
            $news->tid = str_replace("'", "\'",$request->tid);

            try{
                if ($news->save()) 
                {
                    if ($notify == 0) 
                    {
                       $res =  $this->notification($request->description,$request->title,$request->imageurl);
                       return $res;
                    }else{
                        return ['response' => 'ok'];
                    }
                }
            }catch(\Exception $e){
                return ['response' => $e->getMessage()];
            }

        }
   }

    public function notification($body,$title,$image){
        // API access key from Google API's Console
        define( 'API_ACCESS_KEY', 'AAAAELraqiI:APA91bExTVpODigkFvEWyiu0y1GYvGwBrYRYEkxPBP0QicLSWbcXovvb0H3bjCztZ-KRVjj5GJ3i_EAt18RjUTtnvBOosWxwoD9pV0zUe4m1xMEeOJqWC33NtOVic0pc-YAtWhM53Mdi' );
        $registrationIds = '/topics/test';
        // prep the bundle
        $msg = array
        (
            'body'      => $body,
            'title'     => $title,
            "image"     => $image,
            'vibrate'   => 1,
            'sound'     => 1,
        );

        $fields = array
        (
            'to'             => $registrationIds,
            'notification'   => $msg
        );

        $headers = array
        (
            'Authorization: key=' . API_ACCESS_KEY,
            'Content-Type: application/json'
        );

        $ch = curl_init();
        curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );
        curl_setopt( $ch,CURLOPT_POST, true );
        curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
        curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
        curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
        curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields ) );
        $result = curl_exec($ch );
        curl_close( $ch );

        return ['response' => 'ok','result' => $result];
    }
    
}
