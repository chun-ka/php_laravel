<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Facility;
use App\Models\MultiImage;
use App\Models\Property;
use App\Models\PropertyMassage;
use App\Models\Schedule;
use App\Models\User;
use Carbon\Carbon;
use http\Exception\BadUrlException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IndexController extends Controller
{
    public function PropertyDetails($id, $slug)
    {
        $multiImage = MultiImage::where('property_id', $id)->get();
        $property = Property::findOrFail($id);

        $type_id = $property->ptype_id;
        //Lấy ra danh sách Property có id không phải là id tham số
        $relatedProperty = Property::where('ptype_id', $type_id)->where('id', '!=', $id)->orderBy('id', 'desc')->limit(3)->get();

        $amenities = $property->amenities_id;
        $property_amen = explode(',', $amenities);
        $facility = Facility::where('property_id', $id)->get();
        return view('frontend.property.property_details', compact('property', 'multiImage', 'property_amen', 'facility', 'relatedProperty'));
    }

    public function PropertyMessage(Request $request)
    {
        $pid = $request->property_id;
        $aid = $request->agent_id;

        if (Auth::check()) {
            PropertyMassage::insert([
                'user_id' => Auth::id(),
                'agent_id' => $aid,
                'property_id' => $pid,
                'msg_name' => $request->msg_name,
                'msg_email' => $request->msg_email,
                'msg_phone' => $request->msg_phone,
                'message' => $request->message,
                'created_at' => Carbon::now(),
            ]);
            $notification = array(
                'message' => 'Send Message Successfullly ',
                'alert-type' => 'success'
            );
            return redirect()->back()->with($notification);

        } else {
            $notification = array(
                'message' => 'Please Login Your Account ',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }

    }

    public function AgentDetails($id)
    {
        $agent = User::findOrFail($id);
        $property = Property::where('agent_id', $id)->get();
        $featured = Property::where('featured', 1)->limit(3)->get();
        $rentproperty = Property::where('status', 1)->where('property_status', 'rent')->get();
        $buyproperty = Property::where('status', 1)->where('property_status', 'buy')->get();

        return view('frontend.agent.agent_details', compact('agent', 'property', 'featured', 'rentproperty', 'buyproperty'));
    }

    public function AgentDetailsMessage(Request $request)
    {
        $aid = $request->agent_id;

        if (Auth::check()) {
            PropertyMassage::insert([
                'user_id' => Auth::id(),
                'agent_id' => $aid,
                'msg_name' => $request->msg_name,
                'msg_email' => $request->msg_email,
                'msg_phone' => $request->msg_phone,
                'message' => $request->message,
                'created_at' => Carbon::now(),
            ]);
            $notification = array(
                'message' => 'Send Message Successfullly ',
                'alert-type' => 'success'
            );
            return redirect()->back()->with($notification);

        } else {
            $notification = array(
                'message' => 'Please Login Your Account ',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }

    }

    public function RentProperty()
    {
        $buyproperty = Property::where('status', 1)->where('property_status', 'buy')->get();
        $rentproperty = Property::where('status', 1)->where('property_status', 'rent')->paginate(3);
        return view('frontend.property.rent_property', compact('rentproperty', 'buyproperty'));
    }

    public function BuyProperty()
    {
        $rentproperty = Property::where('status', 1)->where('property_status', 'rent')->get();
        $buyproperty = Property::where('status', 1)->where('property_status', 'buy')->paginate(3);
        return view('frontend.property.buy_property', compact('buyproperty', 'rentproperty'));
    }

    public function PropertyType($id)
    {
        $rentproperty = Property::where('status', 1)->where('property_status', 'rent')->get();
        $buyproperty = Property::where('status', 1)->where('property_status', 'buy')->get();
        $property = Property::where('status', 1)->where('ptype_id', $id)->paginate(3);
        return view('frontend.property.property_type', compact('property', 'rentproperty', 'buyproperty'));
    }

    public function StateDetails($id)
    {
        $property = Property::where('status', 1)->where('state', $id)->paginate(3);
        $rentproperty = Property::where('status', 1)->where('property_status', 'rent')->get();
        $buyproperty = Property::where('status', 1)->where('property_status', 'buy')->get();
        return view('frontend.property.state_property', compact('property', 'rentproperty', 'buyproperty'));
    }

    public function BuyPropertySearch(Request $request)
    {
        $rentproperty = Property::where('status', 1)->where('property_status', 'rent')->get();
        $buyproperty = Property::where('status', 1)->where('property_status', 'buy')->get();

//        $request->validate(['search' => 'required']);
        $item = $request->search;
        $sstate = $request->state;
        $stype = $request->ptype_id;

        //type,pstate là phương thức chuyển đổi trong class Property
        $property = Property::where('property_name', 'like', '%' . $item . '%')->where('property_status', 'buy')->with('type', 'pstate')
            ->whereHas('pstate', function ($q) use ($sstate) {
                $q->where('state_name', 'like', '%' . $sstate . '%');
            })
            ->whereHas('type', function ($q) use ($stype) {
                $q->where('type_name', 'like', '%' . $stype . '%');
            })->paginate(3);

//        $property = Property::where('property_name', 'like', '%' . $item . '%')->where('property_status', 'buy')
//            ->where('state',$sstate)->where('ptype_id',$stype)->paginate(3);

        return view('frontend.property.property_search', compact('property', 'rentproperty', 'buyproperty'));
    }

    public function RentPropertySearch(Request $request)
    {
        $rentproperty = Property::where('status', 1)->where('property_status', 'rent')->get();
        $buyproperty = Property::where('status', 1)->where('property_status', 'buy')->get();

//        $request->validate(['search' => 'required']);
        $item = $request->search;
        $sstate = $request->state;
        $stype = $request->ptype_id;

        $property = Property::where('property_name', 'like', '%' . $item . '%')->where('property_status', 'rent')->with('type', 'pstate')
            ->whereHas('pstate', function ($q) use ($sstate) {
                $q->where('state_name', 'like', '%' . $sstate . '%');
            })
            ->whereHas('type', function ($q) use ($stype) {
                $q->where('type_name', 'like', '%' . $stype . '%');
            })->paginate(3);


        return view('frontend.property.property_search', compact('property', 'rentproperty', 'buyproperty'));
    }

    public function AllPropertySearch(Request $request)
    {
        $rentproperty = Property::where('status', 1)->where('property_status', 'rent')->get();
        $buyproperty = Property::where('status', 1)->where('property_status', 'buy')->get();

        $property_status = $request->property_status;
        $sstate = $request->state;
        $stype = $request->ptype_id;
        $bedrooms = $request->bedrooms;
        $bathrooms = $request->bathrooms;



        $property = Property::where('status', 1)->where('bedrooms', 'like', '%' . $bedrooms . '%' )->where('bathrooms', 'like', '%' . $bathrooms . '%')
            ->where('property_status', 'like', '%' . $property_status . '%' )->with('type', 'pstate')
            ->whereHas('pstate', function ($q) use ($sstate) {
                $q->where('state_name', 'like', '%' . $sstate . '%');
            })
            ->whereHas('type', function ($q) use ($stype) {
                $q->where('type_name', 'like', '%' . $stype . '%');
            })->paginate(10);

        return view('frontend.property.property_search', compact('property', 'rentproperty', 'buyproperty'));
    }


    //Schedule Message
    public function StoreSchedule(Request $request){
        $pid=$request->property_id;
        $aid=$request->agent_id;
        if (Auth::check()){

            Schedule::insert([
                'user_id'=>Auth::id(),
                'property_id'=>$pid,
                'agent_id'=>$aid,
                'tour_date'=>$request->tour_date,
                'tour_time'=>$request->tour_time,
                'message'=>$request->message,
                'created_at'=>Carbon::now()
            ]);
            $notification = array(
                'message' => 'Send Request Successfullly ',
                'alert-type' => 'success'
            );
            return redirect()->back()->with($notification);

        }else{
            $notification = array(
                'message' => 'Please Login Your Account ',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }
    }

}
