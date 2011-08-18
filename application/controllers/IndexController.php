<?php

class IndexController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        $affilinet = new ZendX_Service_Affilinet_Products(true, array(
                'sandboxPublisherId' => 236725,
                'username' => 'Users.1.2621',
                'password' => 'v39Gryshko'
            ));
        $shops = $affilinet->getShops();
        /**
         * @var ZendX_Service_Affilinet_Item_Shop $shop
         */
        $shop = $shops[0];
        $categories = $affilinet->getCategories($shop->getShopId());
        var_dump($categories);
    }


}

