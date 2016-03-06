<?php

namespace Affilinet\Contracts;

interface AuthInterface {
    function getToken();
    function setToken( $token = null, $expiration = null);
}