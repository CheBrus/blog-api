<?php

namespace App\Http\Requests\Post;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->route('post')->user_id === auth()->id();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [

            'name' => 'sometimes|string|max:255',
            'slug' => 'sometimes|string|max:255|unique:posts,slug',
            'extract' => 'sometimes|string',
            'body' => 'sometimes|string',
            'published' => 'sometimes|date',
            'categories' => 'sometimes|array',
            'categories.*' => 'sometimes|integer|exists:categories,id',
            'user_id' => 'required|integer|exists:users,id',
        ];
    }
}
