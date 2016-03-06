<?php

namespace Affilinet\Services;

use Affilinet\Response;
use Affilinet\Contracts\AuthInterface;

abstract class AbstractService{

    private $client;

    public function __construct( AuthInterface $auth )
    {
        $this->auth = $auth;
        $this->client = \Affilinet\default_soap_client(static::WSDL);
    }

    public function __call($method, array $params)
    {
        // sign the request
        $requestMessageKey = ucfirst($method).'RequestMessage';

        $response = $this->client->$method([
            'CredentialToken' => $this->auth->getToken(),
            $requestMessageKey => array_shift($params)
        ]);

        return new Response( $response );
    }
}