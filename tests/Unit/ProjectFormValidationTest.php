<?php

namespace Tests\Unit;

use App\Services\Project\FormValidation;
use PHPUnit\Framework\TestCase;

class ProjectFormValidationTest extends TestCase
{
    use FormValidation;
    /**
     * Client form validation
     * @return void
     */
    public function test_form_validation()
    {
        // Validation rules exist
        $this->assertIsArray($this->formValidationRules);
        $this->assertNotEmpty($this->formValidationRules);

        // Can get validation rules with public method
        $this->assertIsArray($this->getFormValidationRules());

        // Lists are the same
        $this->assertEquals($this->getFormValidationRules(), $this->formValidationRules);
    }
}
