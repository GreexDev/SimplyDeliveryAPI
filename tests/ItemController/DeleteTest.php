<?php


namespace ItemController;


use Illuminate\Support\Facades\DB;

class DeleteTest extends \TestCase
{

    /**
     * Test delete route
     * Asked Item does exist
     */
    public function testDeleteItemExist()
    {
        // Create a fake Item
        $item = $this->createItem();
        // Request
        $response = $this->delete('/api/items/' . $item->id . '?api_key=ApiKeyExample');

        // Assert status
        $response->assertResponseOk();
        // Assert Json
        $response->seeJson(["message" => "Item deleted."]);
        // Assert Database
        $this->notSeeInDatabase('items',["id"=>$item->id]);
    }

    /**
     * Test delete route
     * Asked Item does not exist
     */
    public function testDeleteItemNotExist()
    {
        // Request
        $response = $this->delete('/api/items/0?api_key=ApiKeyExample');

        // Assert status
        $response->assertResponseStatus(404);
        // Assert Json
        $response->seeJson(["message" => "Error when deleting item.","details"=>"No item found with the following ID : 0."]);
    }

    /**
     * Test delete route
     * ID given is not an integer
     */
    public function testDeleteWrongIDType()
    {
        // Request
        $response = $this->delete('/api/items/abc?api_key=ApiKeyExample');

        // Assert status
        $response->assertResponseStatus(400);
        // Assert Json
        $response->seeJson(["message" => "Error when deleting item.","details"=>"The given ID is not an integer."]);
    }

    /**
     * Test delete route
     * Wrong Api Key
     */
    public function testDeleteWrongAPIKey()
    {
        // Request
        $response = $this->delete('/api/items/1?api_key=notTheGoodOne');

        // Assert status
        $response->assertResponseStatus(403);
        // Assert Json
        $response->seeJson(["Wrong API Key"]);
    }
}
