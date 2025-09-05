<?php

use SigmaPHP\DB\Migrations\Migration;

class UsersTableMigration extends Migration
{
    /**
     * @return void
     */
    public function up()
    {
        $this->createTable(
            'users',
            [
                ['name' => 'id', 'type' => 'bigint', 'primary' => true],
                ['name' => 'email', 'type' => 'varchar', 'size' => 100],
                ['name' => 'password', 'type' => 'varchar', 'size' => 255],
                ['name' => 'first_name', 'type' => 'varchar', 'size' => 30],
                ['name' => 'last_name', 'type' => 'varchar', 'size' => 30],
                ['name' => 'is_verified', 'type' => 'bool'],
                ['name' => 'timestamps']
            ]
        );
    }

    /**
     * @return void
     */
    public function down()
    {
        $this->dropTable('users');
    }
}