<?php

namespace App\Contractors;

interface IPayment
{
    public function link(): string ;
    public function paid(): bool ;
}
