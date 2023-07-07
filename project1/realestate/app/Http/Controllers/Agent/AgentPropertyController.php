<?php

namespace App\Http\Controllers\Agent;

use App\Http\Controllers\Controller;
use App\Mail\ScheduleMail;
use App\Models\Amenities;
use App\Models\Facility;
use App\Models\MultiImage;
use App\Models\PackagePlan;
use App\Models\Property;
use App\Models\PropertyMassage;
use App\Models\PropertyType;
use App\Models\Schedule;
use App\Models\State;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Intervention\Image\Facades\Image;

class AgentPropertyController extends Controller
{
    public function AgentAllProperty()
    {
        $id = Auth::user()->id;
        $property = Property::where('agent_id', $id)->latest()->get();
        return view('agent.property.all_property', compact('property'));
    }

    public function AgentAddProperty()
    {
        $propertytype = PropertyType::latest()->get();
        $amenities = Amenities::latest()->get();
        $pstate = State::latest()->get();


        $id=Auth::user()->id;
        $property=User::where('role','agent')->where('id',$id)->first();
        $pcount=$property->credit;
//        dd($pcount);

        if ($pcount==1||$pcount==7){
            return redirect()->route('buy.package');
        }else{
            return view('agent.property.add_property', compact('propertytype', 'amenities','pstate'));

        }

    }

