<?php

namespace NonFalseyString;

use function PHPStan\Testing\assertType;
use const ENT_SUBSTITUTE;

class Foo {
	/**
	 * @param non-falsy-string $nonFalseyString
	 * @param truthy-string $truthyString
	 */
	public function bar($nonFalseyString, $truthyString) {
		assertType('int', (int) $nonFalseyString);
		// truthy-string is an alias for non-falsy-string
		assertType('non-falsy-string', $truthyString);
	}

	function removeZero(string $s) {
		if ($s === '0') {
			return;
		}

		assertType('string', $s);
	}

	/**
	 * @param non-empty-string $nonEmpty
	 */
	public function doBar5(string $s, $nonEmpty): void
	{
		if (2 <= strlen($s)) {
			assertType('non-falsy-string', $s);
		}
		assertType('string', $s);

		if (3 === strlen($s)) {
			assertType('non-falsy-string', $s);
		}
		assertType('string', $s);

		if (2 <= strlen($nonEmpty)) {
			assertType('non-falsy-string', $nonEmpty);
		}
	}

	/**
	 * @param numeric-string $numericS
	 * @param non-falsy-string $nonFalsey
	 * @param non-empty-string $nonEmpty
	 * @param literal-string $literalString
	 */
	function concat(string $s, string $nonFalsey, $numericS, $nonEmpty, $literalString): void
	{
		assertType('non-falsy-string', $nonFalsey . '');
		assertType('non-falsy-string', $nonFalsey . $s);

		assertType('non-falsy-string', $nonFalsey . $nonEmpty);
		assertType('non-falsy-string', $nonEmpty . $nonFalsey);

		assertType('non-falsy-string', $nonEmpty . $nonEmpty);

		assertType('non-falsy-string', $nonFalsey . $literalString);
		assertType('non-falsy-string', $literalString . $nonFalsey);

		assertType('non-falsy-string', $nonFalsey . $numericS);
		assertType('non-falsy-string', $numericS . $nonFalsey);

		assertType('non-falsy-string', $nonEmpty . $numericS);
		assertType('non-falsy-string', $numericS . $nonEmpty);
	}

	/**
	 * @param non-falsy-string $nonFalsey
	 * @param non-empty-array<non-falsy-string> $arrayOfNonFalsey
	 * @param non-empty-array $nonEmptyArray
	 */
	function stringFunctions(string $s, $nonFalsey, $arrayOfNonFalsey, $nonEmptyArray, array $arr)
	{
		assertType('string', implode($nonFalsey, []));
		assertType('non-falsy-string', implode($nonFalsey, $nonEmptyArray));
		assertType('non-falsy-string', implode($nonFalsey, $arrayOfNonFalsey));
		assertType('non-falsy-string', implode($s, $arrayOfNonFalsey));

		assertType('non-falsy-string', addslashes($nonFalsey));
		assertType('non-falsy-string', addcslashes($nonFalsey));

		assertType('non-falsy-string', escapeshellarg($nonFalsey));
		assertType('non-falsy-string', escapeshellcmd($nonFalsey));

		assertType('non-falsy-string&uppercase-string', strtoupper($nonFalsey));
		assertType('lowercase-string&non-falsy-string', strtolower($nonFalsey));
		assertType('non-falsy-string&uppercase-string', mb_strtoupper($nonFalsey));
		assertType('lowercase-string&non-falsy-string', mb_strtolower($nonFalsey));
		assertType('non-falsy-string', lcfirst($nonFalsey));
		assertType('non-falsy-string', ucfirst($nonFalsey));
		assertType('non-falsy-string', ucwords($nonFalsey));
		assertType('non-falsy-string', htmlspecialchars($nonFalsey));
		assertType('non-falsy-string', htmlspecialchars($nonFalsey, ENT_SUBSTITUTE));
		assertType('string', htmlspecialchars($nonFalsey, 0));
		assertType('non-falsy-string', htmlentities($nonFalsey));
		assertType('non-falsy-string', htmlentities($nonFalsey, ENT_SUBSTITUTE));
		assertType('string', htmlentities($nonFalsey, 0));

		assertType('non-falsy-string', urlencode($nonFalsey));
		assertType('non-falsy-string', urldecode($nonFalsey));
		assertType('non-falsy-string', rawurlencode($nonFalsey));
		assertType('non-falsy-string', rawurldecode($nonFalsey));

		assertType('non-falsy-string', preg_quote($nonFalsey));

		assertType('string', sprintf($nonFalsey));
		assertType("'foo'", sprintf('foo'));
		assertType("string", sprintf(...$arr));
		assertType("string", sprintf('%s', ...$arr));

		// empty array only works as long as no placeholder in the pattern
		assertType('string', vsprintf($nonFalsey, []));
		assertType('string', vsprintf($nonFalsey, []));
		assertType("string", vsprintf('foo', []));

		assertType("string", vsprintf('%s', ...$arr));
		assertType("string", vsprintf(...$arr));
		assertType('non-falsy-string', vsprintf('%sAA%s', [$s, $s]));
		assertType('non-falsy-string', vsprintf('%d%d', [$s, $s])); // could be non-falsy-string&numeric-string

		assertType('non-falsy-string', sprintf("%sAA%s", $s, $s));
		assertType('non-falsy-string', sprintf("%d%d", $s, $s)); // could be non-falsy-string&numeric-string
		assertType('non-falsy-string', sprintf("%sAA%s%s%s%s", $s, $s, $s, $s, $s));
		assertType('non-falsy-string', sprintf("%sAA%s%s%s%s%s", $s, $s, $s, $s, $s, $s));

		assertType('int<1, max>', strlen($nonFalsey));

		assertType('non-falsy-string', str_pad($nonFalsey, 0));
		assertType('non-falsy-string', str_repeat($nonFalsey, 1));

	}

	/**
	 * @param non-falsy-string $nonFalsey
	 * @param positive-int $positiveInt
	 * @param 1|2|3 $postiveRange
	 * @param -1|-2|-3 $negativeRange
	 */
	public function doSubstr($nonFalsey, $positiveInt, $postiveRange, $negativeRange): void
	{
		assertType('non-falsy-string', substr($nonFalsey, -5));
		assertType('non-falsy-string', substr($nonFalsey, $negativeRange));

		assertType('non-falsy-string', substr($nonFalsey, 0, 5));
		assertType('non-empty-string', substr($nonFalsey, 0, $postiveRange));

		assertType('non-empty-string', substr($nonFalsey, 0, $positiveInt));
	}

	function numericIntoFalsy(string $s): void
	{
		if (is_numeric($s)) {
			assertType('numeric-string', $s);

			if ('0' !== $s) {
				assertType('non-falsy-string&numeric-string', $s);
			}
		}
	}

}
