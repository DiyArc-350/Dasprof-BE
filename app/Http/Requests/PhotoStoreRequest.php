<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PhotoStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        if(request()->isMethod("POST")){
            return [
                'id_category' => 'required|integer',
                'photo_order' => 'required|integer',
                'photo_render' => 'required|image',
                'photo_alt' => 'required|string'
            ];
        }else{
            return [
                'id_category' => 'nullable|integer',
                'photo_order' => 'nullable|integer',
                'photo_render' => 'nullable|image',
                'photo_alt' => 'nullable|string'
            ];
        }
    }

    public function messages(){
        if(request()->isMethod('POST')){
            return [
                'id_category.required' => 'category is reqired',
                'photo_order.required' => 'order is required minimal 1',
                'photo_render.required' => 'photo is required',
                'photo_alt.required' => 'photo name is required'
            ];
        }else{
            return [
                'id_category.required' => 'category is reqired',
                'photo_order.required' => 'order is required minimal 1',
                'photo_render.required' => 'photo is required',
                'photo_alt.required' => 'photo name is required'
            ];
            }
        }
}
