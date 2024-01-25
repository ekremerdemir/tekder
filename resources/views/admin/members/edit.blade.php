@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.edit') }} {{ trans('cruds.member.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route("admin.members.update", [$member->id]) }}" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="form-group">
                <label for="name_surname">{{ trans('cruds.member.fields.name_surname') }}</label>
                <input class="form-control {{ $errors->has('name_surname') ? 'is-invalid' : '' }}" type="text" name="name_surname" id="name_surname" value="{{ old('name_surname', $member->name_surname) }}">
                @if($errors->has('name_surname'))
                    <span class="text-danger">{{ $errors->first('name_surname') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.member.fields.name_surname_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="identity">{{ trans('cruds.member.fields.identity') }}</label>
                <input class="form-control {{ $errors->has('identity') ? 'is-invalid' : '' }}" type="number" name="identity" id="identity" value="{{ old('identity', $member->identity) }}" step="1">
                @if($errors->has('identity'))
                    <span class="text-danger">{{ $errors->first('identity') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.member.fields.identity_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="birthyear">{{ trans('cruds.member.fields.birthyear') }}</label>
                <input class="form-control date {{ $errors->has('birthyear') ? 'is-invalid' : '' }}" type="text" name="birthyear" id="birthyear" value="{{ old('birthyear', $member->birthyear) }}">
                @if($errors->has('birthyear'))
                    <span class="text-danger">{{ $errors->first('birthyear') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.member.fields.birthyear_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="phone">{{ trans('cruds.member.fields.phone') }}</label>
                <input class="form-control {{ $errors->has('phone') ? 'is-invalid' : '' }}" type="text" name="phone" id="phone" value="{{ old('phone', $member->phone) }}">
                @if($errors->has('phone'))
                    <span class="text-danger">{{ $errors->first('phone') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.member.fields.phone_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="email">{{ trans('cruds.member.fields.email') }}</label>
                <input class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" type="email" name="email" id="email" value="{{ old('email', $member->email) }}">
                @if($errors->has('email'))
                    <span class="text-danger">{{ $errors->first('email') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.member.fields.email_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="job_id">{{ trans('cruds.member.fields.job') }}</label>
                <select class="form-control select2 {{ $errors->has('job') ? 'is-invalid' : '' }}" name="job_id" id="job_id">
                    @foreach($jobs as $id => $entry)
                        <option value="{{ $id }}" {{ (old('job_id') ? old('job_id') : $member->job->id ?? '') == $id ? 'selected' : '' }}>{{ $entry }}</option>
                    @endforeach
                </select>
                @if($errors->has('job'))
                    <span class="text-danger">{{ $errors->first('job') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.member.fields.job_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="address">{{ trans('cruds.member.fields.address') }}</label>
                <textarea class="form-control {{ $errors->has('address') ? 'is-invalid' : '' }}" name="address" id="address">{{ old('address', $member->address) }}</textarea>
                @if($errors->has('address'))
                    <span class="text-danger">{{ $errors->first('address') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.member.fields.address_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.member.fields.member_type') }}</label>
                <select class="form-control {{ $errors->has('member_type') ? 'is-invalid' : '' }}" name="member_type" id="member_type">
                    <option value disabled {{ old('member_type', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\Member::MEMBER_TYPE_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('member_type', $member->member_type) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('member_type'))
                    <span class="text-danger">{{ $errors->first('member_type') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.member.fields.member_type_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.member.fields.derbis') }}</label>
                <select class="form-control {{ $errors->has('derbis') ? 'is-invalid' : '' }}" name="derbis" id="derbis">
                    <option value disabled {{ old('derbis', null) === null ? 'selected' : '' }}>{{ trans('global.pleaseSelect') }}</option>
                    @foreach(App\Models\Member::DERBIS_SELECT as $key => $label)
                        <option value="{{ $key }}" {{ old('derbis', $member->derbis) === (string) $key ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
                @if($errors->has('derbis'))
                    <span class="text-danger">{{ $errors->first('derbis') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.member.fields.derbis_helper') }}</span>
            </div>
            <div class="form-group">
                <label>{{ trans('cruds.member.fields.durum') }}</label>
                @foreach(App\Models\Member::DURUM_RADIO as $key => $label)
                    <div class="form-check {{ $errors->has('durum') ? 'is-invalid' : '' }}">
                        <input class="form-check-input" type="radio" id="durum_{{ $key }}" name="durum" value="{{ $key }}" {{ old('durum', $member->durum) === (string) $key ? 'checked' : '' }}>
                        <label class="form-check-label" for="durum_{{ $key }}">{{ $label }}</label>
                    </div>
                @endforeach
                @if($errors->has('durum'))
                    <span class="text-danger">{{ $errors->first('durum') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.member.fields.durum_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="registration">{{ trans('cruds.member.fields.registration') }}</label>
                <input class="form-control date {{ $errors->has('registration') ? 'is-invalid' : '' }}" type="text" name="registration" id="registration" value="{{ old('registration', $member->registration) }}">
                @if($errors->has('registration'))
                    <span class="text-danger">{{ $errors->first('registration') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.member.fields.registration_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="decision_date">{{ trans('cruds.member.fields.decision_date') }}</label>
                <input class="form-control date {{ $errors->has('decision_date') ? 'is-invalid' : '' }}" type="text" name="decision_date" id="decision_date" value="{{ old('decision_date', $member->decision_date) }}">
                @if($errors->has('decision_date'))
                    <span class="text-danger">{{ $errors->first('decision_date') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.member.fields.decision_date_helper') }}</span>
            </div>
            <div class="form-group">
                <label for="numberdecisions">{{ trans('cruds.member.fields.numberdecisions') }}</label>
                <input class="form-control {{ $errors->has('numberdecisions') ? 'is-invalid' : '' }}" type="number" name="numberdecisions" id="numberdecisions" value="{{ old('numberdecisions', $member->numberdecisions) }}" step="1">
                @if($errors->has('numberdecisions'))
                    <span class="text-danger">{{ $errors->first('numberdecisions') }}</span>
                @endif
                <span class="help-block">{{ trans('cruds.member.fields.numberdecisions_helper') }}</span>
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