<?php

class ZendX_Service_Affilinet_Paginator_Adapter_Products implements Zend_Paginator_Adapter_Interface
{

    /**
     * @var ZendX_Service_Affilinet_Criteria_Product
     */
    protected $_criteria = null;

    /**
     * @var ZendX_Service_Affilinet_Products
     */
    protected $_service = null;

    function __construct($service = null, $criteria = null)
    {
        if (!($criteria instanceof ZendX_Service_Affilinet_Criteria_Product)) {
            throw new Zend_Paginator_Exception('Wrong criteria is provided');
        }
        if (!($service instanceof ZendX_Service_Affilinet_Products)) {
            throw new Zend_Paginator_Exception('Wrong service is provided');
        }
        $this
            ->setCriteria($criteria)
            ->setService($service);
    }

    /**
     * Returns an collection of items for a page.
     *
     * @param  integer $offset Page offset
     * @param  integer $itemCountPerPage Number of items per page
     * @return array
     */
    public function getItems($offset, $itemCountPerPage)
    {
        if (!($criteria = $this->getCriteria())) {
            throw new Zend_Paginator_Exception('Criteria not found');
        }
        if (!($service = $this->getService())) {
            throw new Zend_Paginator_Exception('Service not found');
        }

        $page = ceil($offset + 1 / $itemCountPerPage);
        $criteria->setCurrentPage($page)->setPageSize($itemCountPerPage);

        $products = $service->searchProducts($criteria);
        return $products;
    }

    /**
     * @throws Zend_Paginator_Exception
     * @return int
     */
    public function count()
    {
        if (!($criteria = $this->getCriteria())) {
            throw new Zend_Paginator_Exception('Criteria not found');
        }
        if (!($service = $this->getService())) {
            throw new Zend_Paginator_Exception('Service not found');
        }

        return $service->searchProductsCount($criteria);
    }

    /**
     * @param ZendX_Service_Affilinet_Criteria_Product $criteria
     * @return ZendX_Service_Affilinet_Paginator_Adapter_Products
     */
    public function setCriteria(ZendX_Service_Affilinet_Criteria_Product $criteria)
    {
        $this->_criteria = $criteria;
        return $this;
    }

    /**
     * @return ZendX_Service_Affilinet_Criteria_Product
     */
    public function getCriteria()
    {
        return $this->_criteria;
    }

    /**
     * @param ZendX_Service_Affilinet_Products $service
     * @return ZendX_Service_Affilinet_Paginator_Adapter_Products
     */
    public function setService(ZendX_Service_Affilinet_Products $service)
    {
        $this->_service = $service;
        return $this;
    }

    /**
     * @return ZendX_Service_Affilinet_Products
     */
    public function getService()
    {
        return $this->_service;
    }

}