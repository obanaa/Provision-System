<?php
/**
 * Created by PhpStorm.
 * User: obana
 * Date: 20.07.16
 * Time: 13:04
 */

namespace Step\Acceptance;
use Exception;

class PSLoginSteps extends \AcceptanceTester
{

    public static $URL = '/';
    public static $emailField = './/*[@type="email"]';
    public static $passwordField = './/*[@type="password"]';
    public static $submitButton = './/button';
    public static $titleText = './/*[@class="title"]';


    public function loginProvSystem($login,$pass){
        $I = $this;
        try{
        $I->amOnPage(self::$URL);
        $I->fillField(self::$emailField, $login);
        $I->fillField(self::$passwordField, $pass);
        $I->click(self::$submitButton);
        $I->waitForElementVisible(self::$titleText);
        $I->see('Dashboard',self::$titleText);
    } catch (Exception $e){
        $I->waitForElementVisible(self::$titleText);
        }
    }

}