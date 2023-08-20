<?php

namespace App\Http\Livewire;
use Livewire\Component;
use App\Models\Post;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Cookie;


class ShowPost extends Component
{
    use WithFileUploads;
    use WithPagination;

    public $perPage = 5;
    public $post;
    public $identificador;
    public $image;
    public $search;
    public $sort = 'id';
    public $direction = 'desc';
    public $open_edit = false;


    public function mount(){
        $this->open_edit = false;
        $this->identificador = rand();
        $this->post = new Post();
        $this->open_edit = Cookie::get('open_edit_modal', false);
    }

    public function updatingSearch(){
        $this->open_edit = false;
        $this->resetPage();

    }

    protected $rules = [
        'post.title' => 'required',
        'post.content' => 'required',
        //'image' => 'image|max:2048',
    ];

    protected $listeners = [
        'render' , 'delete'
    ];


    public function render()
    {
        $posts = Post::where('title', 'like', '%' . $this->search . '%')
            ->orwhere('content', 'like', '%' . $this->search . '%')
            ->orderBy($this->sort, $this->direction);

        $posts = $posts->paginate($this->perPage);

        return view('livewire.show-post',['posts' => $posts]);
    }

    public function order($sort){

        if ($this->sort == $sort){

            if ($this->direction == 'desc'){
                $this->direction = 'asc';

            }else{
                $this->direction = 'desc';

            }
        }else{
            $this->sort = $sort;
            $this->direction = 'asc';
        }
    }

    public function edit(Post $post )
    {
        $this->post  = $post;
        $this->open_edit = true;
    }

    public function update(){
    $this->validate();

        if($this->image){
            Storage::delete([$this->post->image]);
            $this->post->image = $this->image->store('posts');
        }

        $this->post->save();

        $this->reset(['open_edit','image']);

        $this->identificador = rand();

        $this->emit('alert', 'El post se actualizó satisfactoriamente');
    }

    public function delete(Post $post)
    {

        if($this->image){
          Storage::delete([$this->post->image]);
          $post->delete();

        }else{
            $post->delete();
        }

    }


}
