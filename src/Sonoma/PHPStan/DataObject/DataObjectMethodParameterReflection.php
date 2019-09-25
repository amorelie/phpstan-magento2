<?php

declare(strict_types=1);

namespace Sonoma\PHPStan\DataObject;

use PHPStan\Reflection\ParameterReflection;
use PHPStan\Reflection\PassedByReference;
use PHPStan\Type\MixedType;
use PHPStan\Type\Type;

class DataObjectMethodParameterReflection implements ParameterReflection
{
    /**
     * @return string
     */
    public function getName(): string
    {
        return 'value';
    }

    /**
     * @return bool
     */
    public function isOptional(): bool
    {
        return false;
    }

    /**
     * @return Type
     */
    public function getType(): Type
    {
        return new MixedType();
    }

    /**
     * @return PassedByReference
     */
    public function passedByReference(): PassedByReference
    {
        return PassedByReference::createNo();
    }

    /**
     * @return bool
     */
    public function isVariadic(): bool
    {
        return false;
    }
}
