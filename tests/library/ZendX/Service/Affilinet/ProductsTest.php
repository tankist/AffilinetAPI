<?php

require_once 'Z:\home\affilinet.lan\library\ZendX\Service\Affilinet\Products.php';

/**
 * Test class for ZendX_Service_Affilinet_Products.
 * Generated by PHPUnit on 2011-08-18 at 19:55:03.
 */
class ZendX_Service_Affilinet_ProductsTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var ZendX_Service_Affilinet_Products
     */
    protected $object;

    protected $username = 'Users.1.2621';

    protected $password = 'v39Gryshko';

    protected $publisher = 236725;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        $this->object = new ZendX_Service_Affilinet_Products(true, array(
                'sandboxPublisherId' => $this->publisher,
                'username' => $this->username,
                'password' => $this->password
            ));
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown()
    {
    }

    /**
     * @todo Implement testGetShops().
     */
    public function testGetShops()
    {
        $shops = $this->object->getShops();
        $this->assertInstanceOf('ZendX_Service_Affilinet_Collection_Shops', $shops);
        $this->assertGreaterThan(0, count($shops));
    }

    /**
     * @todo Implement testGetCategories().
     */
    public function testGetCategories()
    {
        $categories = $this->object->getCategories(492);
        $this->assertInstanceOf('ZendX_Service_Affilinet_Collection_Categories', $categories);
        $this->assertGreaterThan(0, count($categories));
    }
}
?>