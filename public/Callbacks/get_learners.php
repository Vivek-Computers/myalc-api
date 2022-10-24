<?php
    return function ($request, $response, array $parameters) {
        $params = $request->getQueryParams('');
        require_once PATH_APP . '/Learners/Learners.class.php';

        $learners = new Learners();
        [$status, $payload] = $learners->getLearners($params);

        $response->getBody()->write($payload);
        return $response->withStatus($status)->withHeader('Content-Type', 'application/json');
    }
?>