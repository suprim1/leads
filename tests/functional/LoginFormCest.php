<?php
class LoginFormCest
{
    public function openLoginPage(\FunctionalTester $I)
    {
        $I->amOnRoute('/');
        $I->see('Авторизация','h2');
        $I->fillField('input[name="LoginForm[email]"]', 'test@test.ru');
        $I->click('login-button');
        $I->see('Успех', 'h2');
    }

}