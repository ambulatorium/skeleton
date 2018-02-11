<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GroupRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name'                  => 'required|min:5',
            'country'               => 'required|min:3',
            'city'                  => 'required|min:3',
            'address'               => 'required|max:60',
        ];
    }

    public function formGroup()
    {
        return [
            'name'                  => $this->name,
            'slug'                  => str_slug($this->name, '-'),
            'country'               => $this->country,
            'city'                  => $this->city,
            'address'               => $this->address,
        ];
    }
}
