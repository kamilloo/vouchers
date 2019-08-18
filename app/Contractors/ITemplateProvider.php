<?php

namespace App\Contractors;

use App\Models\Merchant;

interface ITemplateProvider
{
    public function fetch(Merchant $merchant): ITemplate;
}
