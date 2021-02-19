<?php

use App\Models\News_model;
use Kenjis\CI3Compatible\Core\CI_Loader;
use Kenjis\CI3Compatible\Core\CI_Input;
use Kenjis\CI3Compatible\Database\CI_DB_result;
use Kenjis\CI3Compatible\Database\CI_DB;
use Kenjis\CI3Compatible\Test\TestCase\TestCase;
use PHPUnit\Framework\MockObject\MockObject;

/**
 * @group model
 */
class News_model_with_mocks_test extends TestCase
{
    /**
     * @var News_model
     */
    private $obj;

    public function setUp(): void
    {
        parent::setUp();

        // Reset CodeIgniter super object
        $this->resetInstance();

        // Create mock object for CI_Loader
        /** @var CI_Loader $loader */
        $loader = $this->getDouble(CI_Loader::class, [
            'database' => $this->returnSelf(),
        ]);

        // Inject mock object into CodeIgniter super object
        $this->CI->load = $loader;

        $this->obj = new News_model();
    }

    public function test_When_call_get_news_without_args_Then_get_all_items()
    {
        $result_array = [
            [
              "id"    => "1",
              "title" => "News test",
              "slug"  => "news-test",
              "text"  => "News text",
            ],
            [
              "id"    => "2",
              "title" => "News test 2",
              "slug"  => "news-test-2",
              "text"  => "News text 2",
            ],
        ];

        // Create mock object for CI_DB_result
        $db_result = $this->getDouble(CI_DB_result::class, [
            'result_array' => $result_array,
        ]);

        // Create mock object for CI_DB
        $db = $this->getMock_CI_DB('get', ['news'], $db_result);

        // Inject mock object into the model
        $this->obj->db = $db;

        $result = $this->obj->get_news();
        $this->assertEquals($result_array, $result);
    }

    /**
     * Create Mock Object for CI_DB
     *
     * @param string $method method name to mock
     * @param array $args    the arguments
     * @param mixed $return  the return value
     * @return MockObject
     */
    private function getMock_CI_DB($method, $args, $return)
    {
        $db = $this->getMockBuilder(CI_DB::class)
            ->disableOriginalConstructor()
            ->getMock();
        $mocker = $db->expects($this->once())
            ->method($method);
        $mocker->with(...$args);
        $mocker->willReturn($return);

        return $db;
    }

    public function test_When_call_get_news_with_slug_Then_get_the_item()
    {
        $slug = 'news-test-2';
        $row_array = [
            "id"    => "2",
            "title" => "News test 2",
            "slug"  => "news-test-2",
            "text"  => "News text 2",
        ];

        // Create mock object for CI_DB_result
        $db_result = $this->getDouble(CI_DB_result::class, [
            'row_array' => $row_array,
        ]);

        // Create mock object for CI_DB
        $db = $this->getMock_CI_DB(
            'get_where', ['news', ['slug' => $slug]] , $db_result
        );

        // Inject mock object into the model
        $this->obj->db = $db;

        $item = $this->obj->get_news($slug);
        $this->assertEquals($row_array, $item);
    }

    public function test_When_post_data_Then_inserted_into_news_table_and_return_true()
    {
        // Create mock object for CI_Input
        $input = $this->getMockBuilder(CI_Input::class)
            ->disableOriginalConstructor()
            ->getMock();
        // Can't use `$input->method()`, because CI_Input has method() method
        $input->expects($this->any())->method('post')
            ->willReturnMap(
                [
                    // post($index = NULL, $xss_clean = NULL)
                    ['title', null, 'News Title'],
                    ['text',  null, 'News Text'],
                ]
            );

        // Create mock object for CI_DB
        $db = $this->getMock_CI_DB(
            'insert',
            [
                'news',
                [
                    "title" => "News Title",
                    "slug"  => "news-title",
                    "text"  => "News Text",
                ]
            ],
            true
        );

        // Inject mock objects into the model
        $this->obj->input = $input;
        $this->obj->db = $db;

        $result = $this->obj->set_news();
        $this->assertTrue($result);
    }
}
