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
class Linkshare_Model_Finder extends Model_Finder_Rest
{

    /**
     * Find Products By Keywords
     * @param string $sKeyword
     * @param Model_Criteria $oCriteria
     * @return array
     */
    public function findProducts($sKeyword, Model_Criteria $oCriteria)
    {
        $aOptions = $this->_getOption($oCriteria);
        $aOptions['keyword'] = '"' . $sKeyword . '"';
        $this->_sourceData = $this->_request('GeneralSearch', $aOptions);

        $oSXML = @simplexml_import_dom($this->_sourceData);
        //return $oSXML;
        if ($oSXML && !empty($oSXML->item)) {
            $data = array();
            foreach ($oSXML->item as $oItem) {
                $oNewItem = new Linkshare_Model_Product(array(
                    // ----- Main property ----- \\
                    'id' => (string)$oItem['linkid'],
                    'title' => (string)$oItem->productname,
                    'description' => (string)$oItem->description->long,
                    //'currency'      => '',
                    'price' => (string)$oItem->price,
                    //'shippingPrice' => '',
                    'url' => (string)$oItem->linkurl,
                    // ----- Extra property ----- \\
                    'mid' => (string)$oItem->mid,
                    'merchantname' => (string)$oItem->merchantname,
                    'createdon' => (string)$oItem->createdon,
                    'shortDescription' => (string)$oItem->description->short,
                   'sku' => (string)$oItem->sku,
                ));

                if (!empty($oItem->imageurl)) {
                    $oNewItem->addImage((string)$oItem->imageurl);
                }

                $data[] = $oNewItem;
            }
            $this->_data = $data;
        }
        return $this->getData();
    } // function findProductsByKeywords

    /**
     * Find Products By Category
     * @param integer $iCategoryId
     * @param array  $aOptions
     * @return array
     */
    public function findProductsByCategory($iCategoryId, $nPage = 1, $aOptions = null)
    {
        $this->_getOption($aOptions);
        $aOptions['categoryId'] = $iCategoryId;
        $this->_sourceData = $this->_findItems('GeneralSearch', $nPage, $aOptions);

        $oSXML = @simplexml_import_dom($this->_sourceData);
        return $oSXML;
    } // function findProductsByKeywords

    /**
     * @param Model_Criteria $oCriteria
     * @return array
     */
    protected function _getOption(Model_Criteria $oCriteria)
    {
        $aOptions = array();

        $nItemsPerPage = $oCriteria->getItemsPerPage();
        if ($nItemsPerPage) {
            $aOptions['MaxResults'] = $nItemsPerPage;
        }
        $nPage = $oCriteria->getPage();
        if ($nPage) {
            $aOptions['pagenumber'] = $nPage;
        }

        $aOptions['token'] = $this->_options['token'];

        return $aOptions;
    } // function _getOption
}