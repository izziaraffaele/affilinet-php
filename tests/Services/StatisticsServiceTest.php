<?php

namespace Affilinet\Tests\Services;

use Affilinet\Auth;
use Affilinet\Services\StatisticsService;

class StatisticsServiceTest extends \PHPUnit_Framework_TestCase{
    
    public function testGetSubIdStatistics()
    {
        $auth = new Auth(getenv('AFLN_USERNAME'), getenv('AFLN_PASSWORD') );

        $authMock = $this->getMockBuilder('\Affilinet\Auth')
                        ->setConstructorArgs( [ getenv('AFLN_USERNAME'), getenv('AFLN_PASSWORD') ] )
                        ->setMethods(['getToken'])
                        ->getMock();

        $authMock->expects($this->once())->method('getToken')->willReturn($auth->getToken());

        $service = new StatisticsService($authMock);

        $response = $service->getSubIdStatistics([
                'GetSubIdStatisticsRequestMessage' => [
                'StartDate' => strtotime("-2 weeks"),
                'EndDate' => strtotime("today"),
                'ProgramIds' => [7964],
                'ProgramTypes' => 'PayPerSaleLead',
                'SubId' => '',
                'MaximumRecords' => '100',
                'TransactionStatus' => 'Confirmed',
                'ValuationType' => 'DateOfRegistration'
            ]
        ]);

        $this->assertInstanceOf('\Affilinet\Contracts\ResponseInterface', $response );
        $this->assertFalse( $response->errors() );
        $this->assertInternalType( 'array', $response->body() );
        $this->assertGreaterThan( 0, count($response->body()) );
    }
}