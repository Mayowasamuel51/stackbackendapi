<?php

namespace App\Http\Controllers\API;

use SplFileInfo;
use App\Models\comment;
use App\Models\Creategig;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;


class GetController extends Controller
{
    //
    public function searchQuery(Request $request)
    {
    }
    public function showanswer($id)
    {
        $id = Creategig::find($id)->posts()->where('user_id', $id)->latest()->get();
        if ($id) {
            return response()->json([
                'status' => 200,
                // 'data' => $id =  comment::where('user_id', $id)->get(),
                'data' => $id
            ]);
        }else{
            return response()->json([
                'status' =>404,
                // 'data' => $id =  comment::where('user_id', $id)->get(),
                'data'=>'error'
            ]);
        }
    }
    public function createanswer(Request $request, $question_martic, $title)
    {
        $titles = Creategig::where('ptitle', '=', $title)->where('question_martic', '=', $question_martic)->first();
        $comment = new comment;
        $comment->user_id = $titles->id;
        $comment->problem_title = $request->problem_title;
        $comment->descritpion = $request->descritpion;
        $comment->save();


        if ($question_martic) {
            return response()->json([
                'status' => 200,
                'title' => $titles,
                'answer' => $comment
            ]);
        } else {
            return response()->json([
                'data' => 'NOTHING FOUND CHECK AGAIN'
            ]);
        }
    }

    public function searchTitle(Request $request,  $title)
    {
        $titles = Creategig::where('ptitle',  $title)->get();
        // '=',$title)->get();
        // also display the answers
        // add comment to this answer....
        // get the id and descritpion, with title  in order to fully or create an answer .....
        if ($titles) {
            return response()->json([
                'status' => 200,
                'title' => $titles,
            ]);
        } else {
            return response()->json([
                'data' => 'NOTHING FOUND CHECK AGAIN'
            ]);
        }
    }





    public function allQuestion()
    {
        // get total questions 
        $total_q = DB::table('creategigs')->select('ptitle')->count();
        $user = DB::table('creategigs')
            ->select(
                'language_category as language',
                'question_martic as question',
                'problem_descritpion as problem_note',
                'id as ids',
                'ptitle as problem_title',
                'created_at as date_created',
                'portfolio_url as url '
            )
            ->latest()
            ->get();
        return response()->json([
            'status' => 200,
            'total' => $total_q,
            'data' => $user
        ]);
    }

    public function answerOne($id, $ptitle)
    {
        // $comment = Creategig::find($id)->posts()->where('user_id', $id)->get();
        $comment = Creategig::where('ptitle', $ptitle)->find($id)->posts()->latest()->get();
        if ($comment) {
            return response()->json([
                'status' => 200,
                'data' => $comment
            ]);
        } else {
            return response()->json([
                'status' => 401,
                'data' => 'NOT FOUND A PROPER ID'
            ]);
        }
    }
}

































// $all_q =  DB::table('creategigs')->select('language_category')->latest()->get();

      
// $users = DB::select('select language_category,ptitle,created_at,portfolio_url   from creategigs');
// 
// $titles = DB::table('creategigs')->pluck('language_category', 'ptitle');

        // $comment = comment::whereBelongsTo($titles)->get();
        // $comment = Creategig::find()->posts();

        // $comment = comment::has('comments','>=', 1)->where('user_id', 1)->get();
        //    $comment =  DB::table('comments')->select('descritpion')->get();
        // 'like', '%'.$title.'%')->get();