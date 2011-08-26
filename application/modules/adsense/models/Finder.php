<?php
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of findAdSense
 *
 * @author Alex
 */
class AdSense_Model_Finder extends Model_Finder_Soap
{

    /**
     * Find Products By Keywords
     * @param string $sKeyword
     * @param Model_Criteria|null $criteria
     * @return array
     */
    public function findProducts($sKeyword, Model_Criteria $criteria = null)
    {
        if (!$criteria) {
            $criteria = $this->getCriteria();
        }
        $aOptions = $this->_getOptions($criteria);
        $aOptions['keyword'] = $sKeyword;
        $this->_sourceData = $this->_request('GeneralSearch', $aOptions);

        $aRet = array();
        $oSXML = @simplexml_import_dom($this->_sourceData)->categories->category->items;
        if ($oSXML && !empty($oSXML->product)) {
            foreach ($oSXML->product as $oItem) {
                $oNewItem = new Adsense_Model_Product(array(
                    'id'     => (string)$oItem['id'],
                    'title'          => (string)$oItem->name,
                    //'subtitle'       => '',
                    'description'    => (string)$oItem->fullDescription,
                    //'currency'       => '',
                    'price'          => (string)$oItem->minPrice,
                    //'shipping_price' => '',
                    'url'    => (string)$oItem->productOffersURL,
                    'images'     => isset($oItem->images->image[0]->sourceURL) ? (string)$oItem->images->image[0]->sourceURL : null,
                    //'country'        => '',
                    //'expireTime'     => '',
                    'maxPrice'         => (string)$oItem->maxPrice,
                    'categoryId'       => (string)$oItem->categoryId,
                    'shortDescription' => (string)$oItem->shortDescription,
                    'reviewCount'      => (string)$oItem->rating->reviewCount,
                ));

                $aRet[] = $oNewItem;
            }
            $this->_data = $aRet;
        }
        return $this->_data;
    } // function findProducts

    /**
     * @param string $sOperation
     * @param int $nPage
     * @param array $aOptions
     * @return DOMDocument
     */
    protected function _findItems($sOperation, $nPage, array $aOptions)
    {
        if (!isset($aOptions['numItems'])) {
            $aOptions['numItems'] = $this->_options['item_qtt'];
        }
        if (!isset($aOptions['pageNumber'])) {
            $aOptions['pageNumber'] = $nPage;
        }

        // do request
        $oDom = $this->_request($sOperation, $aOptions);
        return $oDom;
    }

    /**
     * @param Model_Criteria $modelCriteria
     * @return array
     */
    protected function _getOptions($oCriteria)
    {
        $aOptions = array();
        if (is_null($oCriteria)) {
            $oCriteria = $this->getCriteria();
        }
        // @todo Add modify options code here
        return $aOptions;
    }

}