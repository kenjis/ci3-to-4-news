<?php

class NewsSeeder extends Seeder
{
    private $table = 'news';

    public function run()
    {
        $this->db->truncate($this->table);
        // Reset autoincrement sequence number in SQLite
        if (
            $this->db->dbdriver === 'sqlite3'
            || $this->db->subdriver === 'sqlite'
        ) {
            $this->db->query(
                "DELETE FROM sqlite_sequence WHERE name='$this->table';"
            );
        }

        $data = [
            'id'    => 1,
            'title' => 'News test',
            'slug'  => 'news-test',
            'text'  => 'News text',
        ];
        $this->db->insert($this->table, $data);
    }
}
