<?php
    require_once PATH_APP . '/Base.class.php';

    final class Payments extends Base {
        public function getPayments($rollNumber) {
            if(!$this->isAuthorised()) {
                return $this->getUnAuthorisedResponse();
            }

            require_once PATH_QURIES . '/Payments.class.php';

            $centerInfo = $this->getDecodedToken();

            $payments = (array) Database\Queries\Payments::fetchPaymentsByRollByCenterCode($rollNumber, $centerInfo['center_code'], $this->m_database);
            
            $payload = [
                'success' => true,
                'data' => ['payments' => $payments]
            ];

            return [200, json_encode($payload, JSON_PRETTY_PRINT)];
        }
    }
?>