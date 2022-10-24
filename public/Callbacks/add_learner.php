<?php
    return function ($request, $response, array $parameters) {
        require_once PATH_APP . '/Learners/Learners.class.php';
        $data = $request->getParsedBody();
        $learners = new Learners();
        [$status, $payload] = $learners->addLearner($data);

        $response->getBody()->write($payload);
        return $response->withStatus($status)->withHeader('Content-Type', 'application/json');
    }
?>