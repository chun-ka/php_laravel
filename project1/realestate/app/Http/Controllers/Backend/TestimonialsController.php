<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Testimonials;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class TestimonialsController extends Controller
{
    public function AllTestimonials(){
        $testimonials=Testimonials::latest()->get();
        return view('backend.testimonials.all_testimonials',compact('testimonials'));
    }

    public function AddTestimonials(){
        return view('backend.testimonials.add_testimonials');
    }

    public function StoreTestimonials(Request $request){
        $image = $request->file('image'); //tên thẻ input
        //phải cài đặt gói thư viện Intervention/Image
        $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();    //1234.png
        Image::make($image)->resize(100, 100)->save('upload/testimonials/' . $name_gen);
        $save_url = 'upload/testimonials/' . $name_gen;

        Testimonials::insert([
            'name'=>$request->name,
            'position'=>$request->position,
            'message'=>$request->message,
            'image'=>$save_url,
        ]);
        $notification = array(
            'message' => 'Testimonials Insert Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('all.testimonials')->with($notification);
    }

    public function EditTestimonials($id){
        $testimonials=Testimonials::findOrFail($id);
        return view('backend.testimonials.edit_testimonials',compact('testimonials'));
    }

    public function UpdateTestimonials(Request $request){
        $oldImage = $request->old_img;
        $id=$request->id;
        if ($request->file('image')){
            $image = $request->file('image');
            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();    //1234.png
            Image::make($image)->resize(100, 100)->save('upload/testimonials/' . $name_gen);
            $save_url = 'upload/testimonials/' . $name_gen;

            if (file_exists($oldImage)) {
                unlink($oldImage);
            }

            Testimonials::findOrFail($id)->update([
                'name'=>$request->name,
                'position'=>$request->position,
                'message'=>$request->message,
                'image'=>$save_url,
            ]);
        }else{
            Testimonials::findOrFail($id)->update([
                'name'=>$request->name,
                'position'=>$request->position,
                'message'=>$request->message,
            ]);

        }

        $notification = array(
            'message' => 'Testimonials Update Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('all.testimonials')->with($notification);
    }

    public function DeleteTestimonials($id){
        $test=Testimonials::findOrFail($id);
        $img=$test->image;
        unlink($img);
        Testimonials::findOrFail($id)->delete();
        $notification = array(
            'message' => 'State Delete Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
}
