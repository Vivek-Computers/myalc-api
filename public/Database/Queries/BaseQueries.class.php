<?php
    namespace Database\Queries;

    class BaseQueries {
        public static function fetch($sql, $database, $params = []) {
            $statment = $database->prepare($sql);
            $statment->execute($params);

            return $statment->fetch();
        }

        public static function fetchAll($sql, $database, $params = []) {
            $statment = $database->prepare($sql);
            $statment->execute($params);

            return $statment->fetchAll();
        }
    }
?>