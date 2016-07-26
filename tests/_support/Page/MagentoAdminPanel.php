<?php
/**
 * Created by PhpStorm.
 * User: obana
 * Date: 08.06.16
 * Time: 15:23
 */

namespace Page;


class MagentoAdminPanel
{

    public static $URL = '/admin';

    /// Dashboard Page

    public static $customersDropDownList = '//*[@id="nav"]/li[5]/a';
    public static $customerManage = '//*[@id="nav"]/li[5]/ul/li[1]/a/span';

    /// Manage Custome Page

    public static $assertCustomerManagePage = '//*[@class="content-header"]//h3';
    public static $filterEmailField = '//*[@class="hor-scroll"]//tr[2]/th[4]//input';
    public static $searchButton = '//*[@class="filter-actions a-right"]/button[2]';
    public static $editLink = '//*[@class="even pointer"]/td[12]/a';

    /// Edit Customer Page

    public static $assertCustomerInformation = './/*[@id="page:left"]/h3';
    public static $deleteCustomerButton = '//*[@class="main-col-inner"]/div/p/button[4]';



    protected $tester;

    public function __construct(\AcceptanceTester $I)

    {
        $this->tester = $I; // подкл. конструктора
    }

    public static $loadPageBlock = './/*[@id="loading_mask_loader"]';

    public function deleteCustomer($email)
    {
        $I= $this ->tester;
        //$I->amOnPage(self::$URL);
        $I->moveMouseOver(self::$customersDropDownList);
        $I->click(self::$customerManage);
        $I->waitForElement(self::$assertCustomerManagePage);
        $I->see('Manage Customers',self::$assertCustomerManagePage);
        $I->fillField(self::$filterEmailField,$email);
        $I->click(self::$searchButton);
        $I->waitForElementNotVisible(self::$loadPageBlock);
        $I->click('Edit');
        $I->waitForElementVisible(self::$assertCustomerInformation);
        $I->see('Customer Information',self::$assertCustomerInformation);
        $I->click(self::$deleteCustomerButton);
        $I->acceptPopup();
        return $this;
    }


}