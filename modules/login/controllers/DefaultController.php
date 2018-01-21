<?php

namespace app\modules\login\controllers;

use yii\web\Controller;
use Yii;
use app\modules\login\models\LoginForm;
use app\modules\login\models\Users;
use app\modules\login\models\Mail;

class DefaultController extends Controller {

    public function actionIndex() {
        if (!yii::$app->user->isGuest) {
            return $this->redirect('/user');
        }
        $model = new LoginForm();
        if (yii::$app->request->post('LoginForm')) {

            if ($model->load(yii::$app->request->post())) {
                $hash = bin2hex(random_bytes(32));
                if ($model->getUser()) {
                    $users = $model->getUser();
                } else {
                    $users = new Users;
                    $users->login = LoginForm::xss($model->email);
                }
                $users->hash = $hash;
                $users->save();
                $message = $this->renderPartial('mail', [
                    'email' => $model->email,
                    'hash' => $hash,
                ]);
                Mail::mails($message, $model->email);
                return $this->render('success', ['model' => $model]);
            }
        }

        return $this->render('index', [
                    'model' => $model,
        ]);
    }

    public function actionActivation(string $email, string $hash) {

    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout() {
        if (!yii::$app->user->isGuest) {
            Yii::$app->user->logout();
            return $this->redirect(['/login']);
        }
    }

}
