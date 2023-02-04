<div>
    <x-jet-danger-button wire:click="$set('open', true)" wire:loading.attr="disabled" wire:target="$set('open', true)">
        Crear un nuevo Post
    </x-jet-danger-button>


    <x-jet-dialog-modal wire:model="open">
        <x-slot name="title">
            Crear Nuevo Post
        </x-slot>

        <x-slot name="content">
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
        </x-slot>

        <x-slot name="footer">

            <x-jet-secondary-button wire:click="$set('open', false)">
                Cancelar
            </x-jet-secondary-button>

            <x-jet-danger-button wire:click="save" wire:loading.attr="disabled" wire:target="save">
                Crear Post
            </x-jet-danger-button>
            {{--<span> wire:loading wire:target="save"Cargando.....</span>--}}
        </x-slot>

    </x-jet-dialog-modal>
</div>
