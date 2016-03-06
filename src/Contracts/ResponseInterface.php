<?php

namespace Affilinet\Contracts;

interface ResponseInterface{
    function hasErrors();
    function errors();
    function body();
}