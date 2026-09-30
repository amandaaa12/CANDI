<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreatePasswordResetRequests extends Migration
{
    public function up(): void
    {
        if ($this->tableExists('password_reset_requests')) {
            return;
        }

        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'user_id' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
            ],
            'status' => [
                'type'       => 'VARCHAR',
                'constraint' => 20,
                'default'    => 'pending',
            ],
            'requested_at' => [
                'type' => 'DATETIME',
            ],
            'resolved_by' => [
                'type'       => 'INT',
                'constraint' => 11,
                'unsigned'   => true,
                'null'       => true,
            ],
            'resolved_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addKey(['user_id', 'status']);
        $this->forge->createTable('password_reset_requests');
    }

    public function down(): void
    {
        if ($this->tableExists('password_reset_requests')) {
            $this->forge->dropTable('password_reset_requests');
        }
    }

    private function tableExists(string $table): bool
    {
        return $this->db->query('SHOW TABLES LIKE ?', [$table])->getNumRows() > 0;
    }
}
