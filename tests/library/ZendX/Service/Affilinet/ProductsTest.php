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

    protected $publisher = 403233;

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

    public function testInitOptions()
    {
        $this->assertEquals($this->username, $this->object->getUsername());
        $this->assertEquals($this->password, $this->object->getPassword());
        $this->assertEquals($this->publisher, $this->object->getSandboxPublisherId());
    }

    public function testLogon()
    {
        try {
            $this->object->logon('wrongUsername', 'wrongPassword');
            $this->fail('Exception by type ZendX_Service_Affilinet_Exception expected');
        } catch (ZendX_Service_Affilinet_Exception $e) {
            
        }

        $token = '';
        try {
            $this->object->logon($this->username, $this->password);
        } catch (ZendX_Service_Affilinet_Exception $e) {
            $this->fail('Logon failed: ' . $e->getMessage());
        }

        $this->assertTrue($this->object->isLoggedIn());
    }

    public function testGetShops()
    {
        try {
            $shops = $this->object->getShops();
        } catch (ZendX_Service_Affilinet_Exception $e) {
            $this->fail('getShops failed: ' . $e->getMessage());
        }
        $this->assertInstanceOf('ZendX_Service_Affilinet_Collection_Shops', $shops);
        $this->assertGreaterThan(0, count($shops));

        /**
         * @var ZendX_Service_Affilinet_Item_Shop $shop
         */
        $shop = $shops[0];
        $this->assertInstanceOf('ZendX_Service_Affilinet_Item_Shop', $shop);

        $this->assertInternalType('integer', $shop->getShopId());
        $this->assertGreaterThan(0, $shop->getShopId());

        $this->assertInternalType('integer', $shop->getProgramId());
        $this->assertInternalType('integer', $shop->getProducts());

        $this->assertInternalType('string', $shop->getTitle());
        
        $this->assertInstanceOf('Zend_Date', $shop->getLastUpdate());
    }

    public function testGetCategories()
    {
        try {
            $categories = $this->object->getCategories(419);
        } catch (ZendX_Service_Affilinet_Exception $e) {
            $this->fail('getCategories failed: ' . $e->getMessage());
        }
        $this->assertInstanceOf('ZendX_Service_Affilinet_Collection_Categories', $categories);
        $this->assertGreaterThan(0, count($categories));

        /**
         * @var ZendX_Service_Affilinet_Item_Category $category
         */
        $category = $categories[0];
        $this->assertInstanceOf('ZendX_Service_Affilinet_Item_Category', $category);

        $this->assertInternalType('integer', $category->getCategoryId());
        $this->assertGreaterThan(0, $category->getCategoryId());

        $this->assertInternalType('integer', $category->getProducts());
        $this->assertInternalType('integer', $category->getParentCategoryId());

        $this->assertInternalType('string', $category->getTitle());
        $this->assertInternalType('string', $category->getCategoryPath());
    }

    public function testGetCategoryPath()
    {
        try {
            $categories = $this->object->getCategoryPath(29429720, 419);
        } catch (ZendX_Service_Affilinet_Exception $e) {
            $this->fail('getCategoryPath failed: ' . $e->getMessage());
        }
        $this->assertInstanceOf('ZendX_Service_Affilinet_Collection_Categories', $categories);
        $this->assertGreaterThan(0, count($categories));

        /**
         * @var ZendX_Service_Affilinet_Item_Category $category
         */
        $category = $categories[0];
        $this->assertInstanceOf('ZendX_Service_Affilinet_Item_Category', $category);

        $this->assertInternalType('integer', $category->getCategoryId());
        $this->assertGreaterThan(0, $category->getCategoryId());

        $this->assertInternalType('integer', $category->getProducts());
        $this->assertInternalType('integer', $category->getParentCategoryId());

        $this->assertInternalType('string', $category->getTitle());
        $this->assertInternalType('string', $category->getCategoryPath());

        $this->assertEquals(0, $category->getParentCategoryId());

        for ($i = 1, $categoriesCount = count($categories); $i < $categoriesCount; $i++) {
            $parentCategory = $category;
            $category = $categories[$i];
            $this->assertEquals($parentCategory->getCategoryId(), $category->getParentCategoryId());
        }
    }

    public function testCriteria()
    {
        /**
         * @var ZendX_Service_Affilinet_Criteria_Abstract $criteria
         */
        $criteria = $this->getMockForAbstractClass('ZendX_Service_Affilinet_Criteria_Abstract');
        $this->assertInstanceOf('ZendX_Service_Affilinet_Criteria_Abstract', $criteria);
        $this->assertInstanceOf('ZendX_Service_Affilinet_Criteria_Interface', $criteria);

        $query = 'testQuery';
        $pageSize = 1;
        $currentPage = 1;
        $sortBy = 'testSortBy';
        $sortOrder = 'testSortOrder';

        $criteria->setQuery($query);
        $this->assertEquals($query, $criteria->getQuery());

        $criteria->setCurrentPage($currentPage);
        $this->assertEquals($currentPage, $criteria->getCurrentPage());

        $criteria->setPageSize($pageSize);
        $this->assertEquals($pageSize, $criteria->getPageSize());

        $criteria->setSortBy($sortBy);
        $this->assertEquals($sortBy, $criteria->getSortBy());

        $criteria->setSortOrder($sortOrder);
        $this->assertEquals($sortOrder, $criteria->getSortOrder());

        $params = $criteria->toArray();

        $this->assertArrayHasKey('Query', $params);
        $this->assertArrayHasKey('CurrentPage', $params);
        $this->assertArrayHasKey('PageSize', $params);
        $this->assertArrayHasKey('SortBy', $params);
        $this->assertArrayHasKey('SortOrder', $params);

        $this->assertEquals($query, $params['Query']);
        $this->assertEquals($currentPage, $params['CurrentPage']);
        $this->assertEquals($pageSize, $params['PageSize']);
        $this->assertEquals($sortBy, $params['SortBy']);
        $this->assertEquals($sortOrder, $params['SortOrder']);
    }

    public function testProductCriteria()
    {
        $criteria = new ZendX_Service_Affilinet_Criteria_Product();
        $this->assertInstanceOf('ZendX_Service_Affilinet_Criteria_Abstract', $criteria);
        $this->assertInstanceOf('ZendX_Service_Affilinet_Criteria_Interface', $criteria);
        $this->assertInstanceOf('ZendX_Service_Affilinet_Criteria_Product', $criteria);

        $query = 'testQuery';
        $pageSize = 1;
        $currentPage = 1;
        $sortBy = 'testSortBy';
        $sortOrder = 'testSortOrder';

        $criteria->setQuery($query);
        $this->assertEquals($query, $criteria->getQuery());

        $criteria->setCurrentPage($currentPage);
        $this->assertEquals($currentPage, $criteria->getCurrentPage());

        $criteria->setPageSize($pageSize);
        $this->assertEquals($pageSize, $criteria->getPageSize());

        $criteria->setSortBy($sortBy);
        $this->assertEquals($sortBy, $criteria->getSortBy());

        $criteria->setSortOrder($sortOrder);
        $this->assertEquals($sortOrder, $criteria->getSortOrder());

        $publisherId = $this->publisher;
        $withImagesOnly = true;
        $details = true;
        $minPrice = 1;
        $maxPrice = 100;
        $shopsIds = array(419, 492);
        $imageSize = ZendX_Service_Affilinet_Criteria_Product::ALL_IMAGES;

        $criteria->setPublisherId($publisherId);
        $this->assertEquals($publisherId, $criteria->getPublisherId());

        $criteria->setWithDetails($details);
        $this->assertEquals($details, $criteria->getWithDetails());

        $criteria->setWithImages($withImagesOnly);
        $this->assertEquals($withImagesOnly, $criteria->getWithImages());

        $criteria->setMaxPrice($maxPrice);
        $this->assertEquals($maxPrice, $criteria->getMaxPrice());

        $criteria->setMinPrice($minPrice);
        $this->assertEquals($minPrice, $criteria->getMinPrice());

        $criteria->setShopIds($shopsIds);
        $this->assertEquals($shopsIds, $criteria->getShopIds());

        $criteria->setImageSize($imageSize);
        $this->assertEquals($imageSize, $criteria->getImageSize());

        $params = $criteria->toArray();

        $this->assertArrayHasKey('Query', $params);
        $this->assertArrayHasKey('CurrentPage', $params);
        $this->assertArrayHasKey('PageSize', $params);
        $this->assertArrayHasKey('SortBy', $params);
        $this->assertArrayHasKey('SortOrder', $params);

        $this->assertArrayHasKey('PublisherId', $params);
        $this->assertArrayHasKey('WithImageOnly', $params);
        $this->assertArrayHasKey('Details', $params);
        $this->assertArrayHasKey('MinimumPrice', $params);
        $this->assertArrayHasKey('MaximumPrice', $params);
        $this->assertArrayHasKey('ShopIds', $params);
        $this->assertArrayHasKey('ImageSize', $params);

        $this->assertEquals($query, $params['Query']);
        $this->assertEquals($currentPage, $params['CurrentPage']);
        $this->assertEquals($pageSize, $params['PageSize']);
        $this->assertEquals($sortBy, $params['SortBy']);
        $this->assertEquals($sortOrder, $params['SortOrder']);

        $this->assertEquals($publisherId, $params['PublisherId']);
        $this->assertEquals($withImagesOnly, $params['WithImageOnly']);
        $this->assertEquals($details, $params['Details']);
        $this->assertEquals($minPrice, $params['MinimumPrice']);
        $this->assertEquals($maxPrice, $params['MaximumPrice']);
        $this->assertEquals($shopsIds, $params['ShopIds']);
        $this->assertEquals($imageSize, $params['ImageSize']);
    }

    public function testSearchProducts()
    {
        $this->markTestIncomplete('ToDo searchProducts test');
    }
    
}
?>
