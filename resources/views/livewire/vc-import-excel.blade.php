<div>
    <!--<form method="post"  action="{{ url('/import_excel/import') }}">-->
    <form method="post" enctype="multipart/form-data">
    <div class="hstack text-nowrap gap-2 col-md-6">
        <input class="form-control" type="file" name="uploadFile" wire:model.defer="select_file"/>
        <!--<input type="submit" name="upload" class="btn btn-primary" value="Upload">-->
        <button type="button" wire:click="import()" class="btn btn-primary add-btn" data-bs-toggle="modal" id="create-btn"
            data-bs-target=""><i class="ri-file-copy-fill align-bottom me-1"></i> Upload
        </button>
        </div>
    </form>
</div>
