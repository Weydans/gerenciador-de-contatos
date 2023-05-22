<?php

namespace Tests\Unit\Domain\Service;

use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\UsesClass;

use App\Domain\Service\PersonDeleteService;
use App\Domain\Repository\PersonDoctrineRepository;

#[CoversClass(PersonDeleteService::class)]
#[UsesClass(PersonDoctrineRepository::class)]
class PersonDeleteServiceUnitTest extends TestCase
{
    public function test_execute_should_call_person_repository_delete_method() 
    {
        $personRepository = $this->createMock( PersonDoctrineRepository::class );
        $personRepository->expects( $this->once() )->method( 'delete' );
        
        PersonDeleteService::execute( 1, $personRepository );
    }
}
