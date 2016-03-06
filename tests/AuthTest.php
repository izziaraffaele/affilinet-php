<?php

namespace Affilinet\Tests;

use Affilinet\Auth;

class AuthTest extends \PHPUnit_Framework_TestCase{

    public function setUp()
    {
        $this->auth = new Auth( getenv('AFLN_USERNAME'), getenv('AFLN_PASSWORD') );
    }

    public function testGetToken()
    {
        $token = $this->auth->getToken();
        $this->assertInternalType('string',$token);

        // get token again should return the same token as before
        $this->assertSame( $token, $this->auth->getToken() );
    }
}