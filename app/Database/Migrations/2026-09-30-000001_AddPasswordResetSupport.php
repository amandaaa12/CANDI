<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddPasswordResetSupport extends Migration
{
    public function up(): void
    {
        if (!$this->hasUserEmailColumn()) {
            $this->forge->addColumn('user', [
                'email' => [
                    'type'       => 'VARCHAR',
                    'constraint' => 254,
                    'null'       => true,
                ],
            ]);
        }

        $emailIndexExists = $this->db
            ->query('SHOW INDEX FROM `user` WHERE Key_name = ?', ['user_email_unique'])
            ->getNumRows() > 0;

        if (!$emailIndexExists) {
            $this->db->query(
                'ALTER TABLE `user` ADD UNIQUE KEY `user_email_unique` (`email`)'
            );
        }

        if (!$this->hasResetTokenTable()) {
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
                'token_hash' => [
                    'type'       => 'CHAR',
                    'constraint' => 64,
                ],
                'expires_at' => [
                    'type' => 'DATETIME',
                ],
                'created_at' => [
                    'type' => 'DATETIME',
                ],
            ]);
            $this->forge->addKey('id', true);
            $this->forge->addKey('user_id');
            $this->forge->addKey('token_hash', false, true);
            $this->forge->createTable('password_reset_tokens');
        }
    }

    public function down(): void
    {
        if ($this->hasResetTokenTable()) {
            $this->forge->dropTable('password_reset_tokens');
        }

        if ($this->hasUserEmailColumn()) {
            $this->db->query('ALTER TABLE `user` DROP INDEX `user_email_unique`');
            $this->forge->dropColumn('user', 'email');
        }
    }

    private function hasUserEmailColumn(): bool
    {
        return $this->db->query('SHOW COLUMNS FROM `user` LIKE ?', ['email'])
            ->getNumRows() > 0;
    }

    private function hasResetTokenTable(): bool
    {
        return $this->db->query('SHOW TABLES LIKE ?', ['password_reset_tokens'])
            ->getNumRows() > 0;
    }
}
