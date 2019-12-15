<?php

namespace Tests\User;

use Tests\TestCase;

class UserApiTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testCommon()
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
        $responce = $this->json('get', '/api/users/4');

        print "\n" . $responce->getContent() . "\n";

        $responce->assertOk();
    }
}
