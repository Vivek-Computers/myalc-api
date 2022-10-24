<?php
    return function ($request, $response, array $parameters) {
        $payload = json_encode(['server' => 'myalc_api'], JSON_PRETTY_PRINT);
        $response->getBody()->write($payload);
        return $response->withHeader('Content-Type', 'application/json');
    }
?>