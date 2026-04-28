<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateSlidersTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'image_url' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'sort_order' => [
                'type'       => 'INT',
                'constraint' => 11,
                'default'    => 0,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('sliders', true); // Add true for IF NOT EXISTS
    }

    public function down()
    {
        $this->forge->dropTable('sliders', true);
    }
}
