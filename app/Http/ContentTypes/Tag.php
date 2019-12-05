<?php
declare(strict_types=1);

namespace App\Http\ContentTypes;

class Tag
{
    /**
     * @var string
     */
    protected $key;
    /**
     * @var string
     */
    protected $value;

    public function __construct(string $key, string $value)
    {
        $this->key = mb_strtolower(trim($key));
        $this->value = trim($value);
    }

    public function getKey(): string
    {
        return $this->key;
    }

    public function getValue(): string
    {
        return $this->value;
    }
}
