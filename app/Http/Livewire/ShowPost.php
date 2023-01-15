<?php

namespace App\Http\Livewire;
use Livewire\Component;
use App\Models\Post;


class ShowPost extends Component
{
    public function render()
    {
        $posts = Post::all();
        return view('livewire.show-post', compact('posts'));
    }
}
