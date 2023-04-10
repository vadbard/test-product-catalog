<?php

namespace App\Exceptions\Repository;

use Throwable;
use UnexpectedValueException;

class CategoryUpdateBadParameterRepositoryException extends UnexpectedValueException
{
    protected string $name;
    protected mixed $value;

    public function __construct(string $name, mixed $value, int $code = 0, ?Throwable $previous = null)
    {
        parent::__construct("Parameter $name has wrong value $value", $code, $previous);
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getValue(): mixed
    {
        return $this->value;
    }
}
