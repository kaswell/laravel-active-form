<?php

namespace Laravel\ActiveForm\Models;

interface FormContract
{
    public function rules(): array;
    public function attributes(): array;
    public function messages(): array;
}