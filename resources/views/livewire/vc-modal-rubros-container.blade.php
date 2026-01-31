<div>
    <div wire:ignore.self class="modal fade" id="showModalRubros" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" >
            <div class="modal-content modal-content border-0">
                
                <div class="modal-header p-3 bg-light">
                    <h5 class="modal-title" id="exampleModalLabel">
                        <span> {{$titulo}} &nbsp;</span>
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="close-modal"></button>
                </div>
                <form autocomplete="off" wire:submit.prevent="">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title flex-grow-1 mb-0 text-primary"><i
                                class="ri-user-follow-fill align-middle me-1 text-success"></i>
                                Datos de Empleado</h5>
                        </div>
                    </div>
                    <div class="modal-body">
                        @livewire('vc-modal-rubros', [], key('modal-rubros'))
                    </div>                                       
                    <div class="modal-footer">
                        <div class="hstack gap-2 justify-content-end">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" wire:click.prevent="add('N')" class="btn btn-success" id="add-btn">Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
