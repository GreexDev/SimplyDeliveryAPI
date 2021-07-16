<?php

use Laravel\Lumen\Testing\TestCase as BaseTestCase;
abstract class TestCase extends BaseTestCase
{
    use \Laravel\Lumen\Testing\DatabaseMigrations;
    /**
     * Creates the application.
     *
     * @return \Laravel\Lumen\Application
     */
    public function createApplication()
    {
        return require __DIR__.'/../bootstrap/app.php';
    }

    /**
     * Create an item for test purpose
     * Will not be commit
     * @param string $name
     * @param int $vegetarian
     * @param int $vegan
     * @param int $glutenfree
     * @param int $sweet
     * @param int $salty
     * @param int $spicy_level
     * @return mixed
     */
    public function createItem($name = 'example', $vegetarian = 0, $vegan = 0, $glutenfree = 0, $sweet = 0, $salty = 0, $spicy_level = 0){
        $item = \App\Models\Item::create([
            "name" => $name,
            "vegetarian" => $vegetarian,
            "vegan" => $vegan,
            "glutenfree" => $glutenfree,
            "sweet" => $sweet,
            "salty" => $salty,
            "spicy_level" => strval($spicy_level),
        ]);
        return $item;
    }
}
