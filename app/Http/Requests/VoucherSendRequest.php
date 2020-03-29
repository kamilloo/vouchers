<?php

namespace App\Http\Requests;

use App\Models\Enums\VoucherType;
use App\Models\ServiceCategory;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class VoucherSendRequest extends PassingEmailRequest
{
}
