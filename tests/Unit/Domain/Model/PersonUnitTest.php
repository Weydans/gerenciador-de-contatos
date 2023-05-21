<?php

namespace Tests\Unit\Domain\Model;

use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Attributes\UsesClass;
use PHPUnit\Framework\Attributes\CoversClass;

use App\Domain\Model\Person;
use App\Domain\Model\Contact;
use App\Domain\Validation\CPFValidator;

#[CoversClass(Person::class)]
#[UsesClass(CPFValidator::class)]
#[UsesClass(Contact::class)]
class PersonUnitTest extends TestCase
{
    public function test_person_should_implements_serializeable_interface() 
    {
        $interfaces = class_implements( Person::class );
        
        self::assertIsArray( $interfaces );
        self::assertContains( 'Lib\SerializeableInterface', $interfaces );
    }
    
    /**
     * @dataProvider setNameDataProvider
     */
    public function test_setName_method( $name, $cpf ) 
    {
        self::expectException( \Exception::class );
        
        new Person( $name, $cpf );
    }
    
    public static function setNameDataProvider()
    {
        return [
            'should_throws_exception_when_name_smaller_than_3_chars' => [
                'name' => 'Mr',
                'cpf'  => '411.604.300-12', 
            ],
            'should_throws_exception_when_name_greatter_than_191_chars' => [
                'name' => str_repeat( 'a', 192 ),
                'cpf'  => '411.604.300-12', 
            ],
        ];        
    }
        
    /**
     * @dataProvider setCpfDataProvider
     */
    public function test_setCpf_method( $name, $cpf ) 
    {
        self::expectException( \Exception::class );
        
        new Person( $name, $cpf );
    }
    
    public static function setCpfDataProvider()
    {
        return [
            'should_throws_exception_when_cpf_is_invalid' => [
                'name' => 'Mary',
                'cpf'  => '411.604.300-10', 
            ],
            'should_throws_exception_when_cpf_smaller_than_11_digits' => [
                'name' => 'Mary',
                'cpf'  => '411.604.300-1', 
            ],
            'should_throws_exception_when_cpf_greatter_than_12_digits' => [
                'name' => 'Mary',
                'cpf'  => '411.604.300-112', 
            ],
        ];        
    }
    
    public function test_addContact_method_should_add_contact_to_contact_list() 
    {
        $contact = $this->createMock( Contact::class );
        
        $person = new Person( 'Mary', '411.604.300-12' );
        $person->addContact( $contact );
        
        self::assertEquals( $contact, $person->contacts[0] );
    }
    
    public function test_removeContact_method_should_remove_contact_to_contact_list() 
    {
        $contact = $this->createMock( Contact::class );
        
        $person = new Person( 'Mary', '411.604.300-12' );
        $person->addContact( $contact );
        $person->removeContact( $contact );
        
        self::assertEmpty( $person->contacts );
    }
}
