<?php

/**
 * Finding in eBay
 *
 * @author Alexandr Nosov
 */
require_once 'Zend/Service/Ebay/Finding.php';

class Ebay_Model_TestEbay extends Zend_Service_Ebay_Finding
{
    /**
     * Our App ID
     */
    const DEV_ID = 'b61cd14d-de14-48e9-8f29-5f6ac62e0518';
    /**
     * Our App ID
     */
    const APP_ID = 'RunaShop-9e86-4e42-b2ab-c3b4c00c445c';
    /**
     * Our App ID
     */
    const Cert_ID = 'f99f503b-be3f-4736-bd9c-b3795e86d4e3';

    /**
     * Имя таблицы
     * @var string
     */
    protected $_name = 'goods';

    /**
     * TestEbay construct
     */
    public function __construct()
    {
        $aOptions = array(
            Zend_Service_Ebay_Abstract::OPTION_APP_ID    => self::APP_ID,
            //Zend_Service_Ebay_Abstract::OPTION_GLOBAL_ID => 'EBAY-GB',
            //Zend_Service_Ebay_Abstract::OPTION_GLOBAL_ID => 'EBAY-US',
        );
        parent::__construct($aOptions);
    }

    /**
     * Получить одну страницу
     *
     * @param int $pageId Идентификатор страницы
     * @return array
     */
    public function getList($nPage)
    {
        switch ($nPage) {
        case 1:
            $oResult = $this->findItemsByKeywords('phone');
            break;
        case 2:
            $oResult = $this->findItemsAdvanced('phone');
            break;
        case 3:
            $oResult = $this->findItemsByProduct(99978429);
//return '<pre>' . print_r($oResult, true) . '</pre>';
            break;
        case 4:
            $oResult = $this->findItemsByCategory(6001);
            break;
        case 5:
            $oResult = $this->findItemsInEbayStores('phone');
            break;
        default:
            return null;
        }

        $aRet = array();
        if (!empty($oResult->searchResult)) {
            foreach ($oResult->searchResult->item as $item) {
//return '<pre>' . print_r($item, true) . '</pre>';
                $k = count($aRet);
                $aRet[$k]['globalId']      = $item->globalId;
                $aRet[$k]['itemId']        = $item->itemId;
                $aRet[$k]['productId']     = $item->productId;
                $aRet[$k]['country']       = $item->country;
                $aRet[$k]['title']         = $item->title;
                $aRet[$k]['subtitle']      = $item->subtitle;
                $aRet[$k]['viewItemURL']   = $item->viewItemURL;
                $aRet[$k]['buyItNowPrice'] = $item->listingInfo->buyItNowPrice;
                $aRet[$k]['startTime']     = $item->listingInfo->startTime;
                $aRet[$k]['endTime']       = $item->listingInfo->endTime;
                $aRet[$k]['location']      = $item->location;

                /*
                // inner call, find for items of same current product
                // like $finding->findItemsByProduct($item->productId, $item->attributes('productId', 'type'))
                $response2 = $item->findItemsByProduct($finding);

                // inner call, find for items of same store
                // like $finding->findItemsInEbayStores($item->storeInfo->storeName)
                $response3 = $item->storeInfo->findItems($finding);
                 */
            }
            return '<pre>' . print_r($aRet, true) . '</pre>';
        }

        $sRet  = '<div>' . htmlentities($oResult->getDom()->ownerDocument->saveHTML()) . '</div>';
        $sRet .= '<pre>' . print_r($oResult, true) . '</pre>';
        return $sRet;
    }
}