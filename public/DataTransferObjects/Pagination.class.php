<?php
    namespace DTO;

    class Pagination {
        private $m_limit;
        private $m_pageNumber;
        private $m_orderBy;
        private $m_order;

        public function setLimit($limit) {
            $this->m_limit = $limit;
        }

        public function getLimit() {
            if(!valId($this->m_limit)) {
                return 10;
            }
            return $this->m_limit;
        }

        public function setPageNumber($pageNumber) {
            $this->m_pageNumber = $pageNumber;
        }

        public function getPageNumber() {
            if(!valId($this->m_pageNumber)) {
                return 1;
            }
            return $this->m_pageNumber;
        }

        public function getOffset() {
            return ($this->getPageNumber() - 1) * $this->getLimit();
        }

        public function setOrderBy($orderBy) {
            $this->m_orderBy = $orderBy;
        }

        public function getOrderBy() {
            return $this->m_orderBy;
        }

        public function setOrder($order) {
            $this->m_order = $order;
        }

        public function getOrder() {
            if(!valStr($this->m_order)) {
                return 'asc';
            }
            return $this->m_order;
        }

        public function setValues($values) {
            if(isset($values['limit'])) $this->setLimit($values['limit']);
            if(isset($values['page_number'])) $this->setPageNumber($values['page_number']);
            if(isset($values['order_by'])) $this->setOrderBy($values['order_by']);
            if(isset($values['order'])) $this->setOrder($values['order']);
        }
    }
?>