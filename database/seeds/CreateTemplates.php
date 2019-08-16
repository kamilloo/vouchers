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
        factory(\App\Models\Template::class,3)->create();
    }
}
