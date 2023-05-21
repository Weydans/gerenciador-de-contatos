<?php

namespace Tests\Unit\Domain\Validation;

use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Attributes\CoversClass;

use App\Domain\Validation\CPFValidator;

#[CoversClass(CPFValidator::class)]
class CPFValidatorUnitTest extends TestCase
{
    /**
     * @dataProvider cpfValidatorDataProvider
     */
    public function test_CPFValidator( $cpf, $expectedMessage, $expectedIsValid ) 
    {
        $validator = new CPFValidator( $cpf );
        
        $isValid = $validator->isValid();
        $message = $validator->getError();
        
        self::assertEquals( $expectedIsValid, $isValid );
        self::assertEquals( $expectedMessage, $message );
    }
    
    public static function cpfValidatorDataProvider() 
    {
        return [
            'is_valid_should_return_false_and_getError_the_correct_message_on_cpf_size_smaller_than_11_digits' => [
                'cpf'             => '411.604.300-1e',
                'expectedMessage' => 'CPF must be 11 digits exactly',
                'expectedIsValid' => false,
            ],
            'is_valid_should_return_false_and_getError_the_correct_message_on_cpf_size_bigger_than_11_digits' => [
                'cpf'             => '411.604.300-123',
                'expectedMessage' => 'CPF must be 11 digits exactly',
                'expectedIsValid' => false,
            ],
            'is_valid_should_return_false_and_getError_the_correct_message_on_cpf_tenth_digit_is_invalid' => [
                'cpf'             => '411.604.300-22',
                'expectedMessage' => 'Invalid CPF',
                'expectedIsValid' => false,
            ],
            'is_valid_should_return_false_and_getError_the_correct_message_on_cpf_eleventh_digit_is_invalid' => [
                'cpf'             => '411.604.300-10',
                'expectedMessage' => 'Invalid CPF',
                'expectedIsValid' => false,
            ],
            'is_valid_should_return_false_and_getError_the_correct_message_on_cpf_all_digits_equals' => [
                'cpf'             => '444.444.444-44',
                'expectedMessage' => 'Invalid CPF',
                'expectedIsValid' => false,
            ],
            'is_valid_should_return_true_and_getError_empty_message_on_valid_cpf' => [
                'cpf'             => '411.604.300-12',
                'expectedMessage' => '',
                'expectedIsValid' => true,
            ],
        ];
    }
}
