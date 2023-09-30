<?php

declare(strict_types=1);

namespace App\Request;

use Hyperf\Validation\Request\FormRequest;

class TitleRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'tconst'            => 'required|string',
            'type_id'           => 'required|exists:type_titles,id',
            'primary'           => 'required|string',
            'original'          => 'required|string',
            'is_adult'          => 'required|boolean',
            'start_year'        => 'required|string',
            'end_year'          => 'required|string',
            'runtime_minutes'   => 'required|string',
        ];
    }
}
