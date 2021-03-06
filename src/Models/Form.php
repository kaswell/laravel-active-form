<?php

namespace Laravel\ActiveForm\Models;

abstract class Form implements FormInterface
{
    public function rules(): array
    {
        return [
            'temp' => ['required'],
        ];
    }

    public function attributes(): array
    {
        return [
            'temp' => 'Box Folder Id',
        ];
    }


    public function messages(): array
    {
        return [];
    }
}