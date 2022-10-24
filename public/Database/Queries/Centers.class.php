<?php
    namespace Database\Queries;
    require_once PATH_QURIES . '/BaseQueries.class.php';

    class Centers extends BaseQueries {
        public static function fetchCenterByCenterCodeByPassword($centerCode, $password, $database) {
            if(!valStr($centerCode) || !valStr($password)) {
                return null;
            }

            $sql = 'SELECT
                        center_code,
                        center_name,
                        center_addr,
                        center_owner,
                        contact_no,
                        email_id,
                        expiry_date,
                        receipt_seq
                    FROM
                        centers
                    WHERE
                        center_code = :center_code
                        AND password = :password
                        AND is_deleted IS FALSE';

            $params = [
                ':center_code' => $centerCode,
                ':password' => $password
            ];

            return self::fetch($sql, $database, $params);
        }
    }
?>