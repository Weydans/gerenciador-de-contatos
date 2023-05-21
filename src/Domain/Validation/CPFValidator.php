<?php

namespace App\Domain\Validation;

/**
 * Responsible to validate a given CPF
 * 
 * @author Weydans Barros
 */
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

    /**
     * Validate a given CPF
     * 
     * @param type $value raw CPF given
     * @return CPFValidator 
     */
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

    /**
     * Verify if CPF is valid
     * 
     * @return bool return true on success of false if invalid CPF
     */
	public function isValid() : bool
	{
		return $this->error ? false : true;
	}

    /**
     * Return an erro message
     * 
     * @return string|null return string error on invalid or null on valid CPF
     */
	public function getError() : ?string
	{
		return $this->error;
	}

    /**
     * Get only digits from given CPF
     * 
     * @param string $cpfValue raw CPF
     * @return string only digits string
     */
	protected function getDigits( string $cpfValue ) : string
	{
		return preg_replace( '/\D/', '', $cpfValue ) ?? '';
	}

    /**
     * Calculate CPF verifier digits
     * 
     * @param string $cpfDigits CPF string
     * @param int $position digit position to calculate 
     * @return int return verifier digit
     */
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
