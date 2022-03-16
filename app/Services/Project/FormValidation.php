<?php

namespace App\Services\Project;

trait FormValidation
{
    /**
     * @var array|string[]
     */
    protected array $formValidationRules = [
        'name' => 'required|max:255',
        'client_id' => 'required|max:255',
        'date_from' => 'max:30',
        'date_to' => 'max:30',
        'deadline' => 'max:30',
        'trello_board' => 'max:255',
        'note' => 'max:400',
    ];

    /**
     * @return array
     */
    public function getFormValidationRules(): array
    {
        return $this->formValidationRules;
    }
}
