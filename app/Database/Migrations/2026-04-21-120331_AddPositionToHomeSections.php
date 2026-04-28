<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddPositionToHomeSections extends Migration
{
    public function up()
    {
        $this->forge->addColumn('home_sections', [
            'position' => [
                'type'       => 'VARCHAR',
                'constraint' => '20',
                'default'    => 'main',
                'after'      => 'type'
            ],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('home_sections', 'position');
    }
}
