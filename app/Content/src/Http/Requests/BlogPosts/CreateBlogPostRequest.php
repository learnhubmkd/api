<?php

namespace App\Content\Http\Requests\BlogPosts;

use App\Platform\Enums\RoleName;
use Illuminate\Foundation\Http\FormRequest;

class CreateBlogPostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()->hasRole(RoleName::ADMIN) || $this->user()->hasRole(RoleName::CONTENT_MANAGER);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => ['required'],
            'excerpt' => ['required'],
            'content' => ['required'],
            'tags' => ['required', 'array'],
            'tags.*' => ['required', 'exists:blog_post_tags,id']
        ];
    }
}
