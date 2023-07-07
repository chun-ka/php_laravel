<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\PropertyType;
use App\Models\State;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class StateController extends Controller
{
    public function AllState(){
        //phương thức hỗ trợ sẵn để lấy $types
        $state=State::latest()->get();
        return view('backend.state.all_state',compact('state'));
    }

    public function AddState(){
        return view('backend.state.add_state');
    }

    public function StoreState(Request $request){
        $image = $request->file('state_image'); //tên thẻ input
        //phải cài đặt gói thư viện Intervention/Image
        $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();    //1234.png
        Image::make($image)->resize(370, 275)->save('upload/state/' . $name_gen);
        $save_url = 'upload/state/' . $name_gen;

        State::insert([
            'state_name'=>$request->state_name,
            'state_image'=>$save_url,
        ]);
        $notification = array(
            'message' => 'State Insert Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('all.state')->with($notification);
    }

    public function EditState($id){
        $state=State::findOrFail($id);
        return view('backend.state.edit_state',compact('state'));
    }

    public function UpdateState(Request $request){
        $oldImage = $request->old_img;
        $id=$request->id;

        $image = $request->file('state_image');
        $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();    //1234.png
        Image::make($image)->resize(370, 275)->save('upload/state/' . $name_gen);
        $save_url = 'upload/state/' . $name_gen;

        if (file_exists($oldImage)) {
            unlink($oldImage);
        }

        State::findOrFail($id)->update([
            'state_name'=>$request->state_name,
            'state_image'=>$save_url,
        ]);

        $notification = array(
            'message' => 'State Update Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('all.state')->with($notification);
    }

    public function DeleteState($id){
        $state=State::findOrFail($id);
        $img=$state->state_image;
        unlink($img);
        State::findOrFail($id)->delete();
        $notification = array(
            'message' => 'State Delete Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
}
