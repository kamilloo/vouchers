<?php
declare(strict_types=1);

namespace App\Http\Presenters;

use App\Models\Enums\DeliveryType;
use App\Models\Model;
use App\Models\Order;
use Carbon\Carbon;
use phpDocumentor\Reflection\DocBlock\Tags\Property;

class OrderPresenter extends ModelPresenter
{
    /**
     * @var Order
     */
    protected $model;

    public function fullName(): string
    {
        return implode(' ', array_map('ucfirst',[$this->model->first_name, $this->model->last_name]));
    }

    public function status(): string
    {
        return __($this->model->status);
    }

    public function price(): string
    {
        return number_format($this->model->price, 2, ',', ' ');
    }

    public function delivery(): string
    {
        return DeliveryType::titles()[$this->model->delivery];
    }

    public function paid(): bool {
        return $this->model->paid();
    }

    public function expitedAt(): string {
        if (is_null($this->model->expired_at))
        {
            return __('unlimited');
        }
        return $this->model->expired_at->toDateString();
    }


}
