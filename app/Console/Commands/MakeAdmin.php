<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class MakeAdmin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:admin {name} {email} {pass}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $user=new User();
        $user->name=$this->argument('name');
        $user->email=$this->argument('email');
        $user->password=bcrypt( $this->argument('pass'));
        $user->save();
        return Command::SUCCESS;
    }
}
