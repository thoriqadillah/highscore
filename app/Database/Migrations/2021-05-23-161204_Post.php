<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Post extends Migration {
	
	public function up() {

		$this->forge->addField([
            'id'          => [
                'type'           => 'INT',
                'constraint'     => 10,
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
            'verified' => [
                'type' => 'BOOLEAN',
                'default' => false
            ],
            'game_id' => [
                'type'      => 'INT',
                'unasigned' => true
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
        // $this->forge->addForeignKey('game_id', 'games', 'id');
        $this->forge->addForeignKey('user_email', 'users', 'email');
        $this->forge->createTable('post');
	}

	public function down() {
		$this->forge->dropTable('post');
	}
}
