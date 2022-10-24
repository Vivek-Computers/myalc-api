<?php
require_once PATH_APP . '/Base.class.php';
require_once PATH_QURIES . '/Centers.class.php';

final class Auth extends Base {
    private $m_centerCode;
    private $m_password;

    // Get Token
    public function getToken() {
        $center = (array) Database\Queries\Centers::fetchCenterByCenterCodeByPassword($this->getCenterCode(), $this->getPassword(), $this->m_database);

        if(0 == count($center)) {
            global $g_messages;

            $payload = [
                'success' => false,
                'message_code' => 'E0002',
                'message' => $g_messages['E0002'] ?? '',
                'data' => [
                    'token' => ''
                ]
            ];

            return [401, json_encode($payload, JSON_PRETTY_PRINT) ];
        }

        $payload = [
            'success' => true,
            'data' => [
                'token' => $this->encodeJWT($center)
            ]
        ];

        return [200, json_encode($payload, JSON_PRETTY_PRINT) ];
    }

    // Getter Setters
    public function getCenterCode() {
        return $this->m_centerCode;
    }

    public function setCenterCode($centerCode) {            
        $this->m_centerCode = $centerCode;
    }

    public function getPassword() {
        return $this->m_password;
    }

    public function setPassword($password) {
        $this->m_password = $password;
    }    

}
?>