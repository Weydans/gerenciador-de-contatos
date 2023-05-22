<?php

namespace Tests\Unit\Domain\Service;

use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\UsesClass;

use App\Domain\Service\ContactReadService;
use App\Domain\Repository\ContactDoctrineRepository;

#[CoversClass(ContactReadService::class)]
#[UsesClass(ContactDoctrineRepository::class)]
class ContactReadServiceUnitTest extends TestCase
{
    public function test_execute_should_call_contact_repository_all_method() 
    {
        $contactRepository = $this->createMock( ContactDoctrineRepository::class );
        $contactRepository->expects( $this->once() )->method( 'all' );
        
        ContactReadService::execute( $contactRepository );
    }
}
