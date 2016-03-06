<?php

namespace Affilinet;

use Affilinet\Contracts\ResponseInterface;

class Response implements ResponseInterface{
    public function __construct($soapResponse)
    {
        $this->soapResponse = $soapResponse;
    }

    public function body()
    {
        return (array) $this->soapResponse;
    }

    public function errors()
    {
        return ( !$this->hasErrors() ) ? false : [ 
            'message' => $this->soapResponse->getMessage(), 
            'code'=> $this->soapResponse->getCode() 
        ];
    }

    public function hasErrors()
    {
        return $this->soapResponse instanceof \SoapFault;
    }
}