<?php
    namespace Database\Queries;
    use DTO;
    require_once PATH_QURIES . '/BaseQueries.class.php';

    class Payments extends BaseQueries {
        public static function fetchPaymentsByRollByCenterCode($roll, $centerCode, $database) {
            $sql = 'SELECT
                        *
                    FROM
                        payments p
                    WHERE
                        p.center_code = :center_code
                        AND p.roll = :roll';

            $params = [
                ':center_code' => $centerCode,
                ':roll' => $roll
            ];

            return self::fetchAll($sql, $database, $params);
        }
    }
?>