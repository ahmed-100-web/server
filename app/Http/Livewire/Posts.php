<?php

namespace App\Http\Livewire;

use App\Models\Post;
use Livewire\Component;
use Livewire\WithPagination;
class Posts extends Component
{

    use WithPagination;

    public function render()
    {

        $posts= Post::with(['user','category'])->orderBy('id','desc')->paginate(10);
        return view('livewire.posts',['posts'=>$posts]);
    }



    public function create_post()
    {
        return redirect()->route('livewire.create');
    }

    public function edit_post($id)
    {

    }

    public function delete_post($id)
    {

    }

    public function show_post($id)
    {
              return $id;
     }
}
