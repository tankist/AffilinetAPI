<?php

class Affilinet_Model_Product extends Model_ShopProduct
{
    public function __construct(ZendX_Service_Affilinet_Item_Product $affilinetProduct)
    {
        $params = array();
        $params['originalId'] = $affilinetProduct->getId();
        $params['title'] = $affilinetProduct->getTitle();
        $params['description'] = ($description = $affilinetProduct->getDescription())?$description:$affilinetProduct->getDescriptionShort();
        $params['currency'] = $affilinetProduct->getCurrencySymbol();
        $params['price'] = $affilinetProduct->getPrice();
        $params['shipping_price'] = $affilinetProduct->getShipping();
        $params['originalURL'] = $affilinetProduct->getDeepLink1(); 

        $imagesCodes = array('Image', 'Image180', 'Image120', 'Image90', 'Image60', 'Image30');
        $image = '';
        do {
            $imageCode = array_shift($imagesCodes);
            $getter = 'get' . $imageCode;
            if (method_exists($affilinetProduct, $getter)) {
                /**
                 * @var ZendX_Service_Affilinet_Item_Image $imageObject
                 */
                $imageObject = call_user_func(array($affilinetProduct, $getter));
                if ($imageObject instanceof ZendX_Service_Affilinet_Item_Image) {
                    $image = $imageObject->getImageURL();
                }
            }
        } while (empty($image));
        $params['pictureURL'] = $image;

        $this->setMainProrepty($params);
    }

}