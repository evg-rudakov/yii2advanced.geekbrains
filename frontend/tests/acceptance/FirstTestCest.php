<?php namespace frontend\tests\acceptance;
use frontend\tests\AcceptanceTester;
use yii\helpers\Url;

class FirstTestCest
{
    public function _before(AcceptanceTester $I)
    {
        $I->amOnPage(Url::toRoute('/site/index'));

    }

    // tests
    public function tryToTest(AcceptanceTester $I)
    {
        $I->see('My Application');

        $I->seeLink('About');
        $I->click('About');

        $I->see('This is the About page.');
    }
}
