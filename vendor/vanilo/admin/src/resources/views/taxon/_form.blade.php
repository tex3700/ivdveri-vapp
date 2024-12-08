<div class="mb-3">
    <div class="input-group input-group-lg {{ $errors->has('name') ? 'has-validation' : '' }}">
        <span class="input-group-text">
            {!! icon('taxon') !!}
        </span>
        <x-appshell::floating-label :label="__('Name')" :is-invalid="$errors->has('name')">
            {{ Form::text('name', null, [
                'class' => 'form-control form-control-lg' . ($errors->has('name') ? ' is-invalid' : ''),
                'placeholder' => __('Name')
                ])
            }}
        </x-appshell::floating-label>
        @if ($errors->has('name'))
            <div class="invalid-feedback">{{ $errors->first('name') }}</div>
        @endif
    </div>
</div>

<div class="mb-3 row">
    <label class="col-form-label col-md-2">{{ __('URL') }}</label>
    <div class="col-md-10">
        {{ Form::text('slug', null, [
                'class' => 'form-control' . ($errors->has('slug') ? ' is-invalid': ''),
                'placeholder' => __('Leave empty to auto generate from name')
           ])
        }}
        @if ($errors->has('slug'))
            <div class="invalid-feedback">{{ $errors->first('slug') }}</div>
        @endif
    </div>
</div>

<hr>

<div class="mb-3 row">
    <label class="col-form-label col-form-label-sm col-md-2">{{ __('Parent') }}</label>
    <div class="col-md-10">
        {{ Form::select('parent_id', $taxons, null, [
                'class' => 'form-control form-control-sm' . ($errors->has('parent_id') ? ' is-invalid': ''),
                'placeholder' => __('No parent')
           ])
        }}
        @if ($errors->has('parent_id'))
            <div class="invalid-feedback">{{ $errors->first('parent_id') }}</div>
        @endif
    </div>
</div>

<div class="mb-3 row">
    <label class="col-form-label col-form-label-sm col-md-2">{{ __('Priority') }}</label>
    <div class="col-md-10">
        {{ Form::text('priority', null, [
                'class' => 'form-control form-control-sm' . ($errors->has('priority') ? ' is-invalid': '')
           ])
        }}
        @if ($errors->has('priority'))
            <div class="invalid-feedback">{{ $errors->first('priority') }}</div>
        @endif
    </div>
</div>

<hr>

<div class="mb-3">
    <?php $contentHasErrors = any_key_exists($errors->toArray(), ['subtitle', 'excerpt', 'description', 'top_content', 'bottom_content']) ?>
    <h5><a data-bs-toggle="collapse" href="#taxon-form-content" class="collapse-toggler-heading"
           @if ($contentHasErrors)
               aria-expanded="true"
            @endif
        >{!! icon('>') !!} {{ __('Content') }}</a></h5>

    <div id="taxon-form-content" class="collapse{{ $contentHasErrors ? ' show' : '' }}">
        <div class="callout">
            @include('vanilo::taxon._form_content')
        </div>
    </div>
</div>

<div class="mb-3">
    <?php $seoHasErrors = any_key_exists($errors->toArray(), ['ext_title', 'meta_description', 'meta_keywords']) ?>
    <h5><a data-bs-toggle="collapse" href="#taxon-form-seo" class="collapse-toggler-heading"
           @if ($seoHasErrors)
           aria-expanded="true"
                @endif
        >{!! icon('>') !!} {{ __('SEO') }}</a></h5>

    <div id="taxon-form-seo" class="collapse{{ $seoHasErrors ? ' show' : '' }}">
        <div class="callout">
            @include('vanilo::taxon._form_seo')
        </div>
    </div>
</div>
