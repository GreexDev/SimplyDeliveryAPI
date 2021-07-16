<?php


namespace ItemController;


class UnitTest extends \TestCase
{
    /**
     * Test checkInteger function
     */
    public function testCheckInteger()
    {
        // Request
        $response = $this->get('/api/items?api_key=notTheGoodOne');

        // Assert status
        $response->assertResponseStatus(403);
        // Assert Json
        $response->seeJson(["Wrong API Key"]);
    }

    /**
     * Test checkIfItemExist function
     */
    public function testCheckIfItemExist()
    {
        // Create fake Items
        $item = $this->createItem('1');
        $item = $this->createItem('2');
        $item = $this->createItem('3');
        // Request
        $response = $this->get('/api/items?api_key=ApiKeyExample');

        // Assert status
        $response->assertResponseOk();
        // Assert structure of data
        $response->seeJsonStructure(
            ['*' => [
                "name",
                "vegetarian",
                "vegan",
                "glutenfree",
                "sweet",
                "salty",
                "spicy_level",
            ]
            ]);
    }
}
