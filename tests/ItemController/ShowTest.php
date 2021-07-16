<?php


namespace ItemController;


use Illuminate\Support\Facades\DB;

class ShowTest extends \TestCase
{

    /**
     * Test show route
     * Asked Item does exist
     */
    public function testShowItemExist()
    {
        // Create a fake Item
        $item = $this->createItem();
        // Request
        $response = $this->get('/api/items/' . $item->id . '?api_key=ApiKeyExample');

        // Assert status
        $response->assertResponseOk();
        // Assert structure of data
        $response->seeJsonStructure(
            [
                "name",
                "vegetarian",
                "vegan",
                "glutenfree",
                "sweet",
                "salty",
                "spicy_level",
            ]);
        // Assert Json
        $response->seeJson($item->toArray());
    }

    /**
     * Test show route
     * Asked Item does not exist
     */
    public function testShowItemNotExist()
    {
        // Request
        $response = $this->get('/api/items/0?api_key=ApiKeyExample');

        // Assert status
        $response->assertResponseStatus(404);
        // Assert Json
        $response->seeJson(["message" => "Error when getting item.","details"=>"No item found with the following ID : 0."]);
    }

    /**
     * Test show route
     * ID given is not an integer
     */
    public function testShowWrongIDType()
    {
        // Request
        $response = $this->get('/api/items/abc?api_key=ApiKeyExample');

        // Assert status
        $response->assertResponseStatus(400);
        // Assert Json
        $response->seeJson(["message" => "Error when getting item.","details"=>"The given ID is not an integer."]);
    }

    /**
     * Test show route
     * Wrong Api Key
     */
    public function testShowWrongAPIKey()
    {
        // Request
        $response = $this->get('/api/items/1?api_key=notTheGoodOne');

        // Assert status
        $response->assertResponseStatus(403);
        // Assert Json
        $response->seeJson(["Wrong API Key"]);
    }
}
