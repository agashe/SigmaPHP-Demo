<?php

use SigmaPHP\DB\Seeders\Seeder;

class UserSeeder extends Seeder
{
    /**
     * @return void
     */
    public function run()
    {
        $this->insert(
            'users',
            [
                [
                    'email' => 'john.doe@example.com',
                    'password' => '25d55ad283aa400af464c76d713c07ad',
                    'first_name' => 'John',
                    'last_name' => 'Doe',
                    'is_verified' => true,
                ],
            ]
        );
    }
}