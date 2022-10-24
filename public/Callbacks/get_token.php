<?php
    return function ($request, $response, array $parameters) {
        require_once PATH_APP . '/Auth/Auth.class.php';
        
        $data = $request->getParsedBody();
       display(json_decode( $request->getBody(),true));
       exit;
        $auth = new Auth();
        $auth->setCenterCode($data['centerCode'] ?? null);
        $auth->setPassword($data['password'] ?? null);
        [$status, $payload] = $auth->getToken();

        $response->getBody()->write($payload);
        return $response->withStatus($status)->withHeader('Content-Type', 'application/json');
    }
?>