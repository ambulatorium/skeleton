<?php

namespace App\Http\Requests;

use App\Models\Invitation;
use Illuminate\Foundation\Http\FormRequest;

class InvitationRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'email'    => 'required|string|email|max:255|unique:invitations',
            'role'     => 'required',
        ];
    }

    public function formInvitation()
    {
        return [
            'email'    => $this->email,
            'role'     => $this->role,
            'group_id' => $this->group_id,
            'token'    => $this->generateToken(),
        ];
    }

    protected function generateToken()
    {
        $token = str_random(10);
        if (Invitation::where('token', $token)->first()) {
            $this->generateToken();
        }

        return $token;
    }
}
