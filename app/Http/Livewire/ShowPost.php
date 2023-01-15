<?php

namespace App\Http\Livewire;
use Livewire\Component;
use App\Models\Post;


class ShowPost extends Component
{

    public $search;

    public function mount()
    {
        $this->search = 'Hello World!';
    }

    public function render()
    {
        $posts = Post::all();

        return view('livewire.show-post', compact('posts'));
    }
}
