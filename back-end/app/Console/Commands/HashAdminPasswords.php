<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class HashAdminPasswords extends Command
{
    protected $signature = 'hash:admin-passwords';
    protected $description = 'Hash all existing admin passwords using Bcrypt';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $admins = Admin::all();

        foreach ($admins as $admin) {
            // Check if the password is already hashed
            if (!Hash::needsRehash($admin->password)) {
                continue;
            }

            // Hash the password and save it
            $admin->password = Hash::make($admin->password);
            $admin->save();
        }

        $this->info('All admin passwords have been hashed successfully.');
    }
}
