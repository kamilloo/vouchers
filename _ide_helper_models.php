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
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Branch[] $branches
 * @property-read int|null $branches_count
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read \App\Models\UserProfile $profile
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Skill[] $skills
 * @property-read int|null $skills_count
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
 * App\Models\TransactionConfirmation
 *
 * @property int $id
 * @property int $transaction_id
 * @property array|null $request_parameters
 * @property array|null $receive_parameters
 * @property int|null $success
 * @property string|null $session_id
 * @property array|null $error_description
 * @property string|null $error_code
 * @property string|null $order_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Transaction $transaction
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Model mine()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TransactionConfirmation newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TransactionConfirmation newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TransactionConfirmation query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TransactionConfirmation whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TransactionConfirmation whereErrorCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TransactionConfirmation whereErrorDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TransactionConfirmation whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TransactionConfirmation whereOrderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TransactionConfirmation whereReceiveParameters($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TransactionConfirmation whereRequestParameters($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TransactionConfirmation whereSessionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TransactionConfirmation whereSuccess($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TransactionConfirmation whereTransactionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\TransactionConfirmation whereUpdatedAt($value)
 */
	class TransactionConfirmation extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\UserProfile
 *
 * @property int $user_id
 * @property string|null $first_name
 * @property string|null $last_name
 * @property string|null $company_name
 * @property string|null $address
 * @property string|null $city
 * @property string|null $postcode
 * @property string|null $avatar
 * @property string|null $services
 * @property string|null $branch
 * @property string|null $description
 * @property array|null $social-media
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
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserProfile whereCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserProfile whereCompanyName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserProfile whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserProfile whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserProfile whereFirstName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserProfile whereLastName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserProfile wherePostcode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserProfile whereServices($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserProfile whereSocialMedia($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserProfile whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\UserProfile whereUserId($value)
 */
	class UserProfile extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Client
 *
 * @property int $id
 * @property string $email
 * @property string|null $name
 * @property string|null $phone
 * @property string|null $city
 * @property string|null $address
 * @property string|null $postcode
 * @property string|null $country
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Order $order
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Model mine()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Client newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Client newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Client query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Client whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Client whereCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Client whereCountry($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Client whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Client whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Client whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Client whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Client wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Client wherePostcode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Client whereUpdatedAt($value)
 */
	class Client extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Skill
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\User[] $users
 * @property-read int|null $users_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Model mine()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Skill newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Skill newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Skill query()
 */
	class Skill extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\ServicePackage
 *
 * @property int $id
 * @property int $merchant_id
 * @property string $title
 * @property string|null $description
 * @property float $price
 * @property string $currency
 * @property int $active
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\ServiceCategory[] $categories
 * @property-read int|null $categories_count
 * @property-read \App\Models\Merchant $merchant
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Service[] $services
 * @property-read int|null $services_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Voucher[] $vouchers
 * @property-read int|null $vouchers_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Model mine()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ServicePackage newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ServicePackage newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ServicePackage query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ServicePackage toMe()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ServicePackage whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ServicePackage whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ServicePackage whereCurrency($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ServicePackage whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ServicePackage whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ServicePackage whereMerchantId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ServicePackage wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ServicePackage whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ServicePackage whereUpdatedAt($value)
 */
	class ServicePackage extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Voucher
 *
 * @property int $id
 * @property int $user_id
 * @property int $merchant_id
 * @property string $type
 * @property string $title
 * @property string|null $price
 * @property string|null $product_type
 * @property int|null $product_id
 * @property string|null $file
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Merchant $merchant
 * @property-read \Illuminate\Database\Eloquent\Model|\Eloquent $product
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Voucher forMerchant(\App\Models\Merchant $merchant)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Model mine()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Voucher newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Voucher newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Voucher query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Voucher whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Voucher whereFile($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Voucher whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Voucher whereMerchantId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Voucher wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Voucher whereProductId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Voucher whereProductType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Voucher whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Voucher whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Voucher whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Voucher whereUserId($value)
 */
	class Voucher extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\ServiceCategory
 *
 * @property int $id
 * @property int $merchant_id
 * @property string $title
 * @property string|null $description
 * @property int $active
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Merchant $merchant
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\ServicePackage[] $packages
 * @property-read int|null $packages_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Service[] $services
 * @property-read int|null $services_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Model mine()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ServiceCategory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ServiceCategory newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ServiceCategory query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ServiceCategory toMe()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ServiceCategory whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ServiceCategory whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ServiceCategory whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ServiceCategory whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ServiceCategory whereMerchantId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ServiceCategory whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\ServiceCategory whereUpdatedAt($value)
 */
	class ServiceCategory extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Order
 *
 * @property int $id
 * @property int $merchant_id
 * @property int $voucher_id
 * @property int|null $client_id
 * @property string $delivery
 * @property float $price
 * @property string $first_name
 * @property string $last_name
 * @property string $phone
 * @property string $email
 * @property string $status
 * @property int $paid
 * @property string|null $used_at
 * @property string|null $expired_at
 * @property string|null $qr_code
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Client|null $client
 * @property-read \OrderPresenter $presenter
 * @property-read \App\Models\Merchant $merchant
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Payment[] $payments
 * @property-read int|null $payments_count
 * @property-read \App\Models\Voucher $voucher
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order byQrCode($qr_code)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Model mine()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order toMe()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereClientId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereDelivery($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereExpiredAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereFirstName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereLastName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereMerchantId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order wherePaid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereQrCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Order whereUsedAt($value)
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
 * @property string $file_name
 * @property float $price
 * @property string|null $thumbnail
 * @property float|null $review
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
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
 * App\Models\Branch
 *
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\User[] $users
 * @property-read int|null $users_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Model mine()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Branch newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Branch newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Branch query()
 */
	class Branch extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Payment
 *
 * @property int $id
 * @property int $merchant_id
 * @property int $order_id
 * @property string|null $payment_link
 * @property string|null $paid_at
 * @property float $amount
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \PaymentPresenter $presenter
 * @property-read \App\Models\Merchant $merchant
 * @property-read \App\Models\Order $order
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Transaction[] $transactions
 * @property-read int|null $transactions_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Payment byPaid()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Model mine()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Payment newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Payment newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Payment query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Payment toMe()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Payment whereAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Payment whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Payment whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Payment whereMerchantId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Payment whereOrderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Payment wherePaidAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Payment wherePaymentLink($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Payment whereUpdatedAt($value)
 */
	class Payment extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Service
 *
 * @property int $id
 * @property int $merchant_id
 * @property string $title
 * @property string|null $description
 * @property float $price
 * @property string $currency
 * @property int $active
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\ServiceCategory[] $categories
 * @property-read int|null $categories_count
 * @property-read \App\Models\Merchant $merchant
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\ServicePackage[] $packages
 * @property-read int|null $packages_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Model mine()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Service newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Service newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Service query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Service toMe()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Service whereActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Service whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Service whereCurrency($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Service whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Service whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Service whereMerchantId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Service wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Service whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Service whereUpdatedAt($value)
 */
	class Service extends \Eloquent {}
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
 * @property int|null $merchant_id
 * @property int|null $pos_id
 * @property string|null $crc
 * @property int $sandbox
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Order[] $orders
 * @property-read int|null $orders_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\ServiceCategory[] $serviceCategories
 * @property-read int|null $service_categories_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\ServicePackage[] $servicePackages
 * @property-read int|null $service_packages_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Service[] $services
 * @property-read int|null $services_count
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
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Merchant whereCrc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Merchant whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Merchant whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Merchant whereMerchantId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Merchant wherePosId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Merchant whereSandbox($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Merchant whereTemplateId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Merchant whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Merchant whereUserId($value)
 */
	class Merchant extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Transaction
 *
 * @property int $id
 * @property int $payment_id
 * @property float $order_amount
 * @property string|null $url_return
 * @property string|null $url_status
 * @property string|null $client_email
 * @property string|null $client_name
 * @property string|null $client_phone
 * @property string|null $client_address
 * @property string|null $client_postcode
 * @property string|null $client_city
 * @property string|null $client_country
 * @property string|null $order_description
 * @property string|null $product_title
 * @property string|null $product_description
 * @property string|null $session_id
 * @property string|null $token
 * @property int $is_register
 * @property array|null $request_parameters
 * @property int|null $error_code
 * @property array|null $error_description
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\TransactionConfirmation[] $confirmations
 * @property-read int|null $confirmations_count
 * @property-read \App\Models\Payment $payment
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Model mine()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Transaction newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Transaction newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Transaction query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Transaction whereClientAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Transaction whereClientCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Transaction whereClientCountry($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Transaction whereClientEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Transaction whereClientName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Transaction whereClientPhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Transaction whereClientPostcode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Transaction whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Transaction whereErrorCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Transaction whereErrorDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Transaction whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Transaction whereIsRegister($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Transaction whereOrderAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Transaction whereOrderDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Transaction wherePaymentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Transaction whereProductDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Transaction whereProductTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Transaction whereRequestParameters($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Transaction whereSessionId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Transaction whereToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Transaction whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Transaction whereUrlReturn($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Transaction whereUrlStatus($value)
 */
	class Transaction extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Review
 *
 * @property int $id
 * @property int $merchant_id
 * @property float $rating
 * @property string $author
 * @property string|null $body
 * @property string|null $published_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \ReviewPresenter $presenter
 * @property-read \App\Models\Merchant $merchant
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Model mine()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Review newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Review newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Review query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Review toMe()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Review whereAuthor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Review whereBody($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Review whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Review whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Review whereMerchantId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Review wherePublishedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Review whereRating($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Review whereUpdatedAt($value)
 */
	class Review extends \Eloquent {}
}

