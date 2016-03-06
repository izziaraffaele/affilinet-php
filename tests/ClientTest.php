<?php

namespace Affilinet\Tests;

use Affilinet\Client;

class ClientTest extends \PHPUnit_Framework_TestCase{
    
    public function setUp()
    {
        $this->client = new Client( getenv('AFLN_USERNAME'), getenv('AFLN_PASSWORD') );
    }

    public function testService()
    {
        $service = $this->client->service('statistics');
        $this->assertInstanceOf('\Affilinet\Services\StatisticsService', $service);
    }
}