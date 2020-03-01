<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdate;
use App\Http\Requests\ShopChangeImages;
use App\Http\Requests\ShopChangeTemplate;
use App\Http\Requests\ShopCustomTemplate;
use App\Http\Requests\ShopGatewaySetting;
use App\Http\Requests\ShopSettings;
use App\Models\Enums\GatewaySandbox;
use App\Models\Merchant;
use App\Models\ShopImage;
use App\Models\ShopStyle;
use App\Models\Template;
use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Filesystem\FilesystemManager;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Arr;

class ShopController extends Controller
{
    public function index(Guard $guard)
    {
        $templates = Template::all();

        $merchant = Merchant::mine()->first();
        $my_template = optional($merchant)->template ?? Template::first();
        $shop_style = optional($merchant)->shopStyles ?? new ShopStyle;
        $shop_images = optional($merchant)->shopImages ?? new ShopImage();
        $shop_settings = optional($merchant)->shopSettings ?? new ShopSettings();

        return view('shop.index', compact('guard', 'templates', 'my_template', 'shop_style', 'shop_images', 'merchant', 'shop_settings'));
    }

    public function changeTemplate(ShopChangeTemplate $request, Guard $guard)
    {
        $user = $guard->user();
        if ($user->isMerchant())
        {
            $user->merchant->update([
                'template_id' => $request->template_id
            ]);
            return redirect(route('shop.index'))
                ->with('success', __('Well done!, you changed your shop design.'));
        }
        return redirect(route('shop.index'))
            ->with('warning', __('Ups!, Something went wrong.'));

    }

    public function customTemplate(ShopCustomTemplate $request, Guard $guard)
    {
        if ($this->getUser($guard)->isMerchant())
        {
            $merchant = $this->getMerchant($guard);
            $shop_style = $merchant->shopStyles()->first();
            $shop_styles = $request->only([
                'background_color',
                'welcoming',
            ]);

            if (empty($shop_style))
            {
                $merchant->shopStyles()->save(new ShopStyle($shop_styles));
            }else{
                $shop_style->update($shop_styles);
            }
            return redirect(route('shop.index'))
                ->with('success', __('Well done!, you changed your shop design.'));
        }
        return redirect(route('shop.index'))
            ->with('warning', __('Ups!, Something went wrong.'));
    }


    public function gatewaySettings(ShopGatewaySetting $request, Guard $guard)
    {
        $user = $guard->user();
        if ($this->getUser($guard)->isMerchant())
        {
            $user->merchant->update([
                'payment_gateway_enabled' => $request->getPaymentGatewayEnabledParam(),
                'merchant_id' => $request->getMerchantIdParam(),
                'pos_id' => $request->getPosIdParam(),
                'crc' => $request->getCrcParam(),
                'sandbox' => $request->getSandboxParam() ?? GatewaySandbox::ENABLED
            ]);

            return redirect(route('shop.index'))
                ->with('success', __('Well done!, you changed your shop design.'));
        }
        return redirect(route('shop.index'))
            ->with('warning', __('Ups!, Something went wrong.'));
    }

    public function shopSettings(ShopSettings $request, Guard $guard)
    {
        if ($this->getUser($guard)->isMerchant())
        {
            $merchant = $this->getMerchant($guard);
            $voucher_style = $merchant->shopSettings()->first();
            $voucher_settings = [
                'expiry_after' => $request->getExpiryAfterParam(),
                'delivery_cost' => $request->getDeliveryCostParam(),
            ];

            if (empty($voucher_style))
            {
                $merchant->shopSettings()->save(new \App\Models\ShopSettings($voucher_settings));
            }else{
                $voucher_style->update($voucher_settings);
            }
            return redirect(route('shop.index'))
                ->with('success', __('Well done!, you changed your shop design.'));
        }
        return redirect(route('shop.index'))
            ->with('warning', __('Ups!, Something went wrong.'));
    }

    public function changeImages(ShopChangeImages $request, Guard $guard)
    {
        $user = $this->getUser($guard);
        if ($user->isMerchant())
        {
            $merchant = $user->getMerchant();
            $shop_images = $merchant->getShopImages();
            $incoming_images_meta_data = $request->only([
                'logo_enabled',
                'front_enabled',
            ]);

            if ($logo = $request->logo)
            {
                $logo_path = $this->uploadImage($logo);
                $incoming_images_meta_data['logo'] = $logo_path;
            }

            if ($front = $request->front)
            {
                $front_path = $this->uploadImage($front);
                $incoming_images_meta_data['front'] = $front_path;
            }

            if (empty($shop_images))
            {
                $shop_images = $merchant->shopImages()->save(new ShopImage($incoming_images_meta_data));
            }else{
                $shop_images->update($incoming_images_meta_data);
            }

            $shop_images->adjustBackgroundImageSwitcher();
            $shop_images->adjustLogoSwitcher();

            return redirect(route('shop.index'))
                ->with('success', __('Well done!, you changed your shop design.'));
        }
        return redirect(route('shop.index'))
            ->with('warning', __('Ups!, Something went wrong.'));
    }


    /**
     * @param ProfileUpdate $request
     *
     * @return false|string
     */
    protected function uploadImage(UploadedFile $file)
    {
        return $file->storePublicly('storage/merchant');
    }

    /**
     * @return Merchant
     */
    private function getMerchant(Guard $guard):Merchant
    {
        return $this->getUser($guard)->merchant;
}

    /**
     * @param Guard $guard
     *
     * @return Authenticatable|User
     */
    private function getUser(Guard $guard):User
    {
        return $guard->user();
}
}
