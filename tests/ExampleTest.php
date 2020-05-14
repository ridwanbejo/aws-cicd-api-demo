<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->get('/');

        $this->assertEquals(
            $this->app->version(), $this->response->getContent()
        );
    }

    /**
     * A basic test demo endpoint.
     *
     * @return void
     */
    public function testDemo()
    {
        $response = $this->call('GET', '/demo');
        $this->assertEquals(200, $response->status());
    
        $response_json = $this->json('GET', '/demo');
        $response_json->seeJson(['name' => 'Abigail', 'state' => 'CA']);

    }

    /**
     * A basic test pokemon endpoint.
     *
     * @return void
     */
    public function testPokemon()
    {
        $response = $this->call('GET', '/pokemon');
        $this->assertEquals(200, $response->status());
    }

    public function testCheckBeanstalk()
    {
        $response = $this->call('GET', '/check-beanstalk');
        $this->assertEquals(200, $response->status());
    }
}
