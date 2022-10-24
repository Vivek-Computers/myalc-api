<?php
    return function ($request, $response, array $parameters) {
        require_once PATH_APP . '/Payments/Payments.class.php';

        $payments = new Payments();
        [$status, $payload] = $payments->getPayments($parameters['roll'] ?? null);

        $response->getBody()->write($payload);
        return $response->withStatus($status)->withHeader('Content-Type', 'application/json');
    }
?>