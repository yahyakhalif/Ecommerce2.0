<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ApiProductPaths extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'apiproductpath_id' => ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'added_by'          => ['type' => 'int', 'null' => true],
            'path'              => [
                'type'       => 'ENUM',
                'constraint' => ['userdetails', 'products', 'transactions', 'auth']
            ],
            'created_at timestamp default current_timestamp',
            'updated_at timestamp DEFAULT current_timestamp ON UPDATE current_timestamp',
            'is_deleted'        => ['type' => 'BOOLEAN', 'default' => false]
        ]);

        $this->forge->addKey('apiproductpath_id', true);
        $this->forge->addForeignKey('added_by', 'tbl_users', 'user_id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('tbl_apiproductpaths', true);
    }

    public function down()
    {
        $this->forge->dropTable('tbl_apiproductpaths');
    }
}
