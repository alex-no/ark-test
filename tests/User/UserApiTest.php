<?php

namespace Tests\User;

use Tests\TestCase;

class UserApiTest extends TestCase
{
    use \Tests\SaveSwagger;

    /**
     * A test login user
     * @return void
     */
    public function testLogin()
    {
        $data= [
            'email'      => 'test1@mail.com',
            'password'   => '12345678',
        ];

        /* @var $responce \Illuminate\Foundation\Testing\TestResponse */
        $responce = $this->json('post', '/api/auth/login', $data);

        $content = $responce->getContent();
        print "\n" . $content . "\n";
        $this->assertNotTrue(boolval(strstr($content, 'errors')));
        //$responce->assertOk();
    }
}
