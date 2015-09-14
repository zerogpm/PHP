<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class CreateLessonRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required',
            'body' => 'required',
            'confirmed' => 'required',
        ];
    }

    public function response(array $errors)
    {
        return response()->json([
            'message' => 'make sure you have title,body,confirmed',
            'code' => 422
        ],422);
    }
}
