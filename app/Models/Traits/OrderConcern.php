<?php

namespace App\Models\Traits;

use App\Models\Enums\VoucherType;
use App\Models\Order;
use App\Models\Voucher;

/**
 * Trait OrderConcern
 *
 * @var Order
 */
trait OrderConcern
{
    public function getId(): int
    {
        return $this->id;
    }

    public function getClientEmail():string
    {
        return $this->client->email;
    }
    public function getClientName():string
    {
        return $this->client->name ?? '';
    }
    public function getClientCity():string
    {
        return $this->client->city ?? '';
    }
    public function getClientPhone():string
    {
        return $this->client->phone ?? '';
    }
    public function getClientAddress():string
    {
        return $this->client->address ?? '';
    }
    public function getClientPostcode():string
    {
        return $this->client->postcode ?? '';
    }
    public function getClientCountry():string
    {
        return $this->client->country ?? '';
    }

    public function getAmount():float
    {
        return $this->price;
    }
    public function getDescription():string
    {
        switch ($this->voucher->type){
            case VoucherType::SERVICE:
                return __('Service Voucher');
            case VoucherType::QUOTE:
                return __('Quote Voucher');
        }

        return __('Service Voucher');
    }
    public function getProductTitle():string
    {
        return $this->voucher->product->title;
    }
    public function getProductDescription():string
    {
        return $this->voucher->product->description ?? '';
    }

    public function getVoucher():Voucher
    {
        return $this->voucher;
    }

}
