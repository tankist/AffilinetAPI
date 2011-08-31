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
        if (!$oCriteria) {
            $oCriteria = $this->getCriteria();
        }

        $iSearchType = $this->setSearchType($sKeyword);
        if (empty($iSearchType)) {
            // ToDo: MayBe make exception there
            return array();
        }

        $aCategories = $oCriteria->getCategories();
        $aOptions = $this->_getOptions($oCriteria);

        if ($iSearchType & 1) {
            $aOptions['keyword'] = '"' . $sKeyword . '"';
        }
        if ($iSearchType & 2) {
            $aOptions['Category'] = $aCategories[0];
        }
        $this->_sourceData = $this->_requestRest('GeneralSearch', $aOptions);

        return $this->_makeProducts();
    } // function findProducts

    /**
     * @param Model_Criteria $oCriteria
     * @return array
     */
    protected function _getOptions(Model_Criteria $oCriteria)
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

    /**
     * Get Config data
     * @return array
     */
    protected function _makeProducts()
    {
        $this->_data = array();

        $oSXML = @simplexml_import_dom($this->_sourceData);
        if ($oSXML && !empty($oSXML->item)) {
            foreach ($oSXML->item as $oItem) {
                $this->_data[] = Linkshare_Model_Product::convertLinkshareItem($oItem);
            }
        }
        return $this->getData();
    }
}
