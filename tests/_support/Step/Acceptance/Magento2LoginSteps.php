<?php
/**
 * Created by PhpStorm.
 * User: obana
 * Date: 19.07.16
 * Time: 17:08
 */

namespace Step\Acceptance;


class Magento2LoginSteps extends \AcceptanceTester
{



    public static $URL = '/admin_n9gyg0/admin/';
    public static $usernameField = './/*[@id=\'username\']';
    public static $passwordField = './/*[@id=\'login\']';
    public static $submitButton = './/button';
    public static $headerText = './/*[@class=\'page-wrapper\']/header';


    public function loginMagento2($login,$pass){
        $I = $this;
        $I->amOnPage(self::$URL);
        $I->fillField(self::$usernameField, $login);
        $I->fillField(self::$passwordField, $pass);
        $I->click(self::$submitButton);
        $I->waitForElementVisible(self::$headerText);
        $I->see('Dashboard',self::$headerText);
    }






}