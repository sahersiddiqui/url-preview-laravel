<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Embed\Embed;
use Validator;


class UrlPreview extends Controller
{
    public function index(){
        $data['html'] = "<h1>Url Preview</h1><img src='' height='200px' width='300px' />";
        return view('welcome')->with($data);
    }

    public function fetchUrlDetails(Request $request){
        $validate  = Validator::make($request->all(),[
            'url' => ['required','regex:/^((ftp|http|https):\/\/)?(www.)?(?!.*(ftp|http|https|www.))[a-zA-Z0-9_-]+(\.[a-zA-Z]+)+((\/)[\w#]+)*(\/\w+\?[a-zA-Z0-9_]+=\w+(&[a-zA-Z0-9_]+=\w+)*)?$/'],

        ]);
        if($validate->passes()){
            $data['info'] = Embed::create($request->url);
            return view('url-preview')->with($data);
        } else {
            return redirect()->back()->withErrors($validate);
        }
        
    }
}
