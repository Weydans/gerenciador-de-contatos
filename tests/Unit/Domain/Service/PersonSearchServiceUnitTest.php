<?php

namespace Tests\Unit\Domain\Service;

use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\UsesClass;

use App\Domain\Service\PersonSearchService;
use App\Domain\Repository\PersonDoctrineRepository;

#[CoversClass(PersonSearchService::class)]
#[UsesClass(PersonDoctrineRepository::class)]
class PersonSearchServiceUnitTest extends TestCase
{
    public function test_execute_should_call_personRepository_searchByField_method() 
    {
        $personRepository = $this->createMock( PersonDoctrineRepository::class );
        $personRepository->expects( $this->once() )->method( 'searchByField' );
        
        PersonSearchService::execute( 'type', true, $personRepository );
    }
}
