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
    public function findProducts($sKeyword, Model_Criteria $oCriteria = null)
    {
        $aOptions = $this->_getOption($oCriteria);
        $aOptions['keyword'] = '"' . $sKeyword . '"';
        $this->_sourceData = $this->_requestRest('GeneralSearch', $aOptions);

        $oSXML = @simplexml_import_dom($this->_sourceData);
//return $oSXML;

        $this->_data = array();
        if ($oSXML && !empty($oSXML->item)) {
            foreach ($oSXML->item as $oItem) {
                $this->_data[] = Linkshare_Model_Product::convertLinkshareItem($oItem);
            }
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
    protected function _getOption($oCriteria)
    {
        $aOptions = array();
        if (is_null($oCriteria)) {
            $oCriteria = $this->getCriteria();
        }

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