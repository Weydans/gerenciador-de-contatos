<?php

namespace Tests\Unit\Domain\Service;

use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\UsesClass;

use App\Domain\Service\PersonReadService;
use App\Domain\Repository\PersonDoctrineRepository;

#[CoversClass(PersonReadService::class)]
#[UsesClass(PersonDoctrineRepository::class)]
class PersonReadServiceUnitTest extends TestCase
{
    public function test_execute_should_call_person_repository_all_method() 
    {
        $personRepository = $this->createMock( PersonDoctrineRepository::class );
        $personRepository->expects( $this->once() )->method( 'all' );
        
        PersonReadService::execute( $personRepository );
    }
}
