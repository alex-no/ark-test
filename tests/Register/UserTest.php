<?php

namespace Tests\User;

use Tests\TestCase;

class UserTest extends TestCase
{
    use \Tests\SaveSwagger;

    /**
     * A register new user
     * @return void
     */
    public function testCreate()
    {
        $data= [
            'first_name' => 'FirseName',
            'last_name'  => 'LastName',
            'phone'      => '+380000001234',
            'email'      => 'test1@mail.com',
            'password'   => '12345678',
        ];

        /* @var $responce \Illuminate\Foundation\Testing\TestResponse */
        $responce = $this->json('post', '/api/user', $data);

        $content = $responce->getContent();
        //print "\n" . $content . "\n";
        $this->assertNotTrue(boolval(strstr($content, 'errors')));
        //$responce->assertOk();
    }

}
