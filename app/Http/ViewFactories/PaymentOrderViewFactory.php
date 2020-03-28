<?php
declare(strict_types=1);

namespace App\Http\ViewFactories;

use App\Http\ViewModels\TemplateViewModel;
use \Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class PaymentOrderViewFactory
{
    /**
     * @var Factory
     */
    protected $factory;

    public function __construct(Factory $factory)
    {
        $this->factory = $factory;
    }

    public function callbackReturn(TemplateViewModel $view_model):View
    {
        return $this->factory
            ->make('payment.return.'. $view_model->templatePath(), $view_model)
            ->with(['success' => __('You bought voucher successful.')]);
    }

    public function recap(TemplateViewModel $view_model):View
    {
        return $this->factory
            ->make('payment.recap.'. $view_model->templatePath(), $view_model);
    }
}
