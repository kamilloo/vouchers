<?php
declare(strict_types=1);

namespace App\Http\Presenters;

use App\Models\Model;
use App\Models\Order;
use App\Models\Review;
use Illuminate\Support\Str;
use phpDocumentor\Reflection\DocBlock\Tags\Property;

class ReviewPresenter extends ModelPresenter
{
    const BLACK_STAT = '&#9733;';
    const WHITE_STAT = '&#9734;';

    /**
     * @var Review
     */
    protected $model;


    public function rating(): string
    {
        $rating = '';
        for ($black_star = 0; $black_star < intval($this->model->rating); $black_star++) {
            $rating .= self::BLACK_STAT;
        }
        if (fmod(floatval($this->model->rating), 1.0))
        {
            $rating .= self::WHITE_STAT;
        }

        return $rating;
    }

    public function author(): string
    {
        return ucfirst($this->model->author);
    }

    public function body(): ?string
    {
        return Str::limit($this->model->body, 15);
    }

}
