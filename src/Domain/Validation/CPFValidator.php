<?php

namespace App\Domain\Validation;

class CPFValidator
{
	const INVALID_SEQUENCE_LIST = [
		'11111111111',
		'22222222222',
		'33333333333',
		'44444444444',
		'55555555555',
		'66666666666',
		'77777777777',
		'88888888888',
		'99999999999',
		'00000000000',
	];

	protected ?string $error = null;

	public function __construct( $value )
	{
		$cpfDigits = $this->getDigits( $value );

		if ( mb_strlen( $cpfDigits ) != 11 ) {
			$this->error = 'CPF must be 11 digits exactly';
			return;
		}

		if (   in_array( $cpfDigits, self::INVALID_SEQUENCE_LIST )
			|| $cpfDigits[ 9 ]  != $this->calculateDigitAt( $cpfDigits, 9 ) 
			|| $cpfDigits[ 10 ] != $this->calculateDigitAt( $cpfDigits, 10 )
		) {
			$this->error = 'Invalid CPF';
			return;
		}
	}

	public function isValid() : bool
	{
		return $this->error ? false : true;
	}

	public function getError() : ?string
	{
		return $this->error;
	}

	protected function getDigits( string $cpfValue ) : string
	{
		return preg_replace( '/\D/', '', $cpfValue ) ?? '';
	}

	protected function calculateDigitAt( string $cpfDigits, int $position ) : int
	{
		$multiplier  = $position + 1;
		$accumulator = 0;

		for ( $i = 0; $i < $position; $i++, $multiplier-- ) {
			$accumulator += $cpfDigits[ $i ] * $multiplier;
		}

		$rest = $accumulator % 11;

		return $rest > 1 ? 11 - $rest : 0;
	}
}

