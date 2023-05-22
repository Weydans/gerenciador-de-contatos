<?php

namespace Tests\Unit\Domain\Service;

use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\UsesClass;

use App\Domain\Model\Person;
use App\Domain\Model\Contact;
use App\Domain\Service\ContactCreateService;
use App\Domain\Repository\PersonDoctrineRepository;
use App\Domain\Repository\ContactDoctrineRepository;

#[CoversClass(ContactCreateService::class)]
#[UsesClass(Person::class)]
#[UsesClass(Contact::class)]
#[UsesClass(PersonDoctrineRepository::class)]
#[UsesClass(ContactDoctrineRepository::class)]
class ContactCreateServiceUnitTest extends TestCase
{
    public function test_execute_should_call_person_repository_save_method_and_return_new_contact_on_success() 
    {
        $contactDto              = new \stdClass();
        $contactDto->type        = false;
        $contactDto->description = 'email@email.com';
        $contactDto->personId    = 2;
        
        $person = $this->createMock( Person::class );
        
        $personRepository  = $this->createMock( PersonDoctrineRepository::class );        
        $personRepository->method( 'find' )->willReturn( $person );        
        $personRepository->expects( $this->once() )->method( 'save' );
        
        $contactRepository = $this->createMock( ContactDoctrineRepository::class );
        
        $contact = ContactCreateService::execute( 
            $contactDto, 
            $contactRepository, 
            $personRepository 
        );
        
        self::assertNotNull( $contact );
    }
}
