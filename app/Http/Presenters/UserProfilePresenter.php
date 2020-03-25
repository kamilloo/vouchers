<?php
declare(strict_types=1);

namespace App\Http\Presenters;

use App\Models\Enums\DeliveryType;
use App\Models\Model;
use App\Models\Order;
use App\Models\User;
use App\Models\UserProfile;
use phpDocumentor\Reflection\DocBlock\Tags\Property;

class UserProfilePresenter extends ModelPresenter
{
    /**
     * @var UserProfile
     */
    protected $model;

    public function fullName(): string
    {
        return implode(' ', array_map('ucfirst',[$this->model->first_name, $this->model->last_name]));
    }

    public function company(): string
    {
        $company_name = $this->model->company_name;
        if (empty($company_name))
        {
            $company_name = $this->getUser()->name;
        }

        return ucfirst($company_name) ;
    }

    public function avatar(): string
    {
        $avatar = $this->model->avatar;
        if (empty($avatar))
        {
            return asset('images/avatar-placeholder.gif');
        }
        return asset($avatar);
    }

    public function fullAddress(): string
    {
        return implode('\n', array_filter([
            $this->model->address,
            $this->cityWithPostcode()
        ]));
    }

    public function description(): string
    {
        return nl2br($this->model->description);
    }

    /**
     * @return string
     */
    protected function cityWithPostcode(): string
    {
        return implode(', ', array_filter([$this->model->postcode, $this->model->city]));
    }

    /**
     * @return User
     */
    protected function getUser()
    {
        return $this->model->user;
    }
}
