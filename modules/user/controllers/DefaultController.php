<?php

namespace app\modules\user\controllers;

use yii\web\Controller;
use Yii;
use app\modules\login\models\Api;
use app\modules\login\models\LoginForm;

class DefaultController extends Controller {

    public function actionIndex() {
        if (!yii::$app->user->isGuest) {
            if (yii::$app->request->get()) {
                return $this->redirect('/user');
            }
            $api = new Api();
            $api = $api->getUser();
            return $this->render('index', [
                        'model' => $api,
            ]);
        } else {
            $model = new LoginForm();
            if ($model->load(yii::$app->request->get(), '') && $model->validate()) {
                if ($model->getUser()) {
                    Yii::$app->user->login($model->getUser());
                    $users = $model->getUser();
                    $users->hash = null;
                    if ($users->reg == 0) {
                        $users->reg = 1;
                        $users->save();
                        $api = new Api;
                        $api->id_user = $users->id;
                        $api->api_key = bin2hex(random_bytes(32));
                        $api->money = 1000;
                        $api->name = 'newUser';
                        $api->save();
                    }
                    return $this->redirect('/user');
                } else {
                    return $this->render('noOpen');
                }
            }
        }
    }

    public function actionSwitchName() {
        if (!Yii::$app->user->isGuest && Yii::$app->request->isPost) {
            $request = Yii::$app->request->post();
            $api = new Api();
            $api->api_key = $request['api_key'];
            $api = $api->getUserForApiKey();
            if ($api) {
                $api->name = LoginForm::xss($request['Api']['name']);
                $api->save();
                return true;
            }
        }
        return false;
    }

    public function actionMoney() {
        if (!Yii::$app->user->isGuest && Yii::$app->request->isPost) {
            $request = Yii::$app->request->post();
            $api = new Api();
            $api->money = LoginForm::xss($request['Api']['money']);
            $api->api_key = LoginForm::xss($request['api_key']);
            if ($api->setMoney()) {
                return true;
            }
        }
        return false;
    }

}
