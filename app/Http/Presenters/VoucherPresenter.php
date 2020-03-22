<?php
declare(strict_types=1);

namespace App\Http\Presenters;

use App\Models\Enums\VoucherType;
use App\Models\Model;
use App\Models\Order;
use App\Models\Voucher;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Support\Arr;
use phpDocumentor\Reflection\DocBlock\Tags\Property;

/**
 * Class VoucherPresenter
 *
 * @mixin Voucher
 */
class VoucherPresenter extends ModelPresenter implements \JsonSerializable, Arrayable
{
    /**
     * @var Voucher
     */
    protected $model;

    public function type(): string
    {
        return Arr::get(collect(VoucherType::description())->first(function (array $type){
            return $type['value'] === $this->model->type;
        }), 'label');
    }

    public function price(): float
    {
        if ($this->model->isQuoteType())
        {
            return $this->model->price;
        }
        return $this->model->product->price;
    }

    public function title(): string
    {
        if ($this->model->isQuoteType())
        {
            return "Bon o wartości {$this->model->price} zł</p>";
        }
        if (empty($this->model->product->description))
        {
            return  __('On') .' '. "{$this->model->product->title}<br>";
        }
        return  __('On') .' '. "{$this->model->product->title}<br>".
            "({$this->model->product->description})";
    }

    /**
     * @inheritDoc
     */
    public function jsonSerialize()
    {
        return [
            'id' => $this->model->id,
            'price' => $this->price(),
            'title' => $this->model->title
        ];
    }

    /**
     * @inheritDoc
     */
    public function toArray()
    {
        return [
            'type' => $this->type(),
            'title' => $this->title(),
            'price' => $this->price(),
        ];
    }
}
