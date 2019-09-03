<?php namespace frontend\tests\acceptance;
use frontend\tests\AcceptanceTester;
use yii\helpers\Url;

class CheckHelloWorldCest
{
    public function _before(AcceptanceTester $I)
    {
//        $I->expectTo('')
    }

    // tests
    public function tryToTest(AcceptanceTester $I)
    {
        $I->amOnPage(Url::to(['hello/world']));
        $I->see('Helllo');
    }
}
