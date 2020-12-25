<?php

declare(strict_types=1);

namespace App\Http\Request\Statistics;

use Urameshibr\Requests\FormRequest;

class SiteVisitCollectingRequest extends FormRequest
{
    /**
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return string[]
     */
    public function rules(): array
    {
        return [
            'city_code' => 'required|string',
        ];
    }

    /**
     * @return string
     */
    public function getCityCode(): string
    {
        return (string) $this->post('city_code');
    }
}
