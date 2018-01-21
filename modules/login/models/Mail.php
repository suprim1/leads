<?php

namespace app\modules\login\models;

use yii\db\Query;
use yii\helpers\ArrayHelper;
use Yii;

class Mail {

    public static function tableName() {
        return 'Avto';
    }

    public static function getQuery(string $table) {

        $query = (new Query())
                ->select('id, type')
                ->from($table)
                ->all();
        return ArrayHelper::map($query, 'id', 'type');
    }

    public static function mails($message, string $email) {
        try {
            $mail = Yii::$app->mailer->compose()
                    ->setFrom('suprim1@yandex.ru')
                    ->setTo($email)
                    ->setSubject('Регистрация/авторизация')
                    ->setHtmlBody($message);
            $mail->send();
        } catch (\Exception $e) {
            echo 'Ошибка передачи сообщения: ' . "\n";
        }
    }

}
