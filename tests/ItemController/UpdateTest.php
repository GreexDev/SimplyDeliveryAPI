<?php


namespace ItemController;


use Illuminate\Support\Facades\DB;

class UpdateTest extends \TestCase
{

    /**
     * Test update route
     * Minimum data is provided
     * Asked Item does exist
     */
    public function testUpdateItemMinData()
    {
        // Create a fake Item
        $item = $this->createItem();
        $data = ['name' => '1'];
        // Request
        $response = $this->put('/api/items/' . $item->id . '?api_key=ApiKeyExample',$data);

        // Assert status
        $response->assertResponseOk();
        // Assert Json
        $response->seeJson($data);
        // Assert Database
        $data['id'] = $item->id;
        $this->seeInDatabase('items',$data);
    }

    /**
     * Test update route
     * Maximum data is provided
     * Asked Item does exist
     */
    public function testUpdateItemMaxData()
    {
        // Create a fake Item
        $item = $this->createItem();
        $data = [
            "name" => "1",
            "vegetarian" => 1,
            "vegan" => 1,
            "glutenfree" => 1,
            "sweet" => 1,
            "salty" => 1,
            "spicy_level" => strval(1),
        ];
        // Request
        $response = $this->put('/api/items/' . $item->id . '?api_key=ApiKeyExample',$data);

        // Assert status
        $response->assertResponseOk();
        // Assert Json
        $response->seeJson($data);
        // Assert Database
        $data['id'] = $item->id;
        $this->seeInDatabase('items',$data);
    }

    /**
     * Test update route
     * No data is provided
     * Asked Item does exist
     */
    public function testUpdateItemNoData()
    {
        // Create a fake Item
        $item = $this->createItem();
        // Request
        $response = $this->put('/api/items/' . $item->id . '?api_key=ApiKeyExample');

        // Assert status
        $response->assertResponseOk();
        // Assert Json
        $response->seeJson($item->toArray());
        // Assert Database
        $this->seeInDatabase('items',$item->toArray());
    }

    /**
     * Test update route
     * Asked Item does not exist
     */
    public function testUpdateItemNotExist()
    {
        // Request
        $response = $this->put('/api/items/0?api_key=ApiKeyExample');

        // Assert status
        $response->assertResponseStatus(404);
        // Assert Json
        $response->seeJson(["message" => "Error when updating item.","details"=>"No item found with the following ID : 0."]);
    }

    /**
     * Test update route
     * ID given is not an integer
     */
    public function testUpdateWrongIDType()
    {
        // Request
        $response = $this->put('/api/items/abc?api_key=ApiKeyExample');

        // Assert status
        $response->assertResponseStatus(400);
        // Assert Json
        $response->seeJson(["message" => "Error when updating item.","details"=>"The given ID is not an integer."]);
    }

    /**
     * Test update route
     * Wrong Api Key
     */
    public function testUpdateItemWrongAPIKey()
    {
        // Request
        $response = $this->put('/api/items/0?api_key=notTheGoodOne');

        // Assert status
        $response->assertResponseStatus(403);
        // Assert Json
        $response->seeJson(["Wrong API Key"]);
    }
}
