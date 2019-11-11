<?php
declare(strict_types=1);

namespace App\Http\Presenters;

use App\Models\Model;
use App\Models\Order;
use App\Models\Payment;
use App\Models\Review;
use Illuminate\Support\Str;
use phpDocumentor\Reflection\DocBlock\Tags\Property;

class PaymentPresenter extends ModelPresenter
{

    /**
     * @var Payment
     */
    protected $model;

}
