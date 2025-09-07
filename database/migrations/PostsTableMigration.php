<?php

use SigmaPHP\DB\Migrations\Migration;

class PostsTableMigration extends Migration
{
    /**
     * @return void
     */
    public function up()
    {
        $this->createTable(
            'posts',
            [
                ['name' => 'id', 'type' => 'uuid'],
                ['name' => 'title', 'type' => 'varchar', 'size' => 100],
                ['name' => 'summary', 'type' => 'varchar', 'size' => 200],
                ['name' => 'body', 'type' => 'text'],
                ['name' => 'user_id', 'type' => 'bigint'],
                ['name' => 'author_name', 'type' => 'varchar', 'size' => 100],
                ['name' => 'comments_count', 'type' => 'int'],
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
        $this->dropTable('posts');
    }
}
