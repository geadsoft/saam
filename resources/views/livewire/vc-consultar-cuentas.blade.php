<div style="position: relative;">

    <form autocomplete="off">

    <input

        type="text"

        class="form-control"

        placeholder="Buscar Cuentas Contables..."

        wire:model="query"

        wire:keydown.escape="load"

        wire:keydown.tab="load"

        wire:keydown.arrow-up="decrementHighlight"

        wire:keydown.arrow-down="incrementHighlight"

        wire:keydown.enter="selectContact"

    />

 

    <div wire:loading class="absolute z-10 w-full bg-white rounded-t-none shadow-lg list-group">

        <div class="list-item">Searching...</div>

    </div>

 

    @if(!empty($query))

        <div class="fixed top-0 bottom-0 left-0 right-0" wire:click="load"></div>

 
        
        <div class="absolute z-10 w-full bg-white rounded-t-none shadow-lg list-group">
            

            @if(!empty($contacts))
                <div style="height: 200px;  overflow-y: scroll;">
                @foreach($contacts as $i => $contact)
                
                <div class="row">
                    <div class="col-sm-3">
                    <a class="" href="#" wire:click.prevent="selectContact({{ $contact->Codigo }})">{{ $contact->Codigo }}</a>
                    </div>
                    <div class="col-sm-9">
                    <a class="" href="#" wire:click.prevent="selectContact({{ $contact->Codigo }})">{{ $contact->Nombre }}</a>
                    </div>
                </div>
                
                @endforeach
                </div>
            @else
                @if(empty($ctaselect))
                <div class="list-item">No results!</div>
                @endif
            @endif

        </div>
        

    @endif

    </form>

</div>

