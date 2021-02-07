<?php
namespace App\Database\Migrations;

use Kenjis\CI3Compatible\Library\CI_Migration;

class CreateNews extends CI_Migration
{
    public function up()
    {
        $this->dbforge->add_field([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'auto_increment' => true
            ],
            'title' => [
                'type' => 'VARCHAR',
                'constraint' => 128,
            ],
            'slug' => [
                'type' => 'VARCHAR',
                'constraint' => 128,
            ],
            'text' => [
                'type' => 'TEXT',
            ],
        ]);
        $this->dbforge->add_key('id', true);
        $this->dbforge->add_key('slug');
        $this->dbforge->create_table('news');
    }

    public function down()
    {
        $this->dbforge->drop_table('news');
    }
}
