<?php
declare(strict_types=1);

namespace App\Http\Presenters;

use App\Models\Model;
use App\Models\Order;
use App\Models\Voucher;
use phpDocumentor\Reflection\DocBlock\Tags\Property;

/**
 * Class VoucherPresenter
 *
 * @mixin Voucher
 */
class VoucherPresenter extends ModelPresenter implements \JsonSerializable
{
    /**
     * @var Voucher
     */
    protected $model;

    public function fullName(): string
    {
        return implode(' ', array_map('ucfirst',[$this->model->first_name, $this->model->last_name]));
    }

    public function type(): string
    {
        return mb_strtoupper($this->model->status);
    }

    public function price(): float
    {
        if ($this->model->isQuoteType())
        {
            return $this->model->price;
        }
        return $this->model->product->price;

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
}
