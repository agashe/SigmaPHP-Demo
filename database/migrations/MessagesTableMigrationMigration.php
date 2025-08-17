<?php

use SigmaPHP\DB\Migrations\Migration;

class MessagesTableMigrationMigration extends Migration
{
    /**
     * @return void
     */
    public function up()
    {
        $this->createTable(
            'messages',
            [
                ['name' => 'id', 'type' => 'uuid'],
                ['name' => 'name', 'type' => 'varchar', 'size' => 100],
                ['name' => 'email', 'type' => 'varchar', 'size' => 100],
                ['name' => 'body', 'type' => 'text'],
                ['name' => 'user_id', 'type' => 'bigint'],
                ['name' => 'soft_delete'],
                ['name' => 'timestamps']
            ]
        );
    }

    /**
     * @return void
     */
    public function down()
    {
        $this->dropTable('messages');
    }
}