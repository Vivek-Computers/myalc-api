<?php
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

require_once PATH_DATABASE . '/Database.class.php';

class Base {
    protected $m_database;
    private $m_decodedToken;
    private $m_request;
    private $m_response;
    private $m_parameters;

    public function __construct() {
        $this->m_database = Database::getDatabase();
    }

    protected function encodeJWT($payload) {
        return JWT::encode($payload, $this->getPrivateKey(), 'RS256');
    }

    protected function decodeJWT($encodedToken) {
        $isAuthorized = false;

        try {
            $this->setDecodedToken(stdClassToArray(JWT::decode($encodedToken, new Key($this->getPublicKey(), 'RS256'))));
            $isAuthorized = true;
        } catch(Exception $e) {}

        return $isAuthorized;
    }

    protected function isAuthorised() {
        if(!isset($_SERVER['HTTP_AUTHORIZATION'])) {
            return false;
        }

        return $this->decodeJWT(str_replace( 'Bearer ', '', $_SERVER['HTTP_AUTHORIZATION']));
    }

    protected function getUnAuthorisedResponse() {
        global $g_messages;
        return [403, json_encode(['success' => false, 'message_code' => 'E0001', 'message' => $g_messages['E0001'] ?? ''], JSON_PRETTY_PRINT)];
    }

    private function getPrivateKey() {
        return file_get_contents(PATH_PRIVATE . '/private.pem');
    }

    private function getPublicKey() {
        return file_get_contents(PATH_PRIVATE . '/public.pem');
    }

    protected function getDecodedToken() {
        return $this->m_decodedToken;
    }

    protected function setDecodedToken($token) {
        $this->m_decodedToken = $token;
    }

    protected function setRequest($request) {
        $this->m_request = $request;
    }

    protected function getRequest() {
        return $this->m_request;
    }

    protected function setResponse($response) {
        $this->m_response = $response;
    }

    protected function getResponse() {
        return $this->m_response;
    }

    protected function setParameters($parameters) {
        $this->m_parameters = $parameters;
    }

    protected function getParameters() {
        return $this->m_parameters;
    }
}
?>