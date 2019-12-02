<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdate;
use App\Http\Requests\ShopChangeImages;
use App\Http\Requests\ShopChangeTemplate;
use App\Http\Requests\ShopCustomTemplate;
use App\Http\Requests\ShopGatewaySetting;
use App\Models\Enums\GatewaySandbox;
use App\Models\Merchant;
use App\Models\ShopImage;
use App\Models\ShopStyle;
use App\Models\Template;
use App\Models\UserProfile;
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

        return view('shop.index', compact('guard', 'templates', 'my_template', 'shop_style', 'shop_images', 'merchant'));
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
                ->with('success', 'Well done!, you changed your shop design.');
        }
        return redirect(route('shop.index'))
            ->with('warning', 'Ups!, Something went wrong.');

    }

    public function customTemplate(ShopCustomTemplate $request, Guard $guard)
    {
        $user = $guard->user();
        if ($user->isMerchant())
        {
            $merchant = $user->merchant;
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
                ->with('success', 'Well done!, you changed your shop design.');
        }
        return redirect(route('shop.index'))
            ->with('warning', 'Ups!, Something went wrong.');
    }


    public function gatewaySettings(ShopGatewaySetting $request, Guard $guard)
    {
        $user = $guard->user();
        if ($user->isMerchant())
        {
            $user->merchant->update([
                'merchant_id' => $request->getMerchantIdParam(),
                'pos_id' => $request->getPosIdParam(),
                'crc' => $request->getCrcParam(),
                'sandbox' => $request->getSandboxParam() ?? GatewaySandbox::ENABLED
            ]);

            return redirect(route('shop.index'))
                ->with('success', 'Well done!, you changed your shop design.');
        }
        return redirect(route('shop.index'))
            ->with('warning', 'Ups!, Something went wrong.');
    }

    public function changeImages(ShopChangeImages $request, Guard $guard)
    {
        $user = $guard->user();
        if ($user->isMerchant())
        {
            $merchant = $user->merchant;
            $shop_images = $merchant->shopImages()->first();
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
                $merchant->shopImages()->save(new ShopImage($incoming_images_meta_data));
            }else{
                $shop_images->update($incoming_images_meta_data);
            }
            return redirect(route('shop.index'))
                ->with('success', 'Well done!, you changed your shop design.');
        }
        return redirect(route('shop.index'))
            ->with('warning', 'Ups!, Something went wrong.');
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
}
