<?php

namespace App\Http\Controllers\API;

use App\Models\Html;
use App\Models\Creategig;
use App\Models\Javascript;
use Illuminate\Http\Request;
use GuzzleHttp\Promise\Create;
use App\Http\Controllers\Controller;
use App\Models\comment;
use App\Models\developercomment;
use Faker\Core\File;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class FormController extends Controller
{
    public function comments($id)
    {
        $comment = Creategig::find($id)->posts()->where('user_id', $id)->get();
        if ($comment) {
            return response()->json([
                'data' => 'found',
                'info' => $comment
            ]);
        } else {
            return response()->json([
                'status' => 401,
                'info' => 'not found'
            ]);
        }
    }
    public function developercomment(Request $request, $id)
    {
        $find = Creategig::find($id);
        $comment = new comment;
        $comment->user_id = $request->find;
        $comment->problem_descritpion = $request->problem_descritpion;
        $comment->$find->posts()->save($comment);
        //  $done =$request->user()->developer()->create($request->only('problem_descritpion'));
        if ($find) {
            return response()->json([
                'data' =>  ' found',
                // 'info' =>     $find->post()->save($comment)
            ]);
        } else {
            return response()->json([
                'status' => 'not found'
            ]);
        }
    }
    public function image()
    {
        $data = Creategig::all();
        return response()->json([
            'status' => 200,
            'data' => Creategig::all()
        ]);
    }
    public function storegig(Request $request)
    {
        $validator =   Validator::make($request->all(), [

            'problem_title' => 'required',
            'language_category' => 'required',
            'problem_descritpion' => 'required',

            // 'images' => 'required',
            // 'portfolio_url' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'errors' => $validator->messages(),
            ]);
        }

        $data = new Creategig;
        $data->name = $request->name;
        $data->email = $request->email;
        $data->portfolio_url = $request->portfolio_url;
        $data->language_category = $request->language_category;
        $data->problem_descritpion = $request->problem_descritpion;
        $data->ptitle =  $request->problem_title;
        $data->phone =  $request->phone;

        $data->question_martic =  $request->question_martic;


        if ($request->hasFile('images')) {
            $file =  $request->file('images');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move('uploads/images/', $filename);
            $data->images = $filename;
        }
        $data->save();
        return response()->json([
            'status' => 200,
            'data' => 'done'
        ]);
    }
    public function storehtml(Request $request)
    {
        $validator =   Validator::make($request->all(), [
            'name' => 'required',
            'ptitle' => 'required',
            'language_category' => 'required',
            'problem_descritpion' => 'required',
            'email' => 'required',
            // 'image_screenshot'=>'required',
            'portfolio_url' => 'required'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 422,
                'errors' => $validator->messages(),
            ]);
        }
        if ($request->hasFile('image')) {
            $image =  $request->file('affix_right');
            $extension_r = $image->getClientOriginalExtension();
            $image_new_r = time() . "." . $extension_r;
            $image->move('uploads/images/', $image_new_r);
        }

        Html::create([
            'name' => $request->name,
            'email' => $request->email,
            'image_screenshot' => $image,
            'portfolio_url' => $request->portfolio_url,
            'language_category' => $request->language_category,
            'problem_descritpion' => $request->problem_descritpion,
            'ptitle' => $request->ptitle,


        ]);
        return response()->json([
            'data' => 'done'
        ]);
    }
}





   // if($request->hasFile('image')){
        //     $destination_path = "public/images/products";
        //     $image = $request->file('image');
        //     $image_name = $image->getClientOriginalName();
        //     $path = $request->file('image')->storeAs($destination_path, $image_name);
        //     $validator['image'] = $image_name;
        // }
        // $img = $request->image;
        // $folderPath = "public/uploads/";
        // $fileName =  uniqid().'.png';
        // $file  = $folderPath.$fileName;
        // Storage::put($file, 'fil');
        // // $path = Storage::putFile($img, new File("public/uploads/"));
        // $newimage = time().'-'.$request->name.'.'.$request->image->extension_loaded();