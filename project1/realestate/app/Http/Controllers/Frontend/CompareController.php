<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Compare;
use App\Models\User;
use App\Models\Wishlist;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CompareController extends Controller
{
    public function AddToCompare(Request $request,$property_id){

        //Check xem đã đăng nhập vào chưa
        if (Auth::check()){

            $exists=Compare::where('user_id',Auth::id())->where('property_id',$property_id)->first();

            if (!$exists){
                Compare::insert([
                    'user_id'=>Auth::id(),
                    'property_id'=>$property_id,
                    'created_at'=>Carbon::now(),
                ]);
                return response()->json(['success'=>'Successfully Added On Your Compare']);
            }else{
                return response()->json(['error'=>'This Property Has Already in Your Compare']);
            }
        }else{
            return response()->json(['error'=>'At First Login Your Account']);
        }
    }

    public function UserCompare(){
        $id=Auth::user()->id;
        $userData=User::find($id);
        return view('frontend.dashboard.compare',compact('userData'));
    }

    public function GetCompareProperty(){
        //property là tên function trong Wishlist -->dùng ajax phải có thêm with('property') thì mới in ra được dữ liệu
        //Vì dữ liệu trả về là json nên with('property') sẽ trả về thêm toàn bộ thông tin của property theo id wishlist
        $compare=Compare::with('property')-> where('user_id',Auth::id())->latest()->get();

        return response()->json($compare);
    }

    public function CompareRemove($id){
        Compare::where('user_id',Auth::id())->where('id',$id)->delete();
        return response()->json(['success'=>'Successfully Property Remove']);
    }

}
