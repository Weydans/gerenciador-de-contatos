<?php

namespace Tests\Unit\Domain\Service;

use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\UsesClass;

use App\Domain\Model\Person;
use App\Domain\Model\Contact;
use App\Domain\Service\ContactUpdateService;
use App\Domain\Repository\PersonDoctrineRepository;
use App\Domain\Repository\ContactDoctrineRepository;

#[CoversClass(ContactUpdateService::class)]
#[UsesClass(Person::class)]
#[UsesClass(Contact::class)]
#[UsesClass(PersonDoctrineRepository::class)]
#[UsesClass(ContactDoctrineRepository::class)]
class ContactUpdateServiceUnitTest extends TestCase
{
    public function test_execute_should_call_contactRepository_update_method_and_return_updated_contact_on_success() 
    {
        $contactDto              = new \stdClass();
        $contactDto->id          = 1;
        $contactDto->type        = false;
        $contactDto->description = 'email@email.com';
        $contactDto->personId    = 2;
        
        $person = $this->createMock( Person::class );
        $person->method( '__get' )->willReturn( 2 );
        
        $contact = $this->createMock( Contact::class );
        $contact->method( '__get' )->willReturn( $person );
        
        $personRepository  = $this->createMock( PersonDoctrineRepository::class );
        $contactRepository = $this->createMock( ContactDoctrineRepository::class );
        
        $contactRepository->method( 'find' )->willReturn( $contact );
        $contactRepository->expects( $this->once() )->method( 'update' );                             
        
        $personRepository->method( 'find' )->willReturn( $person );
        
        $contactResponse = ContactUpdateService::execute( 
            $contactDto, 
            $contactRepository, 
            $personRepository 
        );
        
        self::assertNotNull( $contactResponse );
    }
}
