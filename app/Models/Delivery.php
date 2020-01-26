<?php
declare(strict_types=1);

namespace App\Models;

use App\Models\Enums\DeliveryType;
use Illuminate\Support\Arr;

class Delivery
{
    /**
     * @var string
     */
    private $type;
    /**
     * @var float
     */
    private $cost;

    /**
     * @return float
     */
    public function getCost(): float
    {
        return $this->cost;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return Arr::get(DeliveryType::titles(), $this->type);
    }

    public function init(string $type, float $cost): self
    {
        $this->type = $type;
        $this->cost = $cost;

        return $this;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return Arr::get(DeliveryType::description(), $this->type);
    }

}
