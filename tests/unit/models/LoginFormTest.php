<?php

namespace tests\models;

use app\modules\login\models\LoginForm;
use Codeception\Specify;

class LoginFormTest extends \Codeception\Test\Unit
{
    public function testLoginNoUser()
    {
        $this->model = new LoginForm([
            'email' => 'test@test.ru',
            'hash' => bin2hex(random_bytes(32)),
        ]);

        $this->model->getUser();
    }

}
