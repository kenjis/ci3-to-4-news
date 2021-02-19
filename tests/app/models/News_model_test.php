<?php

use App\Database\Seeds\NewsSeeder;
use App\Models\News_model;
use Kenjis\CI3Compatible\Test\TestCase\DbTestCase;

/**
 * @group model
 * @group database
 */
class News_model_test extends DbTestCase
{
    /**
     * Should run seeding only once?
     *
     * @var boolean
     */
    protected $seedOnce = true;

    /**
     * The seed file(s) used for all tests within this test case.
     * Should be fully-namespaced or relative to $basePath
     *
     * @var string|array
     */
    protected $seed = NewsSeeder::class;

    /**
     * @var News_model
     */
    private $obj;

    public function setUp(): void
    {
        parent::setUp();

        $this->resetInstance();
        $this->CI->load->model('news_model');
        $this->obj = $this->CI->news_model;
    }

    public function test_When_you_get_all_news_Then_you_get_one_item()
    {
        $result = $this->obj->get_news();
        $this->assertCount(1, $result);
    }

    public function test_When_you_set_news_item_Then_you_have_two_items()
    {
        $_POST = [
            'title' => 'CodeIgniter is awesome!',
            'text' =>
                'It is easy to understand, easy to write tests, and very fast.',
        ];

        $result = $this->obj->set_news();
        $this->assertTrue($result);
        $this->assertCount(2, $this->obj->get_news());
    }

    public function test_When_you_get_news_by_slug_Then_you_get_the_item()
    {
        $item = $this->obj->get_news('codeigniter-is-awesome');
        $this->assertEquals('CodeIgniter is awesome!', $item['title']);
    }
}
