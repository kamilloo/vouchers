<?php
declare(strict_types=1);

namespace App\Http\Presenters;

use App\Models\Model;
use App\Models\Order;
use App\Models\Payment;
use App\Models\Review;
use Carbon\Carbon;
use Illuminate\Support\Str;
use phpDocumentor\Reflection\DocBlock\Tags\Property;

class PaymentPresenter extends ModelPresenter
{

    /**
     * @var Payment
     */
    protected $model;

    public function paid():bool
    {
        return $this->model->paid();
    }

    public function paidAt():string
    {
        if (empty($this->model->paid_at))
        {
            return __('no pay');
        }
        return Carbon::parse($this->model->paid_at)->toDateString();
    }

}
