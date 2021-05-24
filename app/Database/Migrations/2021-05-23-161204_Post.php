<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Post extends Migration {
	
	public function up() {

		$this->forge->addField([
            'id'          => [
                'type'           => 'INT',
                'constraint'     => 20,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'image'       => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
			'score'       => [
                'type'       => 'INT',
                'constraint' => '255',
            ],
            'user_email' => [
                'type' => 'VARCHAR',
                'constraint' => '100'
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
        $this->forge->addField('CONSTRAINT FOREIGN KEY (user_email) REFERENCES users(email)');
        $this->forge->createTable('post');
	}

	public function down() {
		$this->forge->dropTable('post');
	}
}
