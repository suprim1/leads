<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

app\modules\user\UserAsset::register($this);
$this->title = 'Личный кабинет';
?>
<div class="site-login col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <p>
        <b>Личный кабинет</b>
    </p>

    <?php
    $form = ActiveForm::begin([
                'id' => 'api-form-name',
                'layout' => 'horizontal',
                'fieldConfig' => [
                    'template' => "<div class=\"col-lg-3 col-md-4 col-sm-5 col-xs-12\">{input}</div><div class='btn btn-primary js-switch_name'>Изменить имя</div>\n<div class=\"col-lg-12 col-md-12 col-sm-12 col-xs-12 error_height\">{error}</div>",
                    'labelOptions' => ['class' => 'control-label'],
                ],
    ]);
    ?>
    <?= Html::hiddenInput('api_key', $model->api_key); ?>
    <?=
    $form->field($model, 'name')->textInput([
        'placeholder' => 'Ваше имя',
        'value' => $model->name,
    ])
    ?>

    <?php ActiveForm::end(); ?>
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        На Вашем счету: <span class="js-new-money"><?= $model->money ?></span> руб <br>
        Введите сумму для вывода средств:
    </div>
    <?php
    $form = ActiveForm::begin([
                'id' => 'api-form-money',
                'layout' => 'horizontal',
                'fieldConfig' => [
                    'template' => "<div class=\"col-lg-3 col-md-4 col-sm-5 col-xs-12\">{input}</div><div class='btn btn-primary js-money'>Вывести деньги</div>\n<div class=\"col-lg-12 col-md-12 col-sm-12 col-xs-12 error_height\">{error}</div>",
                    'labelOptions' => ['class' => 'control-label'],
                ],
    ]);
    ?>
    <?= Html::hiddenInput('api_key', $model->api_key); ?>
    <?=
    $form->field($model, 'money')->textInput([
        'placeholder' => 'какую сумму вывести',
        'class' => 'js-pre-money',
    ])
    ?>
    <?php ActiveForm::end(); ?>

</div>
