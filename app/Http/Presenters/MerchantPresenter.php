<?php
declare(strict_types=1);

namespace App\Http\Presenters;

use App\Models\Merchant;
use App\Models\Model;
use App\Models\Order;
use App\Models\Payment;
use App\Models\Review;
use Illuminate\Support\Str;
use phpDocumentor\Reflection\DocBlock\Tags\Property;

class MerchantPresenter extends ModelPresenter
{

    /**
     * @var Merchant
     */
    protected $model;

    public function shopLink():string
    {
        return route('checkout.start', $this->model);
    }
    public function hasEnabledPaymentGateway():bool
    {
        return (bool)$this->model->payment_gateway_enabled;
    }

}
