<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class ApiUsers extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'apiuser_id' => ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'username'   => ['type' => 'varchar', 'constraint' => 40, 'unique' => true],
            'key'        => ['type' => 'varchar', 'constraint' => 60, 'unique' => true, 'null' => true],
            'scope'      => ['type' => 'VARCHAR', 'constraint' => 20, 'null' => true],
            'created_at timestamp default current_timestamp',
            'updated_on timestamp DEFAULT current_timestamp ON UPDATE current_timestamp',
            'added_by'   => ['type' => 'int'],
            'is_deleted' => ['type' => 'BOOLEAN', 'default' => false]
        ]);

        $this->forge->addKey('apiuser_id', true);
        $this->forge->addForeignKey('added_by', 'tbl_users', 'user_id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('tbl_apiusers', true);
    }

    public function down()
    {
        $this->forge->dropTable('tbl_apiusers');
    }
}
