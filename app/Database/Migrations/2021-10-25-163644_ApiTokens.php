<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ApiTokens extends Migration
{
    public function up() {
        $this->forge->addField([
            'apitoken_id'             => ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'token'          => ['type' => 'varchar', 'constraint' => 40],
            'api_userid'        => ['type' => 'int', 'constraint' => 11, 'unsigned' => true],
            'api_productid' => ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'null' => true],
            'client_id'      => ['type' => 'varchar', 'constraint' => 80],
            'scope'          => ['type' => 'VARCHAR', 'constraint' => 4000, 'null' => true],
            'expires_at timestamp DEFAULT current_timestamp',
            'created_at timestamp DEFAULT current_timestamp',
            'updated_at timestamp DEFAULT current_timestamp ON UPDATE current_timestamp',
            'is_deleted'     => ['type' => 'BOOLEAN', 'default' => false]
        ]);

        $this->forge->addKey('apitoken_id', true);
        $this->forge->addForeignKey('api_userid', 'tbl_apiusers', 'apiuser_id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('api_productid', 'tbl_apiproducts', 'apiproduct_id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('tbl_apitokens', true);
    }

    public function down() {
        $this->forge->dropTable('tbl_apitokens');
    }
}
