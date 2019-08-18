<?php

namespace App\Contractors;

use Illuminate\View\View;

interface ITemplate
{
    public function render(): string;

}
