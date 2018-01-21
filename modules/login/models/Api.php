<?php

namespace app\modules\login\models;

use Yii;

/**
 * LoginForm is the model behind the login form.
 *
 * @property User|null $user This property is read-only.
 *
 */
class Api extends \yii\db\ActiveRecord {

    /**
     * @return array the validation rules.
     */
    public function rules() {
        return [
            [['api_key'], 'required'],
            [['api_key', 'name'], 'string'],
            [['id_user', 'money'], 'integer'],
        ];
    }

    public function getUser() {
        return Self::findOne([
                    'id_user' => Yii::$app->user->identity->id,
        ]);
    }

    public function getUserForApiKey() {
        return Self::findOne([
                    'api_key' => $this->api_key,
        ]);
    }

    public function setMoney() {
        $transaction = Yii::$app->db->beginTransaction();
        $sql = Yii::$app->db->createCommand("SELECT money FROM api WHERE api_key = :apiKey FOR UPDATE")
                ->bindValue(':apiKey', $this->api_key)
                ->queryOne();
        if (!empty($sql) && $this->money <= $sql['money']) {
            $this->money = $sql['money'] - $this->money;
            $sql = Yii::$app->db->createCommand("UPDATE api SET money = :money WHERE api_key = :apiKey")
                    ->bindValue(':money', $this->money)
                    ->bindValue(':apiKey', $this->api_key)
                    ->execute();
            if ($sql) {
                $transaction->commit();
                return true;
            }
        }
        $transaction->rollBack();
        return false;
    }

    public function attributeLabels() {
        return [
            'name' => 'Имя',
            'money' => 'Деньги'
        ];
    }

}
