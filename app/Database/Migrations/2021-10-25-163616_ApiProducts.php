<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ApiProducts extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'apiproduct_id' => ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'added_by'      => ['type' => 'int', 'null' => true],
            'productname'   => ['type' => 'ENUM', 'constraint' => ['userdetails', 'products', 'transactions']],
            'created_at timestamp default current_timestamp',
            'updated_on timestamp DEFAULT current_timestamp ON UPDATE current_timestamp',
            'is_deleted'    => ['type' => 'BOOLEAN', 'default' => false]
        ]);

        $this->forge->addKey('apiproduct_id', true);
        $this->forge->addForeignKey('added_by', 'tbl_users', 'user_id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('tbl_apiproducts', true);
    }

    public function down()
    {
        $this->forge->dropTable('tbl_apiproducts');
    }
}
