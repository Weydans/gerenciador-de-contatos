<?php

namespace Tests\Unit\Domain\Service;

use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\UsesClass;

use App\Domain\Service\ContactSearchService;
use App\Domain\Repository\ContactDoctrineRepository;

#[CoversClass(ContactSearchService::class)]
#[UsesClass(ContactDoctrineRepository::class)]
class ContactSearchServiceUnitTest extends TestCase
{
    public function test_execute_should_call_contactRepository_searchByField_method() 
    {
        $contactRepository = $this->createMock( ContactDoctrineRepository::class );
        $contactRepository->expects( $this->once() )->method( 'searchByField' );
        
        ContactSearchService::execute( 'type', true, $contactRepository );
    }
}
