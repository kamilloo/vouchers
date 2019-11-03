<?php

// @formatter:off
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * Class User
 *
 * @package App\Models
 * @property Merchant $merchant
 * @property int $id
 * @property string $name
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read \App\Models\UserProfile $profile
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Voucher[] $vouchers
 * @property-read int|null $vouchers_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereUpdatedAt($value)
 */
	class User extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\UserProfile
 *
 * @property int $user_id
 * @property string|null $address
 * @property string|null $company_name
 * @property string|null $first_name
 * @property string|null $last_name
 * @property string|null $services
 * @property string|null $logo
 * @property string|null $avatar
 * @property string|null $branch
 * @property string|null $description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Model mine()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserProfile newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserProfile newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserProfile query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserProfile whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserProfile whereAvatar($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserProfile whereBranch($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserProfile whereCompanyName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserProfile whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserProfile whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserProfile whereFirstName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserProfile whereLastName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserProfile whereLogo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserProfile whereServices($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserProfile whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserProfile whereUserId($value)
 */
	class UserProfile extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Voucher
 *
 * @property int $id
 * @property string $type
 * @property string $title
 * @property string|null $price
 * @property string|null $service
 * @property int $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Merchant[] $merchants
 * @property-read int|null $merchants_count
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Voucher forMerchant(\App\Models\Merchant $merchant)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Model mine()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Voucher newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Voucher newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Voucher query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Voucher whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Voucher whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Voucher wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Voucher whereService($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Voucher whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Voucher whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Voucher whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Voucher whereUserId($value)
 */
	class Voucher extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Order
 *
 * @property int $id
 * @property int $merchant_id
 * @property int $voucher_id
 * @property string $delivery
 * @property float $price
 * @property string $first_name
 * @property string $last_name
 * @property string $phone
 * @property string $email
 * @property string $status
 * @property int $paid
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Merchant $Merchant
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Model mine()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order toMe()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereDelivery($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereFirstName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereLastName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereMerchantId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order wherePaid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereVoucherId($value)
 */
	class Order extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Template
 *
 * @property int $id
 * @property string $title
 * @property string $slug
 * @property string $description
 * @property float $price
 * @property string|null $thumbnail
 * @property float|null $review
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $file_name
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Model mine()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Template newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Template newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Template query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Template whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Template whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Template whereFileName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Template whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Template wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Template whereReview($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Template whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Template whereThumbnail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Template whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Template whereUpdatedAt($value)
 */
	class Template extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\ShopStyle
 *
 * @property int $id
 * @property int $merchant_id
 * @property string|null $background_color
 * @property string|null $welcoming
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Merchant $merchant
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Model mine()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ShopStyle newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ShopStyle newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ShopStyle query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ShopStyle whereBackgroundColor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ShopStyle whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ShopStyle whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ShopStyle whereMerchantId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ShopStyle whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ShopStyle whereWelcoming($value)
 */
	class ShopStyle extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Payment
 *
 * @property int $id
 * @property int $merchant_id
 * @property int $order_id
 * @property string|null $payment_link
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Order $order
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Model mine()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Payment newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Payment newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Payment query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Payment toMe()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Payment whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Payment whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Payment whereMerchantId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Payment whereOrderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Payment wherePaymentLink($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Payment whereUpdatedAt($value)
 */
	class Payment extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\ShopImage
 *
 * @property int $id
 * @property int $merchant_id
 * @property string|null $logo
 * @property int $logo_enabled
 * @property string|null $front
 * @property int $front_enabled
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Merchant $merchant
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Model mine()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ShopImage newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ShopImage newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ShopImage query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ShopImage whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ShopImage whereFront($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ShopImage whereFrontEnabled($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ShopImage whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ShopImage whereLogo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ShopImage whereLogoEnabled($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ShopImage whereMerchantId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ShopImage whereUpdatedAt($value)
 */
	class ShopImage extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Merchant
 *
 * @property int $id
 * @property int $user_id
 * @property int|null $template_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Order[] $orders
 * @property-read int|null $orders_count
 * @property-read \App\Models\ShopImage $shopImages
 * @property-read \App\Models\ShopStyle $shopStyles
 * @property-read \App\Models\Template|null $template
 * @property-read \App\Models\User $user
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Voucher[] $vouchers
 * @property-read int|null $vouchers_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Model mine()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Merchant newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Merchant newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Merchant query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Merchant whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Merchant whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Merchant whereTemplateId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Merchant whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Merchant whereUserId($value)
 */
	class Merchant extends \Eloquent {}
}

