<div class="mb-3">
    <div class="input-group input-group-lg {{ $errors->has('name') ? 'has-validation' : '' }}">
        <span class="input-group-text">
            {!! icon('property') !!}
        </span>
        <x-appshell::floating-label :label="__('Property name')" :is-invalid="$errors->has('name')">
            {{ Form::text('name', null, [
                'class' => 'form-control form-control-lg' . ($errors->has('name') ? ' is-invalid' : ''),
                'placeholder' => __('Name of the property')
            ])
        }}
        </x-appshell::floating-label>
        @if ($errors->has('name'))
            <div class="invalid-feedback">{{ $errors->first('name') }}</div>
        @endif
    </div>
</div>

<div class="mb-3 row">
    <label class="col-form-label col-form-label-sm col-md-2">{{ __('URL') }}</label>
    <div class="col-md-10">
        {{ Form::text('slug', null, [
                'class' => 'form-control form-control-sm' . ($errors->has('slug') ? ' is-invalid': ''),
                'placeholder' => __('Leave empty to autogenerate')
            ])
        }}
        @if ($errors->has('slug'))
            <div class="invalid-feedback">{{ $errors->first('slug') }}</div>
        @endif
    </div>
</div>

<hr>

<div class="mb-3 row">
    <label class="col-form-label col-form-label-sm col-md-2">{{ __('Type') }}</label>
    <div class="col-md-10">
        {{ Form::select('type', $types, null, [
                'class' => 'form-select form-select-sm' . ($errors->has('type') ? ' is-invalid': ''),
                'placeholder' => __('--')
           ])
        }}
        @if ($errors->has('type'))
            <div class="invalid-feedback">{{ $errors->first('type') }}</div>
        @endif
    </div>
</div>

<hr>

<div class="mb-3 row{{ $errors->has('is_hidden') ? ' has-danger' : '' }}">
    <div class="col-md-10 offset-md-2">
        {{ Form::hidden('is_hidden', 0) }}

        <div class="form-check form-switch">
            {{ Form::checkbox('is_hidden', 1, null, ['class' => 'form-check-input', 'id' => 'is_property_hidden', 'role' => 'switch']) }}
            <label class="form-check-label" for="is_property_hidden">{{ __('Hidden') }}</label>
        </div>

        @if ($errors->has('is_hidden'))
            <div class="invalid-feedback">{{ $errors->first('is_hidden') }}</div>
        @endif
    </div>
</div>
