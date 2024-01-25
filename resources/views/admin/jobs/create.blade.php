@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.job.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.jobs.store") }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="meslek">{{ trans('cruds.job.fields.meslek') }}</label>
                <input class="form-control {{ $errors->has('meslek') ? 'is-invalid' : '' }}" type="text" name="meslek" id="meslek" value="{{ old('meslek', '') }}">
                @if($errors->has('meslek'))
                    <span class="text-danger">{{ $errors->first('meslek') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.job.fields.meslek_helper') }}</span>
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>



@endsection