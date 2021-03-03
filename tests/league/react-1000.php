<?php
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

$benchmark->registerTest(
    function () {
        // It is not available to work in react style, because is prepares routes while dispatching request
        return 1;
    },
    "[league/react/1000 routes] Not available\r\n");

$benchmark->registerTest(
    function () {
        // It is not available to work in react style, because is prepares routes while dispatching request
        return 1;
    },
    "[league/react/1000 routes] Not available\r\n");
