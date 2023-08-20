<div>

        @if ($agregar_post)
        <x-jet-dialog-modal wire:model="agregar_post">
            <x-slot name="title">
                Crear Nuevo Post
            </x-slot>

            <x-slot name="content">

                <div wire:loading  wire:target="image" class="mb-4 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                    <strong class="font-bold">Imagen Cargando..!</strong>
                    <span class="block sm:inline">Espere un momento hasta que se haya procesado.</span>
                </div>

                @if ($image)
                    <img class="mb-4" src="{{$image->temporaryUrl()}}">
                @endif

                <div class="mb-4">
                    <x-jet-label value="titulo del post"/>
                    <x-jet-input type="text" class="w-full" wire:model.defer="title"/>
                    <x-jet-input-error for="title"/>

                </div>
                <div class="mb-4">
                    <x-jet-label value="contenido del post"/>
                    <textarea wire:model.defer="content" class="form-control w-full" rows="6"></textarea>
                    <x-jet-input-error for="content"/>
                </div>
                <div>
                    <input type="file" wire:model="image" id="{{$identificador}}">
                    <x-jet-input-error for="image"/>
                </div>

            </x-slot>

            <x-slot name="footer">

                <x-jet-secondary-button wire:click="$set('agregar_post', false)" class="mr-2">
                    Cancelar
                </x-jet-secondary-button>

                <x-jet-danger-button wire:click="save" wire:loading.attr="disabled" wire:target="save, image" class="disabled">
                    Crear Post
                </x-jet-danger-button>
                {{--<span> wire:loading wire:target="save"Cargando.....</span>--}}
            </x-slot>
        </x-jet-dialog-modal>
        @endif

        <x-jet-secondary-button class="bg-blue-400" wire:click="openModal" wire:loading.attr="disabled" wire:target="openModal">
            Crear Post
        </x-jet-secondary-button>

</div>
