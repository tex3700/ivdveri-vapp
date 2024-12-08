<x-appshell::card accent="success">
    <x-slot:title>{{ __('Images') }}</x-slot:title>

    @can('create media')
        <div class="card">
            <div class="card-body p-0 d-flex align-items-center">
                <div class="p-3 text-bg-secondary rounded-start">
                    <div class="align-content-center text-center">
                        {!! icon('image') !!}
                    </div>
                </div>
                <div class="p-2">
                    {{ Form::file('images[]', ['multiple', 'class' => 'form-control-file']) }}
                </div>
            </div>
        </div>
    @endcan

    @if ($errors->has('images.*'))
        <div class="alert alert-danger mt-2">
            @foreach($errors->get('images.*') as $fileErrors)
                @foreach($fileErrors as $error)
                    {{ $error }}<br>
                @endforeach
            @endforeach
        </div>
    @endif
</x-appshell::card>
