<?php
namespace App\Database\Seeds;

use Kenjis\CI3Compatible\Library\Seeder;

class NewsSeeder extends Seeder
{
    private $table = 'news';

    public function run()
    {
        $this->db_->truncate($this->table);
        // Reset autoincrement sequence number in SQLite
        if (
            $this->db->DBDriver === 'SQLite3'
        ) {
            $this->db_->query(
                "DELETE FROM sqlite_sequence WHERE name='$this->table';"
            );
        }

        $data = [
            'id'    => 1,
            'title' => 'News test',
            'slug'  => 'news-test',
            'text'  => 'News text',
        ];
        $this->db_->insert($this->table, $data);
    }
}
