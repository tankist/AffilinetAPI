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
class Shoppingcom_Model_Finder extends Model_Finder_Rest
{

    /**
     * Find Products
     * @param string $sKeyword
     * @param Model_Criteria $oCriteria
     * @return array
     */
    public function findProducts($sKeyword, Model_Criteria $oCriteria = null)
    {
        if (!$oCriteria) {
            $oCriteria = $this->getCriteria();
        }
        $aOptions = $this->_getOptions($oCriteria);
        $aOptions['keyword'] = $sKeyword;
        $this->_sourceData = $this->_requestRest('GeneralSearch', $aOptions);

        return $this->_makeProducts();
    } // function findProductsByKeywords

    /**
     * Find Products By Category
     * @param $iCategoryId
     * @param Model_Criteria $oCriteria
     * @return array
     */
    public function findProductsByCategory($iCategoryId, Model_Criteria $oCriteria)
    {
        $aOptions = $this->_getOptions($oCriteria);
        $aOptions['categoryId'] = $iCategoryId;
        $this->_sourceData    = $this->_requestRest('GeneralSearch', $aOptions);

        return $this->_makeProducts();
    } // function findProductsByCategory

    /**
     * @param Model_Criteria $oCriteria
     * @return array
     */
    protected function _getOptions(Model_Criteria $oCriteria)
    {
        $aOptions = array();

        $nItemsPerPage = $oCriteria->getItemsPerPage();
        if ($nItemsPerPage) {
            $aOptions['numItems'] = $nItemsPerPage;
        }
        $nPage = $oCriteria->getPage();
        if ($nPage) {
            $aOptions['pageNumber'] = $nPage;
        }

        $aOptions['apiKey']     = $this->_options['apiKey'];
        $aOptions['trackingId'] = $this->_options['trackingId'];

        return $aOptions;
    } // function _getOption

    /**
     * Get Config data
     * @return array
     */
    protected function _makeProducts()
    {
        $this->_data = array();

        $oSXML = @simplexml_import_dom($this->_sourceData);
        foreach (array('categories', 'category', 'items') as $prop) {
            if (empty($oSXML->$prop)) {
                break;
                // ToDo: throw exception there
            } else {
                $oSXML = $oSXML->$prop;
            }
        }


        if ($oSXML && !empty($oSXML->product)) {
            foreach ($oSXML->product as $oItem) {
                $this->_data[] = Shoppingcom_Model_Product::convertShoppingcomItem($oItem);
            }
        }
        return $this->getData();
    }
}
