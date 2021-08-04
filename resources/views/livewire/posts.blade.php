
<div>
    <div class="row justify-content-center">

        <div class="col-12">

            <div class="card">
                <div class="card-header d-flex">
                    <b>Posts</b>
                    <button  class="btn btn-primary btn-sm ml-auto" type="button" wire:click="create_post">Create Post</a>
                </div>
                <div class="card-body">

                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                         <tr>
                         <th>Image</th>
                         <th>Title</th>
                         <th>Owner</th>
                         <th>Category</th>
                         <th>Action</th>
                         </tr>
                            </thead>
                            <tbody>
                                 @foreach ($posts as $post )
                                     <tr>
                                         @if ($post->image != '')

                                         <td><img src="{{ asset('assets/image/'.$post->image) }}" alt="{{ $post->title }}" width="100"></td>
                                         @endif
                             <td>
                                 <a  href="javascript:void(0);" wire:click="show_post({{ $post->id }})">{{ $post->title }}</a>
                                </td>
                                <td>{{ $post->user->name }}</td>
                                <td>{{ $post->category->name }}</td>
                                <td>
                                    <a  href="Javascript:void(0);" wire:click="edit_post({{ $post->id }})"  class="btn btn-primary btn-sm">Edit</a>
                                 <a href="Javascript:void(0);"  wire:click="delete_post({{ $post->id }})" class="btn btn-danger btn-sm" onclick="confirm('Are you sure?') return false; ">Delete</a>

                                 </td>
                                 </tr>
                                 @endforeach
                            </tbody>

                             </table>
                             {{-- <div class="float-right">
                                {!! $posts->Links() !!}
                                </div> --}}
                    </div>

                </div>
                </div>

        </div>
    </div>




</div>

