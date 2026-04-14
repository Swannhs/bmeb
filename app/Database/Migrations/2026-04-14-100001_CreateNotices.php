<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateNotices extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INTEGER',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'title' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'slug' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'content' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'publish_date' => [
                'type' => 'DATE',
            ],
            'is_new' => [
                'type'       => 'TINYINT',
                'constraint' => 1,
                'default'    => 1,
            ],
            'category' => [
                'type'       => 'VARCHAR',
                'constraint' => '50',
                'default'    => 'সাধারণ',
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addUniqueKey('slug');
        $this->forge->createTable('notices', true);
    }

    public function down()
    {
        $this->forge->dropTable('notices', true);
    }
}
