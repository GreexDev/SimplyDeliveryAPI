<?php


namespace ItemController;


class IndexTest extends \TestCase
{
    /**
     * Test index route
     */
    public function testIndex()
    {
        // Create fake Items
        $this->createItem('1');
        $this->createItem('2');
        $this->createItem('3');
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

    /**
     * Test index route
     * Wrong Api Key
     */
    public function testIndexWrongAPIKey()
    {
        // Request
        $response = $this->get('/api/items?api_key=notTheGoodOne');

        // Assert status
        $response->assertResponseStatus(403);
        // Assert Json
        $response->seeJson(["Wrong API Key"]);
    }
}