    public function AgentStoreProperty(Request $request)
    {
        $id=Auth::user()->id;
        $uid=User::findOrFail($id);
        $nid=$uid->credit;

        //Lấy về một mảng id và chyển thành chuỗi dùng implode
        $amen = $request->amenities_id;
        $amenites = implode(",", $amen);
//        dd($amenites);

        $pcode = IdGenerator::generate(['table' => 'properties', 'field' => 'property_code', 'length' => 5, 'prefix' => 'PC']);

        //Xử lý ảnh và lưu vào thư mục
        $image = $request->file('property_thambnail'); //tên thẻ input
        //phải cài đặt gói thư viện Intervention/Image
        $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();    //1234.png
        Image::make($image)->resize(370, 250)->save('upload/property/thambnail/' . $name_gen);
        $save_url = 'upload/property/thambnail/' . $name_gen;


        //$property_id là khóa phụ nằm trong 2 bảng MultiIma và Facility
        $property_id = Property::insertGetId([
            'ptype_id' => $request->ptype_id,
            'amenities_id' => $amenites,
            'property_name' => $request->property_name,
            'property_slug' => strtolower(str_replace('', '-', $request->property_name)),
            'property_code ' => $pcode,
            'property_status' => $request->property_status,

            'lowest_price' => $request->lowest_price,
            'max_price' => $request->max_price,
            'short_descp' => $request->short_descp,
            'long_descp' => $request->long_descp,
            'bedrooms' => $request->bedrooms,
            'bathrooms' => $request->bathrooms,
            'garage' => $request->garage,
            'garage_size' => $request->garage_size,

            'property_size' => $request->property_size,
            'property_video' => $request->property_video,
            'address' => $request->address,
            'city' => $request->city,
            'state' => $request->state,
            'postal_code' => $request->postal_code,

            'neighborhood' => $request->neighborhood,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'featured' => $request->featured,
            'hot' => $request->hot,
            'agent_id' => Auth::user()->id,
            'status' => 1,
            'property_thambnail' => $save_url,
            'created_at' => Carbon::now(),
        ]);


        /// Multiple Image Upload From Here///
        $images = $request->file('multi_img');
        foreach ($images as $img) {
            $make_name = hexdec(uniqid()) . '.' . $img->getClientOriginalExtension();    //1234.png
            Image::make($img)->resize(770, 520)->save('upload/property/multi-image/' . $make_name);
            $uploadPath = 'upload/property/multi-image/' . $make_name;

            MultiImage::insert([
                'property_id' => $property_id,
                'photo_name' => $uploadPath,
                'created_at' => Carbon::now(),
            ]);
        } //end foreach
        ///End Multiple Image Upload From Here///


        /// Facilities Add From Here///
        $facilities = Count($request->facility_name); //->đếm số Facilities
        if ($facilities != null) {
            for ($i = 0; $i < $facilities; $i++) {
                $fcount = new Facility();
                $fcount->property_id = $property_id;
                $fcount->facility_name = $request->facility_name[$i];  //tên thẻ nằm trong thẻ form có tên facility_name[]
                $fcount->distance = $request->distance[$i];
                $fcount->save();
            }

        }
        /// End Facilities///


         User::where('id',$id)->update([
             'credit'=>DB::raw('1 + '.$nid),
         ]);


        $notification = array(
            'message' => 'Property Insert Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('agent.all.property')->with($notification);
    }

    public function AgentEditProperty($id)
    {

        $facility = Facility::where('property_id', $id)->get();
        $property = Property::findOrFail($id);
        $pstate = State::latest()->get();


        //Chuyển một chuỗi id ở trên lại thành một mảng
        $type = $property->amenities_id;
        $property_ami = explode(",", $type);


        //Lấy ra toàn bộ đối tượng của bảng MultiImage với điều kiện property_id=id;
        //MultiImage là bảng phụ
        $multiImage = MultiImage::where('property_id', $id)->get();


        $propertytype = PropertyType::latest()->get();
        $amenities = Amenities::latest()->get();
        return view('agent.property.edit_property', compact('property', 'propertytype', 'amenities', 'property_ami',
            'multiImage', 'facility','pstate'));
    }

    public function AgentUpdateProperty(Request $request)
    {
        $amen = $request->amenities_id;
        $amenites = implode(",", $amen);

        $property_id = $request->id;
        Property::findOrFail($property_id)->update([
            'ptype_id' => $request->ptype_id,
            'amenities_id' => $amenites,
            'property_name' => $request->property_name,
            'property_slug' => strtolower(str_replace('', '-', $request->property_name)),
            'property_status' => $request->property_status,

            'lowest_price' => $request->lowest_price,
            'max_price' => $request->max_price,
            'short_descp' => $request->short_descp,
            'long_descp' => $request->long_descp,
            'bedrooms' => $request->bedrooms,
            'bathrooms' => $request->bathrooms,
            'garage' => $request->garage,
            'garage_size' => $request->garage_size,

            'property_size' => $request->property_size,
            'property_video' => $request->property_video,
            'address' => $request->address,
            'city' => $request->city,
            'state' => $request->state,
            'postal_code' => $request->postal_code,

            'neighborhood' => $request->neighborhood,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'featured' => $request->featured,
            'hot' => $request->hot,
            'agent_id' => Auth::user()->id,
            'updated_at' => Carbon::now(),
        ]);
        $notification = array(
            'message' => 'Property Update Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('agent.all.property')->with($notification);
    }

    public function AgentUpdatePropertyThambnail(Request $request)
    {
        $proId = $request->id;
        $oldImage = $request->old_omg;

        $image = $request->file('property_thambnail');
        $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();    //1234.png
        Image::make($image)->resize(370, 250)->save('upload/property/thambnail/' . $name_gen);
        $save_url = 'upload/property/thambnail/' . $name_gen;

        if (file_exists($oldImage)) {
            unlink($oldImage);
        }

        Property::findOrFail($proId)->update([
            'property_thambnail' => $save_url,
            'updated_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'Property Image Thambnail Update Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    public function AgentUpdatePropertyMultiimage(Request $request)
    {
        $imgs = $request->multi_img;

        foreach ($imgs as $id => $img) {
            $imgDel = MultiImage::findOrFail($id);
            unlink($imgDel->photo_name);

            $make_name = hexdec(uniqid()) . '.' . $img->getClientOriginalExtension();    //1234.png
            Image::make($img)->resize(770, 520)->save('upload/property/multi-image/' . $make_name);
            $uploadPath = 'upload/property/multi-image/' . $make_name;

            MultiImage::where('id', $id)->update([
                'photo_name' => $uploadPath,
                'updated_at' => Carbon::now(),
            ]);
        }//End foeach

        $notification = array(
            'message' => 'Property Multi Image Update Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    public function AgentPropertyMultiImageDelete($id)
    {
        $oldImg = MultiImage::findOrFail($id);
        unlink($oldImg->photo_name);
        MultiImage::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Property Multi Image Delete Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }


    public function AgentStoreNewMultiimage(Request $request)
    {
        $new_multi = $request->imageid;
        $image = $request->file('multi_img');

        $make_name = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();    //1234.png
        Image::make($image)->resize(770, 520)->save('upload/property/multi-image/' . $make_name);
        $uploadPath = 'upload/property/multi-image/' . $make_name;

        MultiImage::insert([
            'property_id' => $new_multi,
            'photo_name' => $uploadPath,
            'created_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'Property Multi Image Create Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }


    public function AgentUpdatePropertyFacility(Request $request)
    {
        $property_id = $request->id;
        if ($request->facility_name == null) {
            return redirect()->back();
        } else {
            Facility::where('property_id', $property_id)->delete();
            $facilities = Count($request->facility_name);

            for ($i = 0; $i < $facilities; $i++) {
                $fcount = new Facility();
                $fcount->property_id = $property_id;
                $fcount->facility_name = $request->facility_name[$i];  //tên thẻ nằm trong thẻ form có tên facility_name[]
                $fcount->distance = $request->distance[$i];
                $fcount->save();
            }
        }

        $notification = array(
            'message' => 'Facility Update Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    public function AgentDetailsProperty($id)
    {

        $facility = Facility::where('property_id', $id)->get();
        $property = Property::findOrFail($id);

        $type = $property->amenities_id;
        $property_ami = explode(",", $type);

        $multiImage = MultiImage::where('property_id', $id)->get();


        $propertytype = PropertyType::latest()->get();
        $amenities = Amenities::latest()->get();
        return view('agent.property.details_property', compact('property', 'propertytype', 'amenities', 'property_ami',
            'multiImage', 'facility'));
    }

    public function AgentDeleteProperty($id)
    {
        $property = Property::findOrFail($id);
        unlink($property->property_thambnail);

        Property::findOrFail($id)->delete();

        $image = MultiImage::where('property_id', $id)->get();
        foreach ($image as $img) {
            unlink($img->photo_name);
            MultiImage::where('property_id', $id)->delete();
        }

        $facilitiesData = Facility::where('property_id', $id)->get();
        foreach ($facilitiesData as $item) {
            $item->facility_name;
            Facility::where('property_id', $id)->delete();
        }


        $notification = array(
            'message' => 'Property Delete Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }



//  ==============  Agent Buy Package ============

    public function BuyPackage()
    {
        return view('agent.package.buy_package');
    }

    public function BuyBusinessPlan(){
        $id=Auth::user()->id;
        $user=User::findOrFail($id);
        return view('agent.package.business_plan',compact('user'));
    }

    public function StoreBusinessPlan(Request $request){
        $id=Auth::user()->id;

        $uid=User::findOrFail($id);
        $nid=$uid->credit;

        PackagePlan::insert([
            'user_id'=>$id,
            'package_name'=>'Business',
            'package_credits'=>'3',
            'invoice'=>'ERS'.mt_rand(10000000,99999999),    //tạo một chuỗi kí tự và số bắt đầu ERS
            'package_amount'=>'20',
            'created_at'=>Carbon::now(),
        ]);


        User::where('id',$id)->update([
            'credit'=>DB::raw('3 + '.$nid),
        ]);

        $notification = array(
            'message' => 'You have purchase Basic Package Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('agent.all.property')->with($notification);
    }


    public function BuyProfessionalPlan(){
        $id=Auth::user()->id;
        $user=User::findOrFail($id);
        return view('agent.package.professional_plan',compact('user'));
    }

    public function StoreProfessionalPlan(Request $request){
        $id=Auth::user()->id;

        $uid=User::findOrFail($id);
        $nid=$uid->credit;

        PackagePlan::insert([
            'user_id'=>$id,
            'package_name'=>'Professional',
            'package_credits'=>'10',
            'invoice'=>'ERS'.mt_rand(10000000,99999999),    //tạo một chuỗi kí tự và số bắt đầu ERS
            'package_amount'=>'50',
            'created_at'=>Carbon::now(),
        ]);


        User::where('id',$id)->update([
            'credit'=>DB::raw('10 + '.$nid),
        ]);

        $notification = array(
            'message' => 'You have purchase Professional Package Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('agent.all.property')->with($notification);
    }

    public function PackageHistory(){
        $id=Auth::user()->id;
        $packagehistory=PackagePlan::where('user_id',$id)->get();
        return view('agent.package.package_history',compact('packagehistory'));
    }


//  ==============  In file PDF ============
    public function AgentPackageInvoice($id){

        $packagehistory=PackagePlan::where('id',$id)->first();

        $pdf = Pdf::loadView('agent.package.package_history_invoice', compact('packagehistory'))->setPaper('a4')->setOption([
            'tempDir'=>public_path(),
            'chroot'=>public_path(),
        ]);
        return $pdf->download('invoice.pdf');
    }



    // ======== Message =========
    public function AgentPropertyMessage(){
        $id=Auth::user()->id;
        $usermsg=PropertyMassage::where('agent_id',$id)->get();
        return view('agent.message.all_message',compact('usermsg'));
    }

    public function AgentMessageDetails($id){
        $uid=Auth::user()->id;
        $usermsg=PropertyMassage::where('agent_id',$uid)->get();

        $msgdetails=PropertyMassage::findOrFail($id);
        return view('agent.message.message_details',compact('usermsg','msgdetails'));
    }


    // ======== Schedule Request Route =========//
    public function AgentScheduleRequest(){
        $id=Auth::id();
        $usermsg=Schedule::where('agent_id',$id)->get();
        return view('agent.schedule.schedule_request',compact('usermsg'));
    }

    public function AgentDetailsSchedule($id){
        $schedule=Schedule::findOrFail($id);
        return view('agent.schedule.schedule_details',compact('schedule'));
    }

    public function AgentUpdateSchedule(Request $request){
        $sid=$request->id;
        Schedule::findOrFail($sid)->update([
            'status'=>1,
        ]);

        // Start Send Email
        $sendmail=Schedule::findOrFail($sid);
        $data=[
          'tour_date'=>$sendmail-> tour_date,
          'tour_time'=>$sendmail-> tour_time,
        ];

        Mail::to($request->email)->send(new ScheduleMail($data));

        // End Send Email


        $notification = array(
            'message' => 'You have Confirm Schedule Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('agent.schedule.request')->with($notification);

    }
}
