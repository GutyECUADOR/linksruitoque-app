<div>
    @if (session()->has('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif

    <form wire:submit.prevent="anularFactura">
        <div>
            <label for="file">Indique número de factura:</label>
            <input id="numero_factura" wire:model="numero_factura" class="form-control mb-3">
        </div>

        @error('numero_factura')
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
             {{ $message }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
            </button>
        </div>
        @enderror

        <button type="submit" class="btn btn-primary">Anular Factura</button>
    </form>
</div>
