<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(){
        $title = 'Chào anh trung';
        $x=10;
//        return view('product.index',compact('title','x'));
        $name="anh trung";
//        return view('product.index')->with('name',$name);
        $test=[
            'name'=>'trung',
            'age'=>26,
            'address'=>'ĐL'
        ];
//        return view('product.index',compact('test'));
        return view('product.index',[
            'test'=>$test
        ]);
    }

    public function detail($id){
        return view('product.index',[
            'product'=>[
                'name'=>'iphone',
                'year'=>2015
            ]
        ]);
    }

}

