<?php
    return function ($request, $response, array $parameters) {
        require_once PATH_APP . '/Learners/Learners.class.php';

        $learners = new Learners();
        [$status, $payload] = $learners->getLearnerImage($parameters['roll'] ?? null);

        $response->getBody()->write($payload);
        return $response->withStatus($status)->withHeader('Content-Type', 'application/json');
    }
?>