<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Characters extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'name' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => false,
            ],
            'thumbnail' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => true,
            ],
            'description' => [
                'type' => 'TEXT',
                'null' => true,
            ], 
            'created_at' => [
                'type' => 'TIMESTAMP',
                'null' => true,  
                'default' => null,
            ],
            'updated_at' => [
                'type' => 'TIMESTAMP',
                'null' => true,  
                'default' => null, 
            ],
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('characters');
    }

    public function down()
    {
        $this->forge->dropTable('characters');
    }
}
