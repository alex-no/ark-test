<?php

namespace Tests\User;

use Tests\TestCase;

class UserApiTest extends TestCase
{


    /**
     *
     * @return array
     */
    public function urlProviderSuccessGet()
    {
        return [
            ['/api/users'],
            ['/api/users/1'],
        ];
    }

    /**
     *
     * @return array
     */
    public function urlProviderErrorGet()
    {
        return [
            ['/api/users/111'],
        ];
    }

    /**
     *
     * @return array
     */
    public function urlProviderSuccessPost()
    {
        return [
            ['post', '/api/users', ['first_name' => 'Xxxx3', 'last_name' => 'Yyyyy2', 'phone' => '000000000', 'email' => 'email345@dfdf', 'password' => '12345678']],
        ];
    }

    /**
     * A basic test example.
     * @dataProvider urlProviderSuccessGet
     * @return void
     */
    public function testSuccessGet($uri)
    {
        /* @var $responce \Illuminate\Foundation\Testing\TestResponse */
        $responce = $this->json('get', $uri);
        //print "\n" . $responce->getContent() . "\n";
        $responce->assertOk();
    }
    /**
     * A basic test example.
     * @dataProvider urlProviderErrorGet
     * @return void
     */
    public function testErrorGet($uri)
    {
        /* @var $responce \Illuminate\Foundation\Testing\TestResponse */
        $responce = $this->json('get', $uri);
        //print "\n" . $responce->getContent() . "\n";
        $responce->assertNotFound();
    }
    /**
     * A basic test example.
     * @dataProvider urlProviderSuccessPost
     * @return void
     */
    public function otestSuccessPost($method, $uri, array $data)
    {
        /* @var $responce \Illuminate\Foundation\Testing\TestResponse */
        $responce = $this->json($method, $uri, $data);
        print "\n" . $responce->getContent() . "\n";
        $responce->assertOk();
    }

}
