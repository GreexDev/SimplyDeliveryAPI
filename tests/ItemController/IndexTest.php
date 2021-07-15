<?php


namespace ItemController;


class IndexTest extends \TestCase
{
    public function testIndex()
    {
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
