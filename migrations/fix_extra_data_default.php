<?php

namespace mundophpbb\simpledown\migrations;

class fix_extra_data_default extends \phpbb\db\migration\migration
{
    public static function depends_on()
    {
        return ['\mundophpbb\simpledown\migrations\install'];
    }

    public function update_schema()
    {
        return [
            'change_columns' => [
                $this->table_prefix . 'simpledown_logs' => [
                    'extra_data' => ['TEXT_UNI', ''],
                ],
            ],
        ];
    }

    public function update_data()
    {
        return [
            ['custom', [[$this, 'fix_extra_data_column']]],
        ];
    }

    public function fix_extra_data_column()
    {
        // Força o DEFAULT '' e permite NULL temporariamente se necessário, depois corrige
        $this->db->sql_query('ALTER TABLE ' . $this->table_prefix . 'simpledown_logs MODIFY extra_data TEXT NOT NULL DEFAULT ""');
        
        // Opcional: preenche valores NULL existentes (se houver)
        $this->db->sql_query('UPDATE ' . $this->table_prefix . 'simpledown_logs SET extra_data = "" WHERE extra_data IS NULL');
    }

    public function revert_schema()
    {
        return [
            'change_columns' => [
                $this->table_prefix . 'simpledown_logs' => [
                    'extra_data' => ['TEXT_UNI', ''],
                ],
            ],
        ];
    }
}