<?php

namespace Affilinet;

/**
 * Creates a pre-configured Soap client with the default settings.
 *
 * @param string $wsdl    WSDL of the service
 * @param array  $config  Soap client configuration
 *
 * @return \SoapClient
 */
function default_soap_client($wsdl, array $config = [])
{
    return new \SoapClient($wsdl, default_soap_config($config));
}


/**
 * Form default configuration settings for Soap Client.
 *
 * @param array $config    Soap client configuration
 * @return array
 */
function default_soap_config(array $config = [])
{
    return array_merge([
        'trace'         => 1,
        'exceptions'    => 0, 
        'soap_version'  => SOAP_1_1
    ], $config );
}