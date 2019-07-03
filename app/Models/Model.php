<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as VendorModel;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

abstract class Model extends VendorModel
{

}
