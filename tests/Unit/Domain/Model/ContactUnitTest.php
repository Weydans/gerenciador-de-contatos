<?php

namespace Tests\Unit\Domain\Model;

use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Attributes\UsesClass;
use PHPUnit\Framework\Attributes\CoversClass;

use App\Domain\Model\Person;
use App\Domain\Model\Contact;
 
#[CoversClass(Contact::class)]
#[UsesClass(Person::class)]
class ContactUnitTest extends TestCase
{
    public function test_contact_should_implements_serializeable_interface() 
    {
        $interfaces = class_implements( Contact::class );
        
        self::assertIsArray( $interfaces );
        self::assertContains( 'Lib\SerializeableInterface', $interfaces );
    }
    
    /**
     * @dataProvider setDescriptionDataProvider
     */
    public function test_setDescription_method( $type, $description ) 
    {
        self::expectException(\Exception::class );
        
        $person = $this->createMock( Person::class );
        
        new Contact( $type, $description, $person );
    }
    
    public static function setDescriptionDataProvider() 
    {
        return [
            'showld_throws_exception_when_description_smaller_than_3_chars' => [
                'type'        => true,
                'description' => 'te',
            ],
            'showld_throws_exception_when_description_gratter_than_192_chars' => [
                'type'        => true,
                'description' => str_repeat( 'a', 192 ),
            ]
        ];
    }
    
    public function test_setDescription_method_showld_not_throws_exception_when_is_valid() 
    {        
        $person     = $this->createMock( Person::class );
        $validEmail = 'valid@email.com';
        $validType  = false;
        
        $contact = new Contact( $validType, $validEmail, $person );
 
        self::assertEquals( $validEmail, $contact->description );
    }
}
