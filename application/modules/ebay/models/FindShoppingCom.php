<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of findShoppingCom
 *
 * @author Alex
 */
class Ebay_Model_FindShoppingCom extends Model_FindShopProduct
{
    /**
     * find Shopping.Com constructor
     */
    function __construct() {
        parent::__construct('shoppingCom');
    } // function __construct

    /**
     * Find Products By Keywords
     * @param string $sKeyword
     * @param array  $aOptions
     * @return array
     */
    public function findProductsByKeywords($sKeyword, $nPage = 1, $aOptions = null)
    {
        $this->_modifyOption($aOptions);
        $aOptions['keyword'] = $sKeyword;
        $this->_sourseResult = $this->_findItems('GeneralSearch', $nPage, $aOptions);

        $aRet = array();
        $oSXML = @simplexml_import_dom($this->_sourseResult)->categories->category->items;
        if ($oSXML && !empty($oSXML->product)) {
            foreach ($oSXML->product as $oItem) {
                $oNewItem = new shopProduct();

                $oNewItem->setMainProrepty(array(
                    'originalId'     => (string)$oItem['id'],
                    'title'          => (string)$oItem->name,
                    //'subtitle'       => '',
                    'description'    => (string)$oItem->fullDescription,
                    //'currency'       => '',
                    'price'          => (string)$oItem->minPrice,
                    //'shipping_price' => '',
                    'originalURL'    => (string)$oItem->productOffersURL,
                    'pictureURL'     => isset($oItem->images->image[0]->sourceURL) ? (string)$oItem->images->image[0]->sourceURL : null,
                    //'country'        => '',
                    //'expireTime'     => '',
                ));
                $oNewItem->setExtraProrepty(array(
                    'maxPrice'         => (string)$oItem->maxPrice,
                    'categoryId'       => (string)$oItem->categoryId,
                    'shortDescription' => (string)$oItem->shortDescription,
                    'reviewCount'      => (string)$oItem->rating->reviewCount,
                ));
                $this->_adjustedData[] = $oNewItem;
            }
        }
        return $this->_adjustedData;
    } // function findProductsByKeywords

    /**
     * @param  array  $aOptions
     * @param  string $sOperation
     * @return Zend_Service_Ebay_Finding_Response_Items
     */
    protected function _findItems($sOperation, $nPage, array $aOptions)
    {
        if (!isset($aOptions['numItems'])) {
            $aOptions['numItems'] = $this->_options->item_qtt;
        }
        if (!isset($aOptions['pageNumber'])) {
            $aOptions['pageNumber'] = $nPage;
        }

        // do request
        $oDom = $this->_request($sOperation, $aOptions);
        return $oDom;
    }

    /**
     * @param  array  $aOptions
     * @param  string $sOperation
     * @return DOMDocument
     */
    protected function _request($sOperation, array $aOptions)
    {
        // do request
        $oClient = $this->getClient();
        $oClient->getHttpClient()->resetParameters();
        $response = $oClient->setUri($this->_options->URL)
                            ->restGet($this->_options->path->$sOperation, $aOptions);

        return $this->_parseResponse($response);
    }

    /**
     * Search for error from request.
     *
     * If any error is found a DOMDocument is returned, this object contains a
     * DOMXPath object as "ebayFindingXPath" attribute.
     *
     * @param  Zend_Http_Response $response
     * @return DOMDocument
     */
    protected function _parseResponse(Zend_Http_Response $response)
    {
        // error message
        $message = '';

        // first trying, loading XML
        $oDom = new DOMDocument();
        if (!@$oDom->loadXML($response->getBody())) {
            $message = 'It was not possible to load XML returned.';
        }

        // second trying, check request status
        if ($response->isError()) {
            $message = $response->getMessage()
                     . ' (HTTP status code #' . $response->getStatus() . ')';
        }

        // throw exception when an error was detected
        if (strlen($message) > 0) {
            // ToDo: throw Exception there
        }

        return $oDom;
    }

    /**
     * @param mixed $mOptions
     */
    protected function _modifyOption(&$mOptions)
    {
        if (!is_array($mOptions)) {
            $mOptions = is_null($mOptions) ? array() : array($mOptions);
        }

        $mOptions['apiKey']     = $this->_options->apiKey;
        $mOptions['trackingId'] = $this->_options->trackingId;

        return $mOptions;
    } // function _modifyOption
} // class findShoppingCom
?>