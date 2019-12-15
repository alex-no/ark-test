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
        /* @var $responce \Illuminate\Foundation\Testing\TestResponse */
        $responce = $this->json('get', '/api/users/4');

        print "\n" . $responce->getContent() . "\n";

        $responce->assertOk();
    }
}
