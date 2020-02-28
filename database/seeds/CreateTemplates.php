<?php

use Illuminate\Database\Seeder;

class CreateTemplates extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        collect($this->templateList())->each(function (array $template){
            $title = \Illuminate\Support\Arr::get($template, 'title');
            $i = \Illuminate\Support\Arr::get($template, 'id');
            \App\Models\Template::create([
                'title' => $title,
                'slug' => \Illuminate\Support\Str::slug($title),
                'description' => \Illuminate\Support\Arr::get($template, 'description'),
                'price' => \Illuminate\Support\Arr::get($template, 'price'),
                'thumbnail' => "/storage/templates/template-{$i}.png",
                'file_name' => "template-{$i}",
            ]);
        });
    }

    protected function templateList():array
    {
        return [
            [
                'id' => 1,
                'title' => __('Blue'),
                'description' => __('Modern Style'),
                'price' => 0,
            ],
            [
                'id' => 2,
                'title' => __('High Mountains'),
                'description' => __('Classic Style'),
                'price' => 0,
            ],
            [
                'id' => 3,
                'title' => __('Snowy Mountains'),
                'description' => __('Retro Style'),
                'price' => 0,
            ],
            [
                'id' => 4,
                'title' => __('Rainbow'),
                'description' => __('Elegant Style'),
                'price' => 0,
            ],
        ];
    }
}
