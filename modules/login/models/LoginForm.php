<?php

namespace app\modules\login\models;

use yii\base\Model;
use yii\helpers\Html;
use yii\helpers\HtmlPurifier;

/**
 * LoginForm is the model behind the login form.
 *
 * @property User|null $user This property is read-only.
 *
 */
class LoginForm extends Model
{
    public $email;
    public $hash;

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            [['email'], 'required'],
            [['email'], 'trim'],
            ['hash', 'string'],
            ['email', 'email'],
        ];
    }


     public function getUser()
    {
        return Users::findOne([
            'login' => $this->email,
            'hash' => $this->hash,
            ]);
    }

    public function attributeLabels()
    {
        return [
            'email' => 'email',
        ];
    }

    public static function xss(string $param)
    {
        $param = Html::encode($param);
        $param = HtmlPurifier::process($param);
        return $param;
    }

}
