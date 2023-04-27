<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class StoreProductRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'status'        => ['required'],
            'slug'          => ['required','max:300'],
            'isbn'          => ['required','max:13'],
            'publish_date'  => ['nullable','date'],
            'pages'         => ['nullable','int'],
            'title'         => ['required','max:300'],
            'subtitle'      => ['nullable','max:300'],
            'description'   => ['nullable','max:1000'],
        ];
    }


    /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation(): void
    {
        $this->merge([
            'status'        => (in_array($this->status,array_keys(config('constants.products.status_options')))) ? $this->status : 'inactive',
            'slug'          => Str::slug($this->slug),
            'isbn'          => $this->isbn ? trim($this->isbn) : null,
            'publish_date'  => $this->publish_date ? date('Y-m-d',strtotime($this->publish_date)) : null,
            'pages'         => $this->pages ?? 0,
            'title'         => $this->title ? trim($this->title) : null,
            'subtitle'      => $this->subtitle ? trim($this->subtitle) : null,
            'description'   => $this->description ? trim($this->description) : null,
        ]);
    }


    /**
     * Handle a passed validation attempt.
    protected function passedValidation(): void
    {
        $this->replace(['name' => 'Taylor']);
    }
     */

}  // end class StoreProductRequest
