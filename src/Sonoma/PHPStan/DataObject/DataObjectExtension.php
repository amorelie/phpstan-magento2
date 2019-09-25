<?php

declare(strict_types=1);

namespace Sonoma\PHPStan\DataObject;

use Magento\Framework\DataObject;
use PHPStan\Reflection\ClassReflection;
use PHPStan\Reflection\FunctionVariant;
use PHPStan\Reflection\MethodReflection;
use PHPStan\Reflection\MethodsClassReflectionExtension;
use PHPStan\Type\MixedType;

class DataObjectExtension implements MethodsClassReflectionExtension
{
    /**
     * @param ClassReflection $classReflection
     * @param string $methodName
     *
     * @return bool
     */
    public function hasMethod(ClassReflection $classReflection, string $methodName): bool
    {
        $isDataObject = $classReflection->getName() === DataObject::class ||
            $classReflection->isSubclassOf(DataObject::class);

        return $isDataObject && in_array(substr($methodName, 0, 3), ['get', 'set', 'uns', 'has']);
    }

    /**
     * @param ClassReflection $classReflection
     * @param string $methodName
     *
     * @return DataObjectMethodReflection
     */
    public function getMethod(ClassReflection $classReflection, string $methodName): MethodReflection
    {
        // Accept no parameters for get / uns / has
        if (in_array(substr($methodName, 0, 3), ['get', 'uns', 'has'])) {
            return new DataObjectMethodReflection(
                $methodName,
                $classReflection,
                [
                    new FunctionVariant(
                        [],
                        false,
                        new MixedType()
                    ),
                ]
            );
        }

        // Accept single parameter for set
        return new DataObjectMethodReflection(
            $methodName,
            $classReflection,
            [
                new FunctionVariant(
                    [new DataObjectMethodParameterReflection()],
                    false,
                    new MixedType()
                ),
            ]
        );
    }
}
