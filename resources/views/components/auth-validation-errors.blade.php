@props(['errors'])

@if ($errors->any())

    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>{{ __('Whoops! Something went wrong.') }}</strong> Revisa lo siguiente:

        <ul class="text-start">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>

        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">

        </button>
    </div>
@endif
