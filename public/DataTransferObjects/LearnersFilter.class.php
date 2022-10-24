<?php
    namespace DTO;
    require_once PATH_DTO . '/Pagination.class.php';

    class LearnersFilter extends Pagination {
        private $m_name;
        private $m_batches;
        private $m_gender;
        private $m_cources;
        private $m_isGetDeletedUsers = false;

        public function setName($name) {
            $this->m_name = $name;
        }

        public function getName() {
            return $this->m_name;
        }

        public function setBatches($batches) {
            $this->m_batches = $batches;
        }

        public function getBatches() {
            return $this->m_batches;
        }

        public function setGender($gender) {
            $this->m_gender = $gender;
        }

        public function getGender() {
            return $this->m_gender;
        }

        public function setCources($cources) {
            $this->m_cources = $cources;
        }

        public function getCources() {
            return $this->m_cources;
        }

        public function setIsGetDeletedUsers($isGetDeletedUsers) {
            $this->m_isGetDeletedUsers = $isGetDeletedUsers;
        }

        public function getIsGetDeletedUsers() {
            return $this->m_isGetDeletedUsers;
        }

        public function setValues($values) {
            parent::setValues($values);

            if(isset($values['name'])) $this->setName($values['name']);
            if(isset($values['batches'])) $this->setBatches($values['batches']);
            if(isset($values['gender'])) $this->setGender($values['gender']);
            if(isset($values['cources'])) $this->setCources($values['cources']);
            if(isset($values['get_deleted_users'])) $this->setIsGetDeletedUsers(toBool($values['get_deleted_users']));
        }
    }
?>