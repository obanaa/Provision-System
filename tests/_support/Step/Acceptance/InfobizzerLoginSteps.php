<?php
/**
 * Created by PhpStorm.
 * User: obana
 * Date: 19.07.16
 * Time: 10:51
 */

namespace Step\Acceptance;


class InfobizzerLoginSteps extends \AcceptanceTester
{

    public static $signInLink = '//*[@id="navMenu"]/ul/li[6]/a';
    public static $URL = '/';
    public static $userNameField = '//*[@id="signInEmail"]';
    public static $passwordField = '//*[@id="signInPass"]';
    public static $signInButton = '//*[@id="signInForm"]//button';
    public static $headerMenu = '//*[@id="nav-menu"]';


    public function loginInfobizzer($login,$pass){
        $I = $this;
        $I->amOnPage(self::$URL);
        $I->waitForElementVisible(self::$signInLink);
        $I->click(self::$signInLink);
        $I->fillField(self::$userNameField, $login);
        $I->fillField(self::$passwordField, $pass);
        $I->click(self::$signInButton);
        $I->waitForElementVisible(self::$headerMenu);
    }
}