<?php

use SigmaPHP\DB\Migrations\Migration;

class CommentsTableMigrationMigration extends Migration
{
    /**
     * @return void
     */
    public function up()
    {
        $this->createTable(
            'comments',
            [
                ['name' => 'id', 'type' => 'bigint', 'primary' => true],
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
        $this->dropTable('comments');
    }
}