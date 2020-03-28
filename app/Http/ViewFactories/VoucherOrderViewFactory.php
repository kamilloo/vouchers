<?php
declare(strict_types=1);

namespace App\Http\ViewFactories;

use App\Http\ViewModels\TemplateViewModel;
use \Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class VoucherOrderViewFactory
{
    /**
     * @var Factory
     */
    protected $factory;

    public function __construct(Factory $factory)
    {
        $this->factory = $factory;
    }

    public function failed(TemplateViewModel $view_model):View
    {
        return $this->factory->make('payment.failed.'. $view_model->templatePath(), $view_model);
    }
}
