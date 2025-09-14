<?php

use SigmaPHP\DB\Migrations\Migration;

class CommentsTableMigration extends Migration
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
                ['name' => 'post_id', 'type' => 'varchar', 'size' => 36],
                ['name' => 'user_id', 'type' => 'bigint'],
                ['name' => 'author_name', 'type' => 'varchar', 'size' => 100],
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