<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateCmsPages extends Migration
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
            'route_key' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
            ],
            'route_path' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
            ],
            'query_string' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'section' => [
                'type'       => 'VARCHAR',
                'constraint' => 120,
                'null'       => true,
            ],
            'slug' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
            ],
            'title' => [
                'type'       => 'VARCHAR',
                'constraint' => 255,
                'null'       => true,
            ],
            'html_content' => [
                'type' => 'TEXT',
            ],
            'source_path' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'source_type' => [
                'type'       => 'VARCHAR',
                'constraint' => 50,
                'default'    => 'mirror',
            ],
            'status' => [
                'type'       => 'VARCHAR',
                'constraint' => 20,
                'default'    => 'published',
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
        $this->forge->addUniqueKey('route_key');
        $this->forge->createTable('cms_pages', true);
    }

    public function down()
    {
        $this->forge->dropTable('cms_pages', true);
    }
}
