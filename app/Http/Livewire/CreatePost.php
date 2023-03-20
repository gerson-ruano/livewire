<?php

namespace App\Http\Livewire;

use App\Models\Post;
use Livewire\Component;
use Livewire\WithFileUploads;

class CreatePost extends Component
{
    use WithFileUploads;
    public $agregar_post = false;
    public $title; 
    public $content; 
    public $image; 
    public $identificador;

    public function mount(){
        $this->identificador = rand();
    }

    protected $rules = [
        'title' => 'required',   //max:10',
        'content' => 'required',
        'image' => 'required|image|max:2048'  //min:50',
    ];

    /*
    public function updated($propertyName){
        $this->validateOnly($propertyName);
    }*/

    public function save(){

        $this->validate();
        $image = $this->image->store('posts');

        Post::create([
            'title'=>$this->title,
            'content'=>$this->content,
            'image' => $image
        ]);

        $this->reset(['agregar_post','title','content', 'image']);

        $this->identificador = rand();
        $this->emitTo('show-post','render');
        $this->emit('alert','El post se creo satisfactoriamente');
    }

    public function render()
    {
        return view('livewire.create-post');
    }
    
}
