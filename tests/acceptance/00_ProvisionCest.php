<?php
use \Step\Acceptance;

/**
 * @group test
 */
class PSCest
{

    // ShopByBrand

    function T1Authorization(Step\Acceptance\PSLoginSteps $I)    {
        $I->loginProvSystem('admin@admin.com', '5l8lZbklgx');
    }
/**/
    function T2CheckSideBarLinks(Step\Acceptance\PSLoginSteps $I, \Page\PSDeployPage $deployPage) {
        $deployPage->goToDeployPage();
        $deployPage->goToInstancesPage();
        $deployPage->goToSettingsPage();
        $deployPage->goToUsersPage();
        $deployPage->goToDashboardPage(); }
    
    function T3CreateTestInstance(Step\Acceptance\PSLoginSteps $I, \Page\PSDeployPage $deployPage){
        $deployPage->goToDeployPage();
        $deployPage->createTestInstance('master-test');
    }

    function T4StopTestInstance(Step\Acceptance\PSLoginSteps $I, \Page\PSDeployPage $deployPage){
        $deployPage->goToInstancesPage();
        $deployPage->stopTestInstance();
    }

    function T5StartTestInstance(Step\Acceptance\PSLoginSteps $I, \Page\PSDeployPage $deployPage){
        $deployPage->goToDeployPage();
        $deployPage->goToInstancesPage();
        $deployPage->startTestInstance();
    }


    function T6DeleteTestInstance(Step\Acceptance\PSLoginSteps $I, \Page\PSDeployPage $deployPage){
        $deployPage->goToDeployPage();
        $deployPage->goToInstancesPage();
        $deployPage->deleteTestInstance();
    }






}
