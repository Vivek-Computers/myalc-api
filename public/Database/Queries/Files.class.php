<?php
    namespace Database\Queries;
    require_once PATH_QURIES . '/BaseQueries.class.php';
    require_once PATH_DATABASE . '/DBConstants.class.php';

    use Database\DBConstants;

    class Files extends BaseQueries {
        public static function fetchLearnerPhotoByRollNumberByCenterCode ($rollNumber, $centerCode, $database) {
            if(!valId($centerCode) || !valId($rollNumber)) {
                return null;
            }

            $sql = 'SELECT
                        *
                    FROM
                        files
                    WHERE
                        center_code = :center_code
                        AND reference_id = :rollNumber
                        AND file_type_id = :fileTypeId
                        AND is_deleted IS FALSE';

            $params = [
                ':center_code' => $centerCode,
                ':rollNumber' => $rollNumber,
                ':fileTypeId' => DBConstants::FILE_TYPE_STUDENT_PHOTO
            ];

            return self::fetch($sql, $database, $params);
        }
    }
?>