<?php

declare(strict_types=1);

namespace App\Http\Request\Statistics;

use LVR\CountryCode\Two;
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
            'country_code' => ['required', 'string', new Two()],
        ];
    }

    /**
     * @return string
     */
    public function getCountryCode(): string
    {
        return (string) $this->post('country_code');
    }
}
