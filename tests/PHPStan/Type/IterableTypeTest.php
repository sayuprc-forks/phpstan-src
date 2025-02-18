<?php declare(strict_types = 1);

namespace PHPStan\Type;

use PHPStan\Testing\PHPStanTestCase;
use PHPStan\TrinaryLogic;
use PHPStan\Type\Accessory\HasMethodType;
use PHPStan\Type\Accessory\HasPropertyType;
use PHPStan\Type\Constant\ConstantArrayType;
use PHPStan\Type\Generic\TemplateMixedType;
use PHPStan\Type\Generic\TemplateTypeFactory;
use PHPStan\Type\Generic\TemplateTypeScope;
use PHPStan\Type\Generic\TemplateTypeVariance;
use function array_map;
use function sprintf;

class IterableTypeTest extends PHPStanTestCase
{

	public function dataIsSuperTypeOf(): array
	{
		return [
			[
				new IterableType(new IntegerType(), new StringType()),
				new ArrayType(new IntegerType(), new StringType()),
				TrinaryLogic::createYes(),
			],
			[
				new IterableType(new MixedType(), new StringType()),
				new ArrayType(new IntegerType(), new StringType()),
				TrinaryLogic::createYes(),
			],
			[
				new IterableType(new IntegerType(), new StringType()),
				new ArrayType(new MixedType(), new StringType()),
				TrinaryLogic::createMaybe(),
			],
			[
				new IterableType(new StringType(), new StringType()),
				new ArrayType(new IntegerType(), new StringType()),
				TrinaryLogic::createNo(),
			],
			[
				new IterableType(new StringType(), new StringType()),
				new ConstantArrayType([], []),
				TrinaryLogic::createYes(),
			],
			[
				new IterableType(new MixedType(true), new StringType()),
				new ObjectType('Iterator'),
				TrinaryLogic::createMaybe(),
			],
			[
				new IterableType(new MixedType(false), new MixedType(true)),
				new ConstantArrayType([], []),
				TrinaryLogic::createYes(),
			],
		];
	}

	/**
	 * @dataProvider dataIsSuperTypeOf
	 */
	public function testIsSuperTypeOf(IterableType $type, Type $otherType, TrinaryLogic $expectedResult): void
	{
		$actualResult = $type->isSuperTypeOf($otherType);
		$this->assertSame(
			$expectedResult->describe(),
			$actualResult->describe(),
			sprintf('%s -> isSuperTypeOf(%s)', $type->describe(VerbosityLevel::precise()), $otherType->describe(VerbosityLevel::precise())),
		);
	}

	public function dataIsSubTypeOf(): array
	{
		return [
			[
				new IterableType(new MixedType(), new StringType()),
				new IterableType(new MixedType(), new StringType()),
				TrinaryLogic::createYes(),
			],
			[
				new IterableType(new MixedType(), new StringType()),
				new ObjectType('Unknown'),
				TrinaryLogic::createMaybe(),
			],
			[
				new IterableType(new MixedType(), new StringType()),
				new IntegerType(),
				TrinaryLogic::createNo(),
			],
			[
				new IterableType(new MixedType(), new StringType()),
				new IterableType(new MixedType(), new IntegerType()),
				TrinaryLogic::createNo(),
			],
			[
				new IterableType(new MixedType(), new StringType()),
				new UnionType([new IterableType(new MixedType(), new StringType()), new NullType()]),
				TrinaryLogic::createYes(),
			],
			[
				new IterableType(new MixedType(), new StringType()),
				new UnionType([new ArrayType(new MixedType(), new MixedType()), new ObjectType('Traversable')]),
				TrinaryLogic::createYes(),
			],
			[
				new IterableType(new MixedType(), new StringType()),
				new UnionType([new ArrayType(new MixedType(), new StringType()), new ObjectType('Traversable')]),
				TrinaryLogic::createYes(),
			],
			[
				new IterableType(new MixedType(), new StringType()),
				new UnionType([new ObjectType('Unknown'), new NullType()]),
				TrinaryLogic::createMaybe(),
			],
			[
				new IterableType(new MixedType(), new StringType()),
				new UnionType([new IntegerType(), new NullType()]),
				TrinaryLogic::createNo(),
			],
			[
				new IterableType(new MixedType(), new StringType()),
				new UnionType([new IterableType(new MixedType(), new IntegerType()), new NullType()]),
				TrinaryLogic::createNo(),
			],
			[
				new IterableType(new IntegerType(), new StringType()),
				new IterableType(new MixedType(), new StringType()),
				TrinaryLogic::createYes(),
			],
			[
				new IterableType(new MixedType(), new StringType()),
				new IterableType(new IntegerType(), new StringType()),
				TrinaryLogic::createMaybe(),
			],
			[
				new IterableType(new StringType(), new StringType()),
				new IterableType(new IntegerType(), new StringType()),
				TrinaryLogic::createNo(),
			],
			[
				new IterableType(new MixedType(), new StringType()),
				new HasMethodType('foo'),
				TrinaryLogic::createMaybe(),
			],
			[
				new IterableType(new MixedType(), new StringType()),
				new HasPropertyType('foo'),
				TrinaryLogic::createMaybe(),
			],
			[
				new IterableType(new MixedType(true), new StringType()),
				new ObjectType('Iterator'),
				TrinaryLogic::createMaybe(),
			],
		];
	}

