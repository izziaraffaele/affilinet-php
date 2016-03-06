<?php

namespace Affilinet;

use Affilinet\Contracts\AuthInterface;

/**
 * Manage auth tokens
 */  
class Auth implements AuthInterface{

    const WSDL = 'https://api.affili.net/V2.0/Logon.svc?wsdl';

    /**
     * Your publisher Id
     * @var int
     */
    private $username;

    /**
     * Your publisher web services password 
     * @var string
     */
    private $password;

    /**
     * Current auth token
     * @var string
     */
    private $token;

    /**
     * Token expiration
     * 
     * @var string
     */
    private $tokenExpiration;

    /**
     * Soap Authenticatin service
     * @var AuthenticationService
     */
    private $service;
    
    /**
     * Creates the auth service and sets auth credentials
     *
     * @param int $username your publisher Id
     * @param string $password your publisher web services password 
     */
    public function __construct($username, $password, $token = null, $expiration = null) 
    {
        $this->username = $username;
        $this->password = $password;

        $this->service = default_soap_client(self::WSDL);

        $this->setToken( $token, $expiration );
    }
 
    /**
     * Get authentication token 
     * 
     * @return string
     */
    public function getToken() 
    {
        // If there is no token stored or the token has already expired a new token is requested
        if($this->tokenHasExpired()) 
        {
            $this->token = $this->createToken();
            $this->tokenExpiration = $this->getTokenExpirationDate();
        }
 
        // Return token
        return $this->token;
    }

    public function setToken( $token = null, $expiration = null )
    {
        $this->token = $token;
        $this->expiration = $expiration;

        return $this;
    }
 
    /**
     * Checks if token is expired
     * 
     * @return boolean
     */
    private function tokenHasExpired() 
    {
        if ($this->token && $this->tokenExpiration) 
        {
            return date(DATE_ATOM) > $this->tokenExpiration;
        }

        return true;
    }
 
    /**
     * Create a new authentication token 
     * 
     * @return string 
     */
    private function createToken() 
    {
        // Send a request to the Affilinet Logon Service to get an authentication token
        return $this->service->Logon([
            'Username'  => $this->username,
            'Password'  => $this->password,
            'WebServiceType' => 'Publisher'
        ]);
    }
 
    /**
     * Get token expiration date
     * 
     * @return string 
     */
    private function getTokenExpirationDate() 
    {
        // Send a request to the Affilinet Logon Service to get the token expiration date
        return $this->service->GetIdentifierExpiration($this->token); 
    }
}