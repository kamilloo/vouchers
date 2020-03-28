<?php
declare(strict_types=1);

namespace App\Http\ViewFactories;

use App\Http\ViewModels\TemplateViewModel;
use \Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class CheckoutViewFactory
{
    /**
     * @var Factory
     */
    protected $factory;

    public function __construct(Factory $factory)
    {
        $this->factory = $factory;
    }

    public function start(TemplateViewModel $view_model):View
    {
        return $this->factory->make('templates.'. $view_model->templatePath(), $view_model);
    }

    public function confirmation(TemplateViewModel $view_model):View
    {
        return $this->factory->make('checkout.confirmation.'. $view_model->templatePath(), $view_model);
    }
}
