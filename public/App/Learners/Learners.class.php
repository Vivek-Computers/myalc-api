<?php
require_once PATH_APP . '/Base.class.php';

final class Learners extends Base {
    
    public function getLearners($params = []) {
        if(!$this->isAuthorised()) {
            return $this->getUnAuthorisedResponse();
        }

        require_once PATH_QURIES . '/Learners.class.php';
        require_once PATH_DTO . '/LearnersFilter.class.php';

        $centerInfo = $this->getDecodedToken();

        $learnersFilter = new DTO\LearnersFilter();
        $learnersFilter->setValues($params);

        $learnerCount = Database\Queries\Learners::fetchLearnersCountByCenterCode($centerInfo['center_code'], $this->m_database, $learnersFilter);
        $learners = (array) Database\Queries\Learners::fetchLearnersByCenterCode($centerInfo['center_code'], $this->m_database, $learnersFilter);

        $payload = [
            'success' => true,
            'data' => ['learners_count' => $learnerCount,'learners' => $learners]
        ];

        return [200, json_encode($payload, JSON_PRETTY_PRINT)];
    }

    public function getLearner($rollNumber) {
        if(!$this->isAuthorised()) {
            return $this->getUnAuthorisedResponse();
        }

        require_once PATH_QURIES . '/Learners.class.php';

        $centerInfo = $this->getDecodedToken();
        $learner = Database\Queries\Learners::fetchLearnerByRollByCenterCode($rollNumber, $centerInfo['center_code'], $this->m_database);

        if(!valArr($learner)) {
            global $g_messages;
            $payload = [
                'success' => false,
                'message_code' => 'E0003',
                'message' => $g_messages['E0003'] ?? '',
                'data' => ['learner' => $learner]
            ];
    
            return [200, json_encode($payload, JSON_PRETTY_PRINT)];
        }

        $payload = [
            'success' => true,
            'data' => ['learner' => $learner]
        ];

        return [200, json_encode($payload, JSON_PRETTY_PRINT)];
    }

    public function getLearnerImage($rollNumber) {
        if(!$this->isAuthorised()) {
            return $this->getUnAuthorisedResponse();
        }

        require_once PATH_QURIES . '/Files.class.php';

        $centerInfo = $this->getDecodedToken();
        $learnerPhoto = Database\Queries\Files::fetchLearnerPhotoByRollNumberByCenterCode($rollNumber, $centerInfo['center_code'], $this->m_database);

        if(!valArr($learnerPhoto)) {
            global $g_messages;
            $payload = [
                'success' => false,
                'message_code' => 'E0003',
                'message' => $g_messages['E0003'] ?? '',
                'data' => ['photo' => '']
            ];
    
            return [200, json_encode($payload, JSON_PRETTY_PRINT)];
        }

        require_once PATH_HELPERS . '/ImageHelper.class.php';
        $learnerPhoto['content'] = Helpers\ImageHelper::getBase64FromBlob($learnerPhoto['content'] ?? '');

        $payload = [
            'success' => true,
            'data' => ['photo' => $learnerPhoto]
        ];

        return [200, json_encode($payload, JSON_PRETTY_PRINT)];
    }

    public function addLearner($data) {
        if(!$this->isAuthorised()) {
            return $this->getUnAuthorisedResponse();
        }

        display($data);
    }
}
?>