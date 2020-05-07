<?php

namespace App\Console\Commands;

use App\Models\Admin;
use Illuminate\Console\Command;
use Illuminate\Support\Str;

class CreateAdmin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:admin  {email} {password}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create Admin Command';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $email = $this->argument('email');
        $admin = Admin::firstOrNew(compact('email'));
        $password = $this->argument('password');
        $admin->name = Str::before($email, '@');
        $admin->password = \Hash::make($password);
        $admin->save();
        $this->info('Admin was created');
    }
}
