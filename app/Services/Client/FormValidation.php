<?php

namespace App\Services\Client;

trait FormValidation
{
    /**
     * @var array|string[]
     */
    protected array $formValidationRules = [
        'name' => 'required|max:255',
        'city' => 'max:255',
        'postcode' => 'max:10',
        'street' => 'max:255',
        'house_number' => 'max:10',
    ];

    /**
     * @return array
     */
    public function getFormValidationRules(): array
    {
        return $this->formValidationRules;
    }
}
