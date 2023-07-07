<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\ChatMessage;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use function Symfony\Component\String\u;

class ChatController extends Controller
{
    public function SendMsg(Request $request){
        $request->validate([
           'msg'=>'required',
        ]);

        ChatMessage::create([
           'sender_id'=>Auth::id(),
            'receiver_id'=>$request->receiver_id,
            'msg'=>$request->msg,
            'created_at'=>Carbon::now(),
        ]);
        return response()->json(['message'=>'Message Send Successfully']);
    }

    public function GetAllUser(){
        $chats =ChatMessage::orderBy('id','desc')->where('sender_id',Auth::id())->orWhere('receiver_id',Auth::id())->get();
        $users=$chats->flatMap(function ($chat){   //phương thức có sẵn trong laravel
            if ($chat->sender_id===Auth::id()){
                return [$chat->sender,$chat->receiver];
            }
            return [$chat->receiver,$chat->sender];
        })->unique();  //chỉ trả về một dữ liệu, dùng $users[0] thì không đúng
        return $users;
    }

    public function UserMessageById($userId){
        $user=User::find($userId);
        if ($user){
            $messages=ChatMessage::where(function ($q) use ($userId){
                $q->where('sender_id',Auth::id());
                $q->where('receiver_id',$userId);
            })->orWhere(function ($q) use ($userId){
                $q->where('sender_id',$userId);
                $q->where('receiver_id',Auth::id());
            })->with('user')->get();
            return response()->json([
                'user'=>$user,
                'messages'=>$messages,
            ]);
        }else{
            abort(404); //Hiển thị ra trang 404
        }
    }

    public function AgentLiveChat(){
        return view('agent.message.live_chat');
    }
}
