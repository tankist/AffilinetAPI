<?php

class ZendX_Service_Affilinet_Item_Account extends ZendX_Service_Affilinet_Item_Abstract
{

    /**
     * @var int
     */
    protected $_accountBalance = 0;

    /**
     * @var
     */
    protected $_currency;

    /**
     * @var string
     */
    protected $_mainUrl = '';

    /**
     * @var int
     */
    protected $_publisherId;

    /**
     * @param int $accountBalance
     * @return ZendX_Service_Affilinet_Item_Account
     */
    public function setAccountBalance($accountBalance)
    {
        $this->_accountBalance = $accountBalance;
        return $this;
    }

    /**
     * @return int
     */
    public function getAccountBalance()
    {
        return $this->_accountBalance;
    }

    /**
     * @param  $currency
     * @return ZendX_Service_Affilinet_Item_Account
     */
    public function setCurrency($currency)
    {
        $this->_currency = $currency;
        return $this;
    }

    /**
     * @return
     */
    public function getCurrency()
    {
        return $this->_currency;
    }

    /**
     * @param string $mainUrl
     * @return ZendX_Service_Affilinet_Item_Account
     */
    public function setMainUrl($mainUrl)
    {
        $this->_mainUrl = $mainUrl;
        return $this;
    }

    /**
     * @return string
     */
    public function getMainUrl()
    {
        return $this->_mainUrl;
    }

    /**
     * @param int $publisherId
     * @return ZendX_Service_Affilinet_Item_Account
     */
    public function setPublisherId($publisherId)
    {
        $this->_publisherId = $publisherId;
        return $this;
    }

    /**
     * @return int
     */
    public function getPublisherId()
    {
        return $this->_publisherId;
    }
}