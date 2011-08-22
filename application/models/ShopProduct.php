<?php
/*
 * Shop Product class.
 *
 * For set main property use:
 *     $prod->set_title($title)
 *  OR $prod->setMainProrepty(array('title' =>$title));
 *
 * For set extra property use only:
 *     $prod->setExtraProrepty(array('some_ptop' =>$some_val));
 *
 * For get any property use:
 *     $prod->propertyName;
 * If you want to define default value for main property use:
 *     $prod->get_propertyName($mDefaultValue);
 *
 */
class Model_ShopProduct
{

    /**
     * Main property
     * @var array()
     */
    protected $_main_property = array(
        'originalId'     => null,
        'title'          => null,
        'subtitle'       => null,
        'description'    => null,
        'currency'       => null,
        'price'          => null,
        'shipping_price' => null,
        'originalURL'    => null,
        'pictureURL'     => null,
        'country'        => null,
        'expireTime'     => null,
    );

    /**
     * Extra property
     * @var array()
     */
    protected $_extra_property = array();

    /**
     * Class constructor
     */
    function __construct()
    {
    } // function __construct

    /**
     * Get main/extra property
     * @param string $sProp
     * @return mixed
     */
    function __get($sProp)
    {
        if (array_key_exists($sProp, $this->_main_property)) {
            return $this->_main_property[$sProp];
        } elseif (isset($_extra_property[$sProp])) {
            return $this->_extra_property[$sProp];
        }
        // ToDo: Maybe need to throw exception there
        return null;
    } // function __get

    /**
     * Overload set/get-methods of main/extra property
     * @param string $sMethod
     * @param array $aArguments
     * @return mixed
     */
    function __call($sMethod, $aArguments) {
        $sKey  = substr($sMethod, 4);
        $sOper = substr($sMethod, 0, 4);
        if ($sOper == 'set_' && array_key_exists($sKey, $this->_main_property)) {
            $this->_main_property[$sKey] = $aArguments[0];
        } elseif ($sOper == 'get_' && array_key_exists($sKey, $this->_main_property)) {
            return isset($this->_main_property[$sKey]) ?
                    $this->_main_property[$sKey] :
                    (isset($aArguments[0]) ? $aArguments[0] : null);
        }
        return null;
    }

    /**
     */
    function set_currency($sValue) {
        $sValue = strtoupper($sValue);
        if (in_array($sValue, array('USD', 'EUR', 'GBP', 'RUB', 'JPY', 'TWD'))) {
            $this->_main_property['currency'] = $sValue;
        } else {
            // ToDo: Log data for analysis
        }
    } // function set_currency

    /**
     * Set Main Prorepty
     * @param array $aData
     */
    function setMainProrepty($aData) {
        $this->_main_property = array_merge($this->_main_property,
                array_intersect_key($aData, $this->_main_property));
    } // function setMainProrepty

    /**
     * Set Extra Prorepty
     * @param array $aData
     */
    function setExtraProrepty($aData) {
        $this->_extra_property = array_merge($this->_extra_property, $aData);
    } // function setExtraProrepty

    /**
     * Get Main Prorepty
     * @return array
     */
    function getMainProrepty() {
        return $this->_main_property;
    } // function setMainProrepty

    /**
     * Get Extra Prorepty
     * @return array
     */
    function getExtraProrepty() {
        return $this->_extra_property;
    } // function getExtraProrepty


} // class shopProduct
?>