<?php

namespace Laravel\ActiveForm\Models;

abstract class Form
{
    public function rules(): array
    {
        return [
            'temp' => ['required'],
        ];
    }

    public function attributes()
    {
        return [
            'temp' => 'Box Folder Id',
        ];
    }


    public function messages()
    {
        return [];
    }
}