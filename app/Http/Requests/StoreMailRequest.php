<?php

namespace App\Http\Requests;

use App\Enums\MailType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class StoreMailRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'RecordType' => ['required', 'string'],
            'Type' => ['required', 'string', new Enum(MailType::class)],
            'TypeCode' => ['required', 'integer'],
            'Name' => ['required', 'string'],
            'Tag' => ['nullable', 'string'],
            'MessageStream' => ['required', 'string'],
            'Description' => ['required', 'string'],
            'Email' => ['required', 'email'],
            'From' => ['required', 'email'],
            'BouncedAt' => ['required', 'date'],
        ];
    }
}
