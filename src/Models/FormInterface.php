<?php


namespace Laravel\ActiveForm\Models;


interface FormInterface
{
    public function rules(): array;
    public function attributes(): array;
    public function messages(): array;
}