<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of findLinkshare
 *
 * @author Alex
 */
class Linkshare_Model_Find extends Model_FindShopProduct
{
    /**
     * find Shopping.Com constructor
     */
    function __construct($options = array())
    {
        parent::__construct($options);
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
        $oSXML = @simplexml_import_dom($this->_sourseResult);
//return $oSXML;
        if ($oSXML && !empty($oSXML->item)) {
            foreach ($oSXML->item as $oItem) {
                $oNewItem = new Model_ShopProduct();

                $oNewItem->setMainProrepty(array(
                    'originalId'     => (string)$oItem['linkid'],
                    'title'          => (string)$oItem->productname,
                    //'subtitle'       => '',
                    'description'    => (string)$oItem->description->long,
                    //'currency'       => '',
                    'price'          => (string)$oItem->price,
                    //'shipping_price' => '',
                    'originalURL'    => (string)$oItem->linkurl,
                    'pictureURL'     => isset($oItem->imageurl) ? (string)$oItem->imageurl : null,
                    //'country'        => '',
                    //'expireTime'     => '',
                ));
                $oNewItem->setExtraProrepty(array(
                    'mid'              => (string)$oItem->mid,
                    'merchantname'     => (string)$oItem->merchantname,
                    'createdon'        => (string)$oItem->createdon,
                    'shortDescription' => (string)$oItem->description->short,
                    'sku'              => (string)$oItem->sku,
                ));

                $this->_adjustedData[] = $oNewItem;
            }
        }
        return $this->_adjustedData;
    } // function findProductsByKeywords

    /**
     * @param  array  $aOptions
     * @param  string $sOperation
     * @return DOMNode
     */
    protected function _findItems($sOperation, $nPage, array $aOptions)
    {
        if (!isset($aOptions['MaxResults'])) {
            $aOptions['MaxResults'] = $this->_options['item_qtt'];
        }
        if (!isset($aOptions['pagenumber'])) {
            $aOptions['pagenumber'] = $nPage;
        }

        // do request
        $oDom = $this->_request($sOperation, $aOptions);
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

        $mOptions['token'] = $this->_options['token'];

        return $mOptions;
    } // function _modifyOption
} // class Linkshare_Model_Find
?>