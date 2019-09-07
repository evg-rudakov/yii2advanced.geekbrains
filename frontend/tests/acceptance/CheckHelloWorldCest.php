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
    public function LoginPage(AcceptanceTester $I)
    {
        $I->amOnPage(Url::to(['/site/login']));
        $I->click('.btn.btn-primary');
        $I->see('Username cannot be blank');
    }
}
