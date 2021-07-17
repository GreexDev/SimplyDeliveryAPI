<?php


namespace ItemController;


use Illuminate\Support\Facades\DB;

class StoreTest extends \TestCase
{

    /**
     * Test store route
     * Minimum data is provided
     */
    public function testStoreItemMinData()
    {
        $data = ['name' => 'example'];
        // Request
        $response = $this->post('/api/items?api_key=ApiKeyExample',$data);

        // Assert status
        $response->assertResponseOk();
        // Assert Json
        $response->seeJson($data);
        // Assert Database
        $this->seeInDatabase('items',$data);
    }

    /**
     * Test store route
     * Maximum data is provided
     */
    public function testStoreItemMaxData()
    {
        $data = [
            "name" => "example",
            "vegetarian" => 1,
            "vegan" => 1,
            "glutenfree" => 1,
            "sweet" => 1,
            "salty" => 1,
            "spicy_level" => strval(1),
        ];
        // Request
        $response = $this->post('/api/items?api_key=ApiKeyExample',$data);

        // Assert status
        $response->assertResponseOk();
        // Assert Json
        $response->seeJson($data);
        // Assert Database
        $this->seeInDatabase('items',$data);
    }

    /**
     * Test store route
     * No data is provided
     */
    public function testStoreItemNoData()
    {
        // Request
        $response = $this->post('/api/items?api_key=ApiKeyExample');

        // Assert status
        $response->assertResponseStatus(400);
        // Assert Json
        $response->seeJson(["message" => "Error when validating the data.","details"=>"The given data was invalid."]);
    }

    /**
     * Test store route
     * Wrong Api Key
     */
    public function testStoreItemWrongAPIKey()
    {
        // Request
        $response = $this->post('/api/items?api_key=notTheGoodOne');

        // Assert status
        $response->assertResponseStatus(403);
        // Assert Json
        $response->seeJson(["Wrong API Key"]);
    }
}
