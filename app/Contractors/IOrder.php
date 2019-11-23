<?php
declare(strict_types=1);

namespace App\Contractors;

use App\Models\Voucher;

interface IOrder
{
    public function getId(): int;

    public function getClientEmail():string;
    public function getClientName():string;
    public function getClientCity():string;
    public function getClientPhone():string;
    public function getClientAddress():string;
    public function getClientPostcode():string;
    public function getClientCountry():string;

    public function getAmount():float;
    public function getDescription():string;
    public function getProductTitle():string;
    public function getProductDescription():string;
    public function getVoucher():Voucher;

}
