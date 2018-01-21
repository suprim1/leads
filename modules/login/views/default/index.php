<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Авторизация';
?>
<div class="site-login col-lg-12 col-md-12 col-sm-12 col-xs-12">

    <h2>Авторизация</h2>


    <?php
    $form = ActiveForm::begin([
                'id' => 'login-form',
                'layout' => 'horizontal',
                'fieldConfig' => [
                    'template' => "<div class=\"col-lg-3 col-md-4 col-sm-5 col-xs-12\">{input}</div>\n<div class=\"col-lg-12 col-md-12 col-sm-12 col-xs-12 error_height\">{error}</div>",
                    'labelOptions' => ['class' => 'control-label'],
                ],
    ]);
    ?>

    <?=
    $form->field($model, 'email')->textInput([
        'autofocus' => true,
        'placeholder' => 'email',
    ])
    ?>

    <div class="form-group text-right col-lg-1 col-lg-offset-7 col-md-2 col-sm-2 col-sx-5">
        <?= Html::submitButton('Вход/Регистрация', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
