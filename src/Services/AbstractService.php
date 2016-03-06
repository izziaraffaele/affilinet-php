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

        $params = array_merge([
            'CredentialToken' => $this->auth->getToken(),
        ],$params[0]);

        $response = $this->client->$method($params);

        return new Response( $response );
    }
}