	/**
	 * @dataProvider dataIsSubTypeOf
	 */
	public function testIsSubTypeOf(IterableType $type, Type $otherType, TrinaryLogic $expectedResult): void
	{
		$actualResult = $type->isSubTypeOf($otherType);
		$this->assertSame(
			$expectedResult->describe(),
			$actualResult->describe(),
			sprintf('%s -> isSubTypeOf(%s)', $type->describe(VerbosityLevel::precise()), $otherType->describe(VerbosityLevel::precise())),
		);
	}

	/**
	 * @dataProvider dataIsSubTypeOf
	 */
	public function testIsSubTypeOfInversed(IterableType $type, Type $otherType, TrinaryLogic $expectedResult): void
	{
		$actualResult = $otherType->isSuperTypeOf($type);
		$this->assertSame(
			$expectedResult->describe(),
			$actualResult->describe(),
			sprintf('%s -> isSuperTypeOf(%s)', $otherType->describe(VerbosityLevel::precise()), $type->describe(VerbosityLevel::precise())),
		);
	}

	public function dataInferTemplateTypes(): array
	{
		$templateType = static fn ($name): Type => TemplateTypeFactory::create(
			TemplateTypeScope::createWithFunction('a'),
			$name,
			new MixedType(),
			TemplateTypeVariance::createInvariant(),
		);

		return [
			'receive iterable' => [
				new IterableType(
					new MixedType(),
					new ObjectType('DateTime'),
				),
				new IterableType(
					new MixedType(),
					$templateType('T'),
				),
				['T' => 'DateTime'],
			],
			'receive iterable template key' => [
				new IterableType(
					new StringType(),
					new ObjectType('DateTime'),
				),
				new IterableType(
					$templateType('U'),
					$templateType('T'),
				),
				['U' => 'string', 'T' => 'DateTime'],
			],
			'receive mixed' => [
				new MixedType(),
				new IterableType(
					new MixedType(),
					$templateType('T'),
				),
				[],
			],
			'receive non-accepted' => [
				new StringType(),
				new IterableType(
					new MixedType(),
					$templateType('T'),
				),
				[],
			],
		];
	}

	/**
	 * @dataProvider dataInferTemplateTypes
	 * @param array<string,string> $expectedTypes
	 */
	public function testResolveTemplateTypes(Type $received, Type $template, array $expectedTypes): void
	{
		$result = $template->inferTemplateTypes($received);

		$this->assertSame(
			$expectedTypes,
			array_map(static fn (Type $type): string => $type->describe(VerbosityLevel::precise()), $result->getTypes()),
		);
	}

	public function dataDescribe(): array
	{
		$templateType = TemplateTypeFactory::create(
			TemplateTypeScope::createWithFunction('a'),
			'T',
			null,
			TemplateTypeVariance::createInvariant(),
		);

		return [
			[
				new IterableType(new IntegerType(), new StringType()),
				'iterable<int, string>',
			],
			[
				new IterableType(new MixedType(), new StringType()),
				'iterable<string>',
			],
			[
				new IterableType(new MixedType(), new MixedType()),
				'iterable',
			],
			[
				new IterableType($templateType, new MixedType()),
				'iterable<T, mixed>',
			],
			[
				new IterableType(new MixedType(), $templateType),
				'iterable<T>',
			],
			[
				new IterableType($templateType, $templateType),
				'iterable<T, T>',
			],
		];
	}

	/**
	 * @dataProvider dataDescribe
	 */
	public function testDescribe(Type $type, string $expect): void
	{
		$result = $type->describe(VerbosityLevel::typeOnly());

		$this->assertSame($expect, $result);
	}

	public function dataAccepts(): array
	{
		/** @var TemplateMixedType $t */
		$t = TemplateTypeFactory::create(
			TemplateTypeScope::createWithFunction('foo'),
			'T',
			null,
			TemplateTypeVariance::createInvariant(),
		);
		return [
			[
				new IterableType(
					new MixedType(),
					$t,
				),
				new ConstantArrayType([], []),
				TrinaryLogic::createYes(),
			],
			[
				new IterableType(
					new MixedType(),
					$t->toArgument(),
				),
				new ConstantArrayType([], []),
				TrinaryLogic::createYes(),
			],
		];
	}

	/**
	 * @dataProvider dataAccepts
	 */
	public function testAccepts(IterableType $iterableType, Type $otherType, TrinaryLogic $expectedResult): void
	{
		$actualResult = $iterableType->accepts($otherType, true)->result;
		$this->assertSame(
			$expectedResult->describe(),
			$actualResult->describe(),
			sprintf('%s -> accepts(%s)', $iterableType->describe(VerbosityLevel::precise()), $otherType->describe(VerbosityLevel::precise())),
		);
	}

}
