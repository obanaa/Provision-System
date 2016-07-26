<?php
/**
 * Created by PhpStorm.
 * User: obana
 * Date: 08.06.16
 * Time: 16:05
 */

namespace Step\Acceptance;


use Exception;

class AdminPanelLoginSteps extends \AcceptanceTester

{
    
    public static $URL = '/admin';
    public static $userNameField = '//*[@id="username"]';
    public static $passwordField = '//*[@id="login"]';
    public static $loginButton = '//*[@class="form-buttons"]/input';
    public static $dashboard = '//*[@class="content-header"]//h3[text()="Dashboard"]';

    /// Dashboard Page

    public static $assertDashboard = './/*[@class="content-header"]//h3';
    public static $popUpClose = '//*[@class="message-popup-head"]//span';






    public function loginAdminPanel($login, $pass)
    {
        $I = $this;
        try {
            $I->amOnPage(self::$URL);
            $I->fillField(self::$userNameField, $login);
            $I->fillField(self::$passwordField, $pass);
            $I->click(self::$loginButton);
            try {
                $I->waitForElement(self::$popUpClose);
                $I->click(self::$popUpClose);
            } catch (Exception $e) {
            }
            $I->waitForElement(self::$assertDashboard);
            $I->see('Dashboard', self::$assertDashboard);
        } catch (Exception $e) {
            $I->waitForElement(self::$dashboard);
        }
    }

        


}