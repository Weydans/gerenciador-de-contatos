<?php

namespace Tests\Unit\Domain\Service;

use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\UsesClass;

use App\Domain\Model\Person;
use App\Domain\Validation\CPFValidator;
use App\Domain\Service\PersonCreateService;
use App\Domain\Repository\PersonDoctrineRepository;

#[CoversClass(PersonCreateService::class)]
#[UsesClass(Person::class)]
#[UsesClass(CPFValidator::class)]
#[UsesClass(PersonDoctrineRepository::class)]
class PersonCreateServiceUnitTest extends TestCase
{
    public function test_execute_should_call_personRepository_save_method_and_return_new_person_on_success() 
    {
        $personDto       = new \stdClass();
        $personDto->name = 'Valid Name';
        $personDto->cpf  = '788.883.640-21';
        
        $personRepository = $this->createMock( PersonDoctrineRepository::class );
        $personRepository->expects( $this->once() )->method( 'create' );
        
        $person = PersonCreateService::execute( 
            $personDto, 
            $personRepository 
        );
        
        self::assertNotNull( $person );
    }
}
