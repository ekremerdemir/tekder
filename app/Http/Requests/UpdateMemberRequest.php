<?php

namespace App\Http\Requests;

use App\Models\Member;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateMemberRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('member_edit');
    }

    public function rules()
    {
        return [
            'name_surname' => [
                'string',
                'nullable',
            ],
            'identity' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
            'birthyear' => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
            'phone' => [
                'string',
                'nullable',
            ],
            'registration' => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
            'decision_date' => [
                'date_format:' . config('panel.date_format'),
                'nullable',
            ],
            'numberdecisions' => [
                'nullable',
                'integer',
                'min:-2147483648',
                'max:2147483647',
            ],
        ];
    }
}
