<?php
/**
 * Created by PhpStorm.
 * User: obana
 * Date: 19.07.16
 * Time: 17:08
 */

namespace Page;
use Exception;


class Magento2ManageBrands
{

    protected $tester;

    public function __construct(\AcceptanceTester $I)

    {
        $this->tester = $I; // подкл. конструктора
    }

    public static $URL = '/';
    public static $shopByBrandMenu = './/*[@id=\'nav\']/li[4]';
    public static $manageBrands = './/*[@id=\'nav\']/li[4]/div//li[1]';
    public static $headerText = './/*[@class=\'page-wrapper\']/header';
    public static $msgSuccess = './/*[@class="message message-success success"]';
    public static $msgError = './/*[@class="message message-error error"]';

    //manage Brands page
    public static $addNewBrand = './/*[@class=\'page-content\']/div[1]//button[2]';

    public function goToManageBrands(){
        $I= $this ->tester;
        $I->click(self::$shopByBrandMenu);
        $I->waitForElementVisible(self::$manageBrands);
        $I->click(self::$manageBrands);
        $I->waitForElementVisible(self::$headerText);
        $I->see('Brand Manager',self::$headerText);

    }

    public static $brandNameField = './/*[@title="Name"]';
    public static $urlKeyField = './/*[@title="Url Key"]';
    public static $descriptionField = './/*[@title="Description"]';
    public static $shortDescriptionField = './/*[@title="Short Description"]';
    public static $saveBrandButton = './/*[@title="Save Brand"]';
    public static $enableStatus = './/*[@id="brand_status"]/option[1]';




    public function addBrand($brandName,$urlKey,$shortDescription,$description)
    {
        $I = $this->tester;
        try {
            $I->click(self::$addNewBrand);
            $I->waitForElementVisible(self::$headerText);
            $I->see('New Brand', self::$headerText);
            $I->fillField(self::$brandNameField, $brandName);
            $I->fillField(self::$urlKeyField, $urlKey);
            $I->scrollDown(100);
            $I->fillField(self::$shortDescriptionField, $shortDescription);
            $I->fillField(self::$descriptionField, $description);
            $I->click(self::$enableStatus);
            $I->scrollTo(self::$headerText);
            $I->click(self::$saveBrandButton);
            $I->waitForElementVisible(self::$msgSuccess);
            $I->see('The brand has been saved.', self::$msgSuccess);
        } catch (Exception $e) {
            $I->waitForElementVisible(self::$msgError);
            $I->see('Url key has existed. Please fill out a valid one.',self::$msgError);
        }
    }

    public static $frontBrandsDropDown = '//*[@class="navigation"]//span[text()="Brands"]';
    public static $testBrand = '//*[@class="navigation"]//span[text()="Brands"]/../..//li//span[text()="Test Brand"]';

    public function checkBrandOnFrontEnd(){
        $I = $this->tester;
        $I->amOnPage(self::$URL);
        $I->waitForElementVisible(self::$frontBrandsDropDown);
        $I->moveMouseOver(self::$frontBrandsDropDown);
        $I->waitForElementVisible(self::$testBrand);
        $I->scrollTo(self::$testBrand);
        $I->click(self::$testBrand);

}

}