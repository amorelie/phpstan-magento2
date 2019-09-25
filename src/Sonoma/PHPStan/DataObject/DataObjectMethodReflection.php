<?php

declare(strict_types=1);

namespace Sonoma\PHPStan\DataObject;

use PHPStan\Reflection\ClassMemberReflection;
use PHPStan\Reflection\ClassReflection;
use PHPStan\Reflection\MethodReflection;
use PHPStan\Reflection\ParametersAcceptor;

class DataObjectMethodReflection implements MethodReflection
{
    /**
     * @var string
     */
    private $name;

    /**
     * @var ClassReflection
     */
    private $declaringClass;

    /**
     * @var array
     */
    private $variants;

    /**
     * @param string $name
     * @param ClassReflection $declaringClass
     * @param ParametersAcceptor[] $variants
     */
    public function __construct(string $name, ClassReflection $declaringClass, array $variants = [])
    {
        $this->name = $name;
        $this->declaringClass = $declaringClass;
        $this->variants = $variants;
    }

    /**
     * @return ClassReflection
     */
    public function getDeclaringClass(): ClassReflection
    {
        return $this->declaringClass;
    }

    /**
     * @return bool
     */
    public function isStatic(): bool
    {
        return false;
    }

    /**
     * @return bool
     */
    public function isPrivate(): bool
    {
        return false;
    }

    /**
     * @return bool
     */
    public function isPublic(): bool
    {
        return true;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return ClassMemberReflection
     */
    public function getPrototype(): ClassMemberReflection
    {
        return $this;
    }

    /**
     * @return ParametersAcceptor[]
     */
    public function getVariants(): array
    {
        return $this->variants;
    }
}
