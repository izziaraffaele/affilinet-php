<?php

namespace Affilinet;

use Affilinet\Contracts\ClientInterface;

class Client implements ClientInterface{

    const SERVICE_TEMPLATE  = '%sService';

    const SERVICE_NAMESPACE = 'Affilinet\Services\\';

    private $auth;

    private $services = [];

    public function __construct($username, $password)
    {
        $this->auth = new Auth($username, $password);
    }

    public function service($name)
    {
        if( !isset( $this->services[ $name ] ) )
        {
            $this->services[$name] = $this->assignService($name);
        }

        return $this->services[$name];
    }

    private function assignService( $name )
    {
        $serviceClass = self::SERVICE_NAMESPACE.sprintf( self::SERVICE_TEMPLATE, ucfirst($name) );

        if( !class_exists( $serviceClass ) )
        {
           throw new Exception("Unable to locate Affilinet service $serviceClass");
        }

        return new $serviceClass( $this->auth );
    }
}