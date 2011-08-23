<?php

abstract class ZendX_Service_Affilinet_Collection_Abstract extends ArrayObject
{

    /**
     * @var string
     */
    protected $_itemClass = '';

    public function __construct($items = array(), $flags=0, $iterator_class="ArrayIterator")
    {
        if (!is_array($items) && !($items instanceof ArrayAccess)) {
            throw new ZendX_Service_Affilinet_Collection_Exception('Items must be array or implements ArrayAccess object');
        }
        if (!$this->getItemClass()) {
            throw new ZendX_Service_Affilinet_Collection_Exception('You must provide some item class of the collection');
        }
        if (!class_exists($this->getItemClass(), true)) {
            throw new ZendX_Service_Affilinet_Collection_Exception('Item type ' . $this->getItemClass() . ' not found');
        }
        $itemReflector = new ReflectionClass($this->getItemClass());
        $newItems = array();
        foreach ($items as $item) {
            if ($item instanceof stdClass) {
                $item = (array)$item;
            }
            if (is_array($item)) {
                $item = $itemReflector->newInstance($item);
            }
            if (!$itemReflector->isInstance($item)) {
                throw new ZendX_Service_Affilinet_Collection_Exception('Wriong item provided to collection');
            }
            $newItems[] = $item;
        }
        parent::__construct($newItems, $flags, $iterator_class);
    }

    /**
     * @param string $itemClass
     * @return self
     */
    public function setItemClass($itemClass)
    {
        $this->_itemClass = $itemClass;
        return $this;
    }

    /**
     * @return string
     */
    public function getItemClass()
    {
        return $this->_itemClass;
    }

}