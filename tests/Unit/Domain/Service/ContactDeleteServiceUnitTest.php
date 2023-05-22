<?php

namespace Tests\Unit\Domain\Service;

use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\UsesClass;

use App\Domain\Service\ContactDeleteService;
use App\Domain\Repository\ContactDoctrineRepository;

#[CoversClass(ContactDeleteService::class)]
#[UsesClass(ContactDoctrineRepository::class)]
class ContactDeleteServiceUnitTest extends TestCase
{
    public function test_execute_should_call_contact_repository_delete_method() 
    {
        $contactRepository = $this->createMock( ContactDoctrineRepository::class );
        $contactRepository->expects( $this->once() )->method( 'delete' );
        
        ContactDeleteService::execute( 1, $contactRepository );
    }
}
