<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\BlogCategory;
use App\Models\BlogPost;
use App\Models\Comment;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use Symfony\Component\HttpFoundation\RateLimiter\RequestRateLimiterInterface;

class BlogController extends Controller
{
    //BlogCategory All Function
    public function AllBlogCategory(){
        $category=BlogCategory::latest()->get();
        return view('backend.blog.blog_category',compact('category'));
    }

    public function StoreBlogCategory(Request $request){
        BlogCategory::insert([
            'category_name'=>$request->category_name,
            'category_slug'=>strtolower(str_replace(' ','-',$request->category_name)),
        ]);
        $notification=array(
            'message'=>'Blog Category Create Successfully',
            'alert-type'=>'success'
        );
        return redirect()->route('all.blog.category')->with($notification);
    }

    public function EditBlogCategory($id){
        $category=BlogCategory::findOrFail($id);
        return response()->json($category);
    }

    public function UpdateBlogCategory(Request $request){
        $id=$request->cat_id;
        BlogCategory::findOrFail($id)->update([
            'category_name'=>$request->category_name,
            'category_slug'=>strtolower(str_replace(' ','-',$request->category_name)),
        ]);
        $notification=array(
            'message'=>'Blog Category Update Successfully',
            'alert-type'=>'success'
        );
        return redirect()->back()->with($notification);
    }

    public function DeleteBlogCategory($id){
        BlogCategory::findOrFail($id)->delete();
        $notification=array(
            'message'=>'Blog Category Delete Successfully',
            'alert-type'=>'success'
        );
        return redirect()->back()->with($notification);
    }



    //Post All Function
    public function AllPost(){
        $post=BlogPost::latest()->get();
        return view('backend.post.all_post',compact('post'));
    }

    public function AddPost(){
        $blogcat=BlogCategory::latest()->get();
        return view('backend.post.add_post',compact('blogcat'));
    }

    public function StorePost(Request $request){
        $image = $request->file('post_image'); //tên thẻ input
        //phải cài đặt gói thư viện Intervention/Image
        $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();    //1234.png
        Image::make($image)->resize(370, 250)->save('upload/post/' . $name_gen);
        $save_url = 'upload/post/' . $name_gen;

        BlogPost::insert([
            'blogcat_id'=>$request->blogcat_id,
            'user_id'=>Auth::id(),
            'post_title'=>$request->post_title,
            'post_slug'=>strtolower(str_replace(' ','-',$request->post_title)),
            'post_image'=>$save_url,
            'short_descp'=>$request->short_descp,
            'long_descp'=>$request->long_descp,
            'post_tags'=>$request->post_tags,
            'created_at'=>Carbon::now(),

        ]);
        $notification = array(
            'message' => 'Blog Post Insert Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('all.post')->with($notification);
    }

    public function EditPost($id){
        $blogcat=BlogCategory::latest()->get();
        $post=BlogPost::findOrFail($id);
        return view('backend.post.edit_post',compact('blogcat','post'));
    }

    public function UpdatePost(Request $request){
        $oldImage = $request->old_img;
        $id=$request->id;

        if ($request->file('post_image')){

            $image = $request->file('post_image'); //tên thẻ input
            //phải cài đặt gói thư viện Intervention/Image
            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();    //1234.png
            Image::make($image)->resize(370, 250)->save('upload/post/' . $name_gen);
            $save_url = 'upload/post/' . $name_gen;

            if (file_exists($oldImage)) {
                unlink($oldImage);
            }

            BlogPost::findOrFail($id)->update([
                'blogcat_id'=>$request->blogcat_id,
                'user_id'=>Auth::id(),
                'post_title'=>$request->post_title,
                'post_slug'=>strtolower(str_replace(' ','-',$request->post_title)),
                'post_image'=>$save_url,
                'short_descp'=>$request->short_descp,
                'long_descp'=>$request->long_descp,
                'post_tags'=>$request->post_tags,
                'updated_at'=>Carbon::now(),

            ]);
        }else{
            BlogPost::findOrFail($id)->update([
                'blogcat_id'=>$request->blogcat_id,
                'user_id'=>Auth::id(),
                'post_title'=>$request->post_title,
                'post_slug'=>strtolower(str_replace(' ','-',$request->post_title)),
                'short_descp'=>$request->short_descp,
                'long_descp'=>$request->long_descp,
                'post_tags'=>$request->post_tags,
                'updated_at'=>Carbon::now(),

            ]);
        }

        $notification = array(
            'message' => 'Post Update Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('all.post')->with($notification);
    }

    public function DeletePost($id){
        $post=BlogPost::findOrFail($id);
        $img=$post->post_image;
        unlink($img);

        BlogPost::findOrFail($id)->delete();
        $notification = array(
            'message' => 'Post Delete Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    public function BlogDetails($slug){
        $blog=BlogPost::where('post_slug',$slug)->first();
        $tags=$blog->post_tags;
        $tag_all=explode(',',$tags);
        $bcategory=BlogCategory::latest()->get();
        $dpost=BlogPost::latest()->limit(3)->get();
        return view('frontend.blog.blog_details',compact('blog','tag_all','bcategory','dpost'));
    }

    public function BlogCatList($id){
        $blog=BlogPost::where('blogcat_id',$id)->get();
        $breadcat=BlogCategory::where('id',$id)->first();

        $bcategory=BlogCategory::latest()->get();
        $dpost=BlogPost::latest()->limit(3)->get();
        return view('frontend.blog.blog_cat_list',compact('blog','breadcat','bcategory','dpost'));
    }

    public function BlogList(){
        $blog=BlogPost::latest()->get();

        $bcategory=BlogCategory::latest()->get();
        $dpost=BlogPost::latest()->limit(3)->get();
        return view('frontend.blog.blog_list',compact('blog','bcategory','dpost'));
    }

    public function StoreComment(Request $request){
        $pid=$request->post_id;
        Comment::insert([
            'user_id'=>Auth::id(),
            'post_id'=>$pid,
            'parent_id'=>null,
            'subject'=>$request->subject,
            'message'=>$request->message,
            'created_at'=>Carbon::now()
        ]);

        $notification = array(
            'message' => 'Comment Create Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    public function AdminBlogComment(){
        $comment=Comment::where('parent_id',null)->latest()->get();
        return view('backend.comment.comment_all',compact('comment'));
    }

    public function AdminCommentReply($id){
        $comment=Comment::where('id',$id)->first();
        return view('backend.comment.reply_comment',compact('comment'));
    }

    public function ReplyMessage(Request $request){
        $id=$request->id;
        $user_id=$request->user_id;
        $post_id=$request->post_id;

        Comment::insert([
            'user_id'=>$user_id,
            'post_id'=>$post_id,
            'parent_id'=>$id,
            'subject'=>$request->subject,
            'message'=>$request->message,
            'created_at'=>Carbon::now()
        ]);

        $notification = array(
            'message' => 'Reply Create Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
}
