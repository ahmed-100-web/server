<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
class PostController extends Controller
{

    public function __construct(){
        $this->middleware('auth');
    }

    public function livewire_index()
    {
        $posts= Post::with(['user','category'])->orderBy('id','desc')->paginate(10);
        return view('frontend.index_live',['posts'=>$posts]);
    }

    public function livewire_create()
    {


        $categoryy=Category::all();
      return view('frontend.create_live',['category'=>$categoryy]);
    }








    public function index()
    {
      $posts=  Post::with(['user','category'])->orderBy('id','desc')->paginate(10);
        return view('frontend.index',compact('posts'));
    }

    public function create()
    {
        $category=Category::all();
        return view('frontend.create',compact('category'));
    }

    public function store(Request $request)
    {
        $validate=Validator($request->all(),[

            'title'         => 'required|max:255',
            'category'         => 'required',
            'body'         => 'required',
            'image'         => 'nullable|mimes:jpg,jpeg,gif,png|max:20000',
        ]);
        if($validate->fails()){
            return redirect()->back()->withErrors($validate)->withInput();
        }
       $data['title']=$request->title;
       $data['category_id']=$request->category;
       $data['body']=$request->body;
       $data['user_id']=auth()->id();
      $image=$request->file('image');
      if($image){
          $filename=Str::slug($request ->title).'.'.$image->getClientOriginalExtension();
          $path=public_path('/assets/image/'.$filename);
          Image::make($image->getRealPath())->save($path,100);
          $data['image']=$filename;

      }
      Post::create($data);
      return redirect()->route('post.index')->with([
          'message'  => 'Post created Successfully',
          'alert-type'  =>  'success',
      ]);

    }

    public function show($id)
    {
        $post=Post::with(['user','category'])->whereId($id)->first();
        if($post){

        return view('frontend.show',compact('post'));

        }
        return redirect()->route('post.index')->with([
            'message'=>         'You Have not Permission to continue this process',
            'alert-type'  => 'danger',
        ]);
    }


    public function edit($id)
    {
        $post=Post::whereId($id)->first();
        if($post){
        $category=Category::all();
        return view('frontend.edit',compact('post','category'));
        }

        return redirect()->route('post.index')->with([
            'message'=>         'You Have not Permission to continue this process',
            'alert-type'  => 'success',
        ]);
    }


    public function update(Request $request, $id)
    {
        $post=Post::whereId($id)->first();
        $validate=Validator($request->all(),[

            'title'         => 'required|max:255',
            'category'         => 'required',
            'body'         => 'required',
            'image'         => 'nullable|mimes:jpg,jpeg,gif,png|max:20000',
        ]);
        if($validate->fails()){
            return redirect()->back()->withErrors($validate)->withInput();
        }
       $data['title']=$request->title;
       $data['category_id']=$request->category;
       $data['body']=$request->body;


       if($image=$request->file('image')){
        if(File::exists('assets/image/' . $post->image)){
            unlink('assets/image/' . $post->image);
        }
      $image=$request->file('image');
      if($image){
          $filename=Str::slug($request ->title).'.'.$image->getClientOriginalExtension();
          $path=public_path('/assets/image/'.$filename);
          Image::make($image->getRealPath())->save($path,100);
          $data['image']=$filename;

      }
      $post->update($data);
      return redirect()->route('post.index')->with([
          'message'  => 'Post Updated Successfully',
          'alert-type'  =>  'success',
      ]);

    }


}


    public function destroy($id)
    {
        $post=Post::whereId($id)->first();
        if($post->image != ''){
            if(File::exists('assets/image/'.$post->image)){
                unlink('assets/image/'.$post->image);
            }
        }
        $post->delete();
        return redirect()->route('post.index')->with([
            'message'  => 'Post Delete Successfully',
            'alert-type'  =>  'danger',
        ]);

    }



}
