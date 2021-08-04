<?php

namespace App\Http\Livewire;

use App\Models\Category;
use Livewire\Component;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use App\Models\Post;
use Livewire\WithFileUploads;

class CreatePost extends Component
{
    public $image,$title,$body,$category_id;
    use WithFileUploads;
    public function render()
    {
        $category=Category::all();

        return view('livewire.create-post',['category'=>$category ]);
    }

    public function  save()
    {
        try{
     $this->validate([

        'title'         => 'required|max:255',
        'category'         => 'required',
        'body'         => 'required',
        'image'         => 'nullable|mimes:jpg,jpeg,gif,png|max:20000',
     ]);
     $data['title']=$this->title;
     $data['category_id']=$this->category_id;
     $data['body']=$this->body;
     $data['user_id']=auth()->id();

     $image=$this->file('image');
     if($image){
         $filename=Str::slug($this ->title).'.'.$image->getClientOriginalExtension();
         $path=public_path('/assets/image/'.$filename);
         Image::make($image->getRealPath())->save($path,100);
         $data['image']=$filename;

     }
     Post::create($data);
     return redirect()-route('livewire.posts');
    }

    catch(\Exception $e){
        return redirect()->back()->withErrors(['error'=>$e->getMessage()]);
    }
    }
  public function  return_to_posts(){
      return redirect()->route('livewire.posts');
  }


}
