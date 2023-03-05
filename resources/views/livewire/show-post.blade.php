<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    {{-- $search --}}

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">

        <div class="px-6 py-4 flex items-center">

            {{-- <input wire:model="search" type="text">
            <!--x-inputs.text wire:model="search"/--> --}}
            <x-jet-input class="flex-1 mr-4" placeholder="Escriba que quiere buscar" type=text wire:model="search" />
            {{-- para utilizar los componentes de jetstrem se utiliza la ruta jet --}}
            @livewire('create-post')
        </div>

        @if ($posts->count())

            <table class="min-w-full leading-normal">
                <thead>
                    <tr>
                        <th class="w-24 cursor-pointer px-6 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider"
                            wire:click="order('id')">
                            ID
                            {{-- Sort --}}
                            @if ($sort == 'id')
                                @if ($direction == 'asc')
                                    <i class="fas fa-sort-alpha-up-alt float-right mt-1"></i>
                                @else
                                    <i class="fas fa-sort-alpha-down-alt float-right mt-1"></i>
                                @endif
                            @else
                                <i class="fas fa-sort float-right mt-1"></i>
                            @endif
                        </th>
                        <th class="cursor-pointer px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider"
                            wire:click="order('title')">
                            Title
                            {{-- Sort --}}
                            @if ($sort == 'title')
                                @if ($direction == 'asc')
                                    <i class="fas fa-sort-alpha-up-alt float-right mt-1"></i>
                                @else
                                    <i class="fas fa-sort-alpha-down-alt float-right mt-1"></i>
                                @endif
                            @else
                                <i class="fas fa-sort float-right mt-1"></i>
                            @endif
                        </th>
                        <th class="cursor-pointer px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider"
                            wire:click="order('content')">
                            Content
                            {{-- Sort --}}
                            @if ($sort == 'content')
                                @if ($direction == 'asc')
                                    <i class="fas fa-sort-alpha-up-alt float-right mt-1"></i>
                                @else
                                    <i class="fas fa-sort-alpha-down-alt float-right mt-1"></i>
                                @endif
                            @else
                                <i class="fas fa-sort float-right mt-1"></i>
                            @endif
                        </th>

                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($posts as $item)
                        <tr>
                            <td class="px-5 py-5 ">
                                <p class="text-gray-900 text-sm">
                                    {{ $item->id }}
                                </p>
                            </td>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                <p class="text-gray-900 text-sm">
                                    {{ $item->title }}
                                </p>
                            </td>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                <p class="text-gray-900 text-sm">
                                    {{ $item->content }}
                                </p>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                {{-- <p class="text-gray-900 whitespace-no-wrap">
                        @livewire('edit-post', ['post' => $post], key($post->id)) --}}
                                <a class="btn btn-green" wire:click="edit({{ $item }})">
                                    <i class="fas fa-edit"></i>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <div class="px-6 py-4 flex justify-center items-center h-screen">
                <h2>No existe ningun registro coincidente</h2>
            </div>
        @endif

        @if ($posts->hasPages())
            <div class="px-6 py-3">
                {{ $posts->links() }}
            </div>
        @endif

    </div>

    <x-jet-dialog-modal wire:model="open_edit">

        <x-slot name='title'>
            Editar el post
        </x-slot>

        <x-slot name='content'>
            <div wire:loading wire:target="image"
                class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                <strong class="font-bold">Imagen Cargando..!</strong>
                <span class="block sm:inline">Espere un momento hasta que se haya procesado.</span>
            </div>

            @if ($image)
                <img class="mb-4" src="{{$image->temporaryUrl() }}">
            @else
                <img class="mb-5" src="{{ asset('storage/'.$post->image) }}" alt="">
                {{-- Storage::url($post->image --}}
                
            @endif

            <div class="mb-4">
                <x-jet-label value="Titulo del post" />
                <x-jet-input wire:model="post.title" type="text" class="w-full" />
            </div>

            <div>
                <x-jet-label value="Contenido del post" />
                <textarea wire:model="post.content"rows="6" class="form-control w-full"></textarea>
            </div>
            <div>
                <input type="file"wire:model="image" id="{{ $identificador }}">
                <x-jet-input-error for="image" />
            </div>
        </x-slot>

        <x-slot name='footer'>
            <x-jet-secondary-button wire:click="$set('open_edit', false)">
                Cancelar
            </x-jet-secondary-button>

            <x-jet-danger-button wire:click="update" wire:loading.attr="disabled" class="disabled">
                Actualizar
            </x-jet-danger-button>
        </x-slot>
    </x-jet-dialog-modal>
</div>
