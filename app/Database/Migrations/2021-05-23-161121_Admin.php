<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Admin extends Migration {

	public function up() {
		$this->forge->addField([
            'email'       => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
			'username'       => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'password' => [
                'type' => 'TEXT',
                'null' => true,
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

        $this->forge->addKey('email', true);
        $this->forge->createTable('admin');
	}

	public function down() {
		$this->forge->dropTable('admin');
	}
}
