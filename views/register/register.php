<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use app\models\User;

$this->title = 'Registrieren';
?>
<div class="site-login">
    <h1><?= Html::encode($this->title) ?></h1>

    <?php $form = ActiveForm::begin([
        'action' => ['register/register'],
        'id' => 'register-form',
        'layout' => 'horizontal',
        'fieldConfig' => [
            'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
            'labelOptions' => ['class' => 'col-lg-1 control-label'],
        ],
    ]); ?>

        <?= $form->field($model, 'username')->textInput(['autofocus' => true])->label('Username') ?>

        <?= $form->field($model, 'password')->passwordInput()->label('Passwort') ?>

        <?= $form->field($model, 'passwordRetype')->passwordInput()->label('Passwort wiederholen') ?>

        <div class="form-group">
            <div class="col-lg-offset-1 col-lg-11">
                <?= Html::submitButton('Registrieren', ['class' => 'btn btn-primary', 'name' => 'register-button']) ?>
            </div>
        </div>


    <?php ActiveForm::end(); ?>



</div>
