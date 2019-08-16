<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdate;
use App\Http\Requests\ShopChangeTemplate;
use App\Models\Merchant;
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
        return view('shop.index', compact('guard', 'templates', 'my_template'));
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

    public function customTemplate()
    {

    }

    public function changeImages()
    {

    }


    /**
     * @param ProfileUpdate $request
     *
     * @return false|string
     */
    protected function replaceLogo(UploadedFile $file)
    {
        return $file->storePublicly('public/logos');
    }
}
