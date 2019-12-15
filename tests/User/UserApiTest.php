<?php

namespace Tests\User;

use Tests\TestCase;
use RonasIT\Support\AutoDoc\Services\SwaggerService;

class UserApiTest extends TestCase
{
    /**
     *
     */
    protected function tearDown(): void
    {
        $currentTestCount = $this->getTestResultObject()->count();
        $allTestCount = $this->getTestResultObject()->topTestSuite()->count();

        if (($currentTestCount == $allTestCount) && (!$this->hasFailed())) {
            $autoDocService = app(SwaggerService::class);

            $autoDocService->saveProductionData();
        }

        parent::tearDown();
    }

    /**
     *
     * @return array
     */
    public function urlProvider()
    {
        return [
            ['get', '/api/users', []],
            ['get', '/api/users/1', []]
        ];
    }

    /**
     * A basic test example.
     * @dataProvider urlProvider
     * @return void
     */
    public function testCommon($method, $uri, array $data)
    {
        /*
        $array = array('names' => array('joe' => array('programmer')));
        $value = array_get($array, 'names.joe');
        print_r ($value);
         */

        /*
        $array = array_collapse([[1, 2, 3], [4, 5, 6], [7, 8, 9]]);
        print_r($array);
        $first = array_first($array, function($key, $value){return $value >= 4;} );
        print "\n!" . $first . "!\n";
         */

        /* @var $responce \Illuminate\Foundation\Testing\TestResponse */
        $responce = $this->json($method, $uri, $data);

        //print "\n" . $responce->getContent() . "\n";

        $responce->assertOk();
    }
}
