<?php

namespace App\Http\Livewire;
use Livewire\Component;
use App\Models\Post;


class ShowPost extends Component
{

    public $search = 'h';

    public function render()
    {
        $posts = Post::where('title', 'like', '%' . $this->search . '%')
            ->where('title', 'like', '%' . $this->search . '%')->get();

        return view('livewire.show-post', compact('posts'));
    }

    
}