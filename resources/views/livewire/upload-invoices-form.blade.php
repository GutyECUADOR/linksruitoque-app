<div>
    @if (session()->has('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif

    <form wire:submit.prevent="import" enctype="multipart/form-data" class="">
        <div>
            <label for="file">Subir archivo Excel:</label>
            <input type="file" id="file" wire:model="file" class="form-control mb-3">
        </div>

        @error('file')
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
             {{ $message }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
            </button>
        </div>
        @enderror


        <button type="submit" class="btn btn-primary">Subir y Procesar</button>
    </form>
</div>
