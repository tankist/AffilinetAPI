<?php

abstract class ZendX_Service_Affilinet_Criteria_Abstract implements  ZendX_Service_Affilinet_Criteria_Interface
{

    const SORT_TYPE_UNSORTED = 'Unsorted';
    const SORT_TYPE_ASCENDING = 'Ascending';
    const SORT_TYPE_DESCENDING = 'Descending';
    const SORT_TYPE_RANDOM = 'Random';

    const DEFAULT_ITEMS_PER_PAGE = 10;

    /**
     * @var string
     */
    protected $_query = '';

    /**
     * @var string
     */
    protected $_sortBy = '';

    /**
     * @var string
     */
    protected $_sortOrder = self::SORT_TYPE_UNSORTED;

    /**
     * @var int
     */
    protected $_currentPage = 1;

    /**
     * @var int
     */
    protected $_pageSize = self::DEFAULT_ITEMS_PER_PAGE;

    /**
     * @param int $currentPage
     * @return ZendX_Service_Affilinet_Criteria_Abstract
     */
    public function setCurrentPage($currentPage)
    {
        $this->_currentPage = $currentPage;
        return $this;
    }

    /**
     * @return int
     */
    public function getCurrentPage()
    {
        return $this->_currentPage;
    }

    /**
     * @param int $pageSize
     * @return ZendX_Service_Affilinet_Criteria_Abstract
     */
    public function setPageSize($pageSize)
    {
        $this->_pageSize = $pageSize;
        return $this;
    }

    /**
     * @return int
     */
    public function getPageSize()
    {
        return $this->_pageSize;
    }

    /**
     * @param string $query
     * @return ZendX_Service_Affilinet_Criteria_Abstract
     */
    public function setQuery($query)
    {
        $this->_query = $query;
        return $this;
    }

    /**
     * @return string
     */
    public function getQuery()
    {
        return $this->_query;
    }

    /**
     * @param string $sortBy
     * @return ZendX_Service_Affilinet_Criteria_Abstract
     */
    public function setSortBy($sortBy)
    {
        $this->_sortBy = $sortBy;
        return $this;
    }

    /**
     * @return string
     */
    public function getSortBy()
    {
        return $this->_sortBy;
    }

    /**
     * @param string $sortOrder
     * @return ZendX_Service_Affilinet_Criteria_Abstract
     */
    public function setSortOrder($sortOrder)
    {
        $this->_sortOrder = $sortOrder;
        return $this;
    }

    /**
     * @return string
     */
    public function getSortOrder()
    {
        return $this->_sortOrder;
    }

    public function toArray()
    {
        if (!($query = $this->getQuery())) {
            throw new ZendX_Service_Affilinet_Criteria_Exception('Query is required to process criteria');
        }
        $params = array(
            'Query' => $query
        );
        $params['SortOrder'] = ($this->getSortOrder())?$this->getSortOrder():self::SORT_TYPE_UNSORTED;
        if ($sort = $this->getSortBy()) {
            $params['SortBy'] = $sort;
        }
        $params['CurrentPage'] = ($page = $this->getCurrentPage())?$page:1;
        $params['PageSize'] = ($this->getPageSize())?$this->getPageSize():self::DEFAULT_ITEMS_PER_PAGE;
        return $params;
    }

    public function toString()
    {
        throw new ZendX_Service_Affilinet_Criteria_Exception('This method is not allowed to run in this API');
    }
    
}