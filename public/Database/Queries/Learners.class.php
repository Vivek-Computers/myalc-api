<?php
    namespace Database\Queries;
    use DTO;
    require_once PATH_QURIES . '/BaseQueries.class.php';

    class Learners extends BaseQueries {
        public static function fetchLearnersCountByCenterCode($centerCode, $database, $learnersFilter = null) {
            if(!valId($centerCode)) return null;

            $where = '';

            if(valObj($learnersFilter, DTO\LearnersFilter::class)) {
                if(valStr($learnersFilter->getName())) {
                    $where .= ' AND (
                                    l.fname LIKE \'%' . $learnersFilter->getName() . '%\'
                                    OR l.mname LIKE \'%' . $learnersFilter->getName() . '%\'
                                    OR l.lname LIKE \'%' . $learnersFilter->getName() . '%\'
                                )';
                }

                if(valArr($learnersFilter->getBatches())) {
                   $where .= ' AND l.batch IN ( ' . \sqlStringImplode($learnersFilter->getBatches()) . ' )';
                }

                if(valArr($learnersFilter->getGender())) {
                    $where .= ' AND l.gender IN ( ' . \sqlStringImplode($learnersFilter->getGender()) . ' )';
                }

                if(valArr($learnersFilter->getCources())) {
                    $where .= ' AND l.course_name IN ( ' . \sqlStringImplode($learnersFilter->getCources()) . ' )';
                }

                if(!$learnersFilter->getIsGetDeletedUsers()) {
                    $where .= 'AND l.is_deleted IS FALSE';
                }
            }

            $sql = 'SELECT
                        count(1) AS learners_count
                    FROM
                        learners l
                    WHERE
                        l.center_code = :center_code
                        ' . $where;

            $params = [
                ':center_code' => $centerCode
            ];

            return self::fetch($sql, $database, $params)['learners_count'];
        }

        public static function fetchLearnersByCenterCode($centerCode, $database, $learnersFilter = null) {
            if(!valId($centerCode)) return null;

            $limit = '';
            $where = '';

            if(valObj($learnersFilter, DTO\LearnersFilter::class)) {
                $limit = ' LIMIT ' . (int) $learnersFilter->getLimit() . ' OFFSET ' . (int) $learnersFilter->getOffset();

                if(valStr($learnersFilter->getName())) {
                    $where .= ' AND (
                                    l.fname LIKE \'%' . $learnersFilter->getName() . '%\'
                                    OR l.mname LIKE \'%' . $learnersFilter->getName() . '%\'
                                    OR l.lname LIKE \'%' . $learnersFilter->getName() . '%\'
                                )';
                }

                if(valArr($learnersFilter->getBatches())) {
                   $where .= ' AND l.batch IN ( ' . \sqlStringImplode($learnersFilter->getBatches()) . ' )';
                }

                if(valArr($learnersFilter->getGender())) {
                    $where .= ' AND l.gender IN ( ' . \sqlStringImplode($learnersFilter->getGender()) . ' )';
                }

                if(valArr($learnersFilter->getCources())) {
                    $where .= ' AND l.course_name IN ( ' . \sqlStringImplode($learnersFilter->getCources()) . ' )';
                }

                if(!$learnersFilter->getIsGetDeletedUsers()) {
                    $where .= 'AND l.is_deleted IS FALSE';
                }
            }

            $sql = 'SELECT
                        l.roll,
                        l.mkclid,
                        l.fname,
                        l.mname,
                        l.lname,
                        l.gender,
                        l.batch,
                        CONCAT(l.course_name, \' (\', l.learner_type, \')\') AS course,
                        COALESCE(SUM(p.amount), 0) AS fees_paid,
                        l.course_fees - l.discount - COALESCE(SUM(p.amount), 0) AS balance,
                        l.is_deleted
                    FROM
                        learners l
                        LEFT JOIN payments p ON (p.roll = l.roll)
                    WHERE
                        l.center_code = :center_code
                        ' . $where . '
                    GROUP BY
                        l.roll' . $limit;

            $params = [
                ':center_code' => $centerCode
            ];

            return self::fetchAll($sql, $database, $params);
        }

        public static function fetchLearnerByRollByCenterCode($roll, $centerCode, $database) {
            if(!\valId($roll) || !\valId($centerCode)) return null;

            $sql = 'SELECT
                            *,
                            CONCAT(l.course_name, \' (\', l.learner_type, \')\') AS course
                        FROM
                            learners l
                        WHERE
                            l.center_code = :center_code
                            AND l.roll = :roll';

            $params = [
                ':center_code' => $centerCode,
                ':roll' => $roll
            ];

            return self::fetch($sql, $database, $params);
        }
    }
?>