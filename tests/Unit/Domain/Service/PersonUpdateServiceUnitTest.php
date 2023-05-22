<?php

namespace Tests\Unit\Domain\Service;

use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\UsesClass;

use App\Domain\Model\Person;
use App\Domain\Service\PersonUpdateService;
use App\Domain\Repository\PersonDoctrineRepository;

#[CoversClass(PersonUpdateService::class)]
#[UsesClass(Person::class)]
#[UsesClass(PersonDoctrineRepository::class)]
class PersonUpdateServiceUnitTest extends TestCase
{
    public function test_execute_should_call_personRepository_update_method_and_return_updated_person_on_success() 
    {
        $personDto       = new \stdClass();
        $personDto->id   = 1;
        $personDto->name = 'Valid Name';
        $personDto->cpf  = '788.883.640-21';
        
        $person = $this->createMock( Person::class );
        
        $personRepository = $this->createMock( PersonDoctrineRepository::class );
        $personRepository->method( 'find' )->willReturn( $person );
        $personRepository->expects( $this->once() )->method( 'save' );
        
        $personResponse = PersonUpdateService::execute( 
            $personDto, 
            $personRepository
        );
        
        self::assertNotNull( $personResponse );
    }
}
