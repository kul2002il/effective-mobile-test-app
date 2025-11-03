<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTaskRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'title'       => 'string|required|max:255',
            'description' => 'string|nullable',
            'status'      => 'string|required|max:255',
        ];
    }
}
