<?php
/**
 * Created by PhpStorm.
 * User: obana
 * Date: 20.07.16
 * Time: 13:27
 */

namespace Page;
use Exception;


class PSDeployPage
{

    protected $tester;

    public function __construct(\AcceptanceTester $I)

    {
        $this->tester = $I; // подкл. конструктора
    }
//SideBar
    public static $dashboardLink = './/*[@title="Dashboard"]';
    public static $deployLink = './/*[@title="Deploy"]';
    public static $instancesLink = './/*[@title="Instances"]';
    public static $usersLink = './/*[@title="Users"]';
    public static $settingsLink = './/*[@title="Settings"]';
    public static $titleText = './/*[@class="title"]';


    public function goToDeployPage(){
        $I= $this ->tester;
        $I->click(self::$deployLink);
        $I->waitForElementVisible(self::$titleText);
        $I->see('Deploy',self::$titleText);
    }

    public function goToInstancesPage(){
        $I= $this ->tester;
        $I->click(self::$instancesLink);
        $I->waitForElementVisible(self::$titleText);
        $I->see('Instances',self::$titleText);
    }

    public function goToUsersPage(){
        $I= $this ->tester;
        $I->click(self::$usersLink);
        $I->waitForElementVisible(self::$titleText);
        $I->see('Users',self::$titleText);}

    public function goToSettingsPage(){
        $I= $this ->tester;
        $I->click(self::$settingsLink);
        $I->waitForElementVisible(self::$titleText);
        $I->see('Settings',self::$titleText);
    }

    public function goToDashboardPage(){
        $I= $this ->tester;
        $I->click(self::$dashboardLink);
        $I->waitForElementVisible(self::$titleText);
        $I->see('Dashboard',self::$titleText);
    }


    // DEPLOY PAGE

    public static $branchMasterTestDropDown = '//*[@id="select_branch"]/option[text()="master"]';
    public static $newBranchField = '//*[@id="newNameBranch"]';
    public static $createBranchButton = '//*[@id="newBranchId"]';
    public static $instanceNameField = '//*[@id="instance_name"]';
    public static $instanceDescriptionField = '//*[@id="instance_description"]';
    public static $existErrorBranch = '//*[@id="errorBranchName"]';
    public static $existErrorInstance = '//*[@id="errorInstancename"]';
    public static $checkboxCommit = '//*[@class=\'deploy-container\']/form/div[2]//input';
    public static $createInstanceButton = '//*[@id="submitCreateInstance"]';

    // Instance Page

    public static $testInstanceName = '//*[@title="master-test"]';
    public static $inProgressStatus = '//*[@class="ind-processing"]';
    public static $statusMasterTestRun = '//*[contains(@class, "ind-run")]/../../td[2]//a[text()="master-test"]';
    public static $statusMasterTestStop = '//*[contains(@class, "ind-fail")]/../../td[2]//a[text()="master-test"]';
    public static $settingsButton = '//tr[2]//a[2]/button';
    public static $restartActionButton = '//*[@class="actions-div"]//li[1]/a';
    public static $stopActionButton = '//*[@class="actions-div"]//li[2]/a';
    public static $destroyActionButton = '//*[@class="actions-div"]//li[3]/a';

    public function createTestInstance($instanceName){
        $I= $this ->tester;
        $I->waitForElementVisible(self::$checkboxCommit);
        $I->click(self::$branchMasterTestDropDown);
        $I->fillField(self::$instanceNameField,$instanceName);
        try {
            $I->waitForElementNotVisible(self::$existErrorInstance);
            $I->click(self::$createInstanceButton);
            $I->waitForElementVisible(self::$inProgressStatus);
            $I->waitForElementVisible(self::$statusMasterTestRun,10000);
        }catch (Exception $e) {
            $I->waitForElementVisible(self::$existErrorInstance);
            $I->click(self::$instancesLink);
            $I->waitForElementVisible(self::$titleText);
            $I->see('Instances',self::$titleText);
            $I->waitForElementVisible(self::$testInstanceName);
        }
    }


    public function stopTestInstance(){
        $I= $this ->tester;
        $I->waitForElementVisible(self::$statusMasterTestRun);
        $I->click(self::$settingsButton);
        $I->waitForElementVisible(self::$stopActionButton);
        $I->click(self::$stopActionButton);
        try {
            $I->waitForElementVisible(self::$statusMasterTestStop,10000);
        } catch (Exception $e){
            $I->click(self::$instancesLink);
            $I->waitForElementVisible(self::$statusMasterTestStop);
        }
    }

    public function startTestInstance(){
        $I= $this ->tester;
        $I->click(self::$instancesLink);
        $I->waitForElementVisible(self::$testInstanceName);
        $I->waitForElementVisible(self::$statusMasterTestStop);
        $I->click(self::$settingsButton);
        $I->waitForElementVisible(self::$stopActionButton);
        $I->click(self::$stopActionButton);
        try {
            $I->waitForElementVisible(self::$statusMasterTestRun,10000);
        } catch (Exception $e){
            $I->click(self::$instancesLink);
            $I->waitForElementVisible(self::$statusMasterTestRun);
        }
    }

    public function deleteTestInstance(){
        $I= $this ->tester;
        $I->click(self::$instancesLink);
        $I->waitForElementVisible(self::$testInstanceName);
        $I->waitForElementVisible(self::$statusMasterTestRun);
        $I->click(self::$settingsButton);
        $I->waitForElementVisible(self::$destroyActionButton);
        $I->click(self::$destroyActionButton);
        try {
            $I->acceptPopup();
        } catch (Exception $e){
            $I->acceptPopup();
            $I->waitForElementNotVisible(self::$testInstanceName,1000);
        }
        $I->waitForElementNotVisible(self::$testInstanceName,1000);
    }






}