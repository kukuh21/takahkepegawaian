<?php

use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $administrator = new \App\User;
        $administrator->nama = "Kukuh Aprianto";
        $administrator->email = "kaprianto@gmail.com";
        $administrator->password = \Hash::make("123456789");
        $administrator->username = 'kukuh';
        $administrator->roles = json_encode(["ADMIN"]);
        $administrator->status = 'ACTIVE';
        $administrator->save();
    }
}
