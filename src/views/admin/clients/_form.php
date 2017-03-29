<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model filsh\yii2\oauth2server\models\OauthClients */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="oauth-clients-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'client_id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'client_secret')->passwordInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'redirect_uri')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'grant_types')->checkboxList([
       'client_credentials'		=> 'Client credentials',
        'authorization_code'	=> 'Authorization code',
        'password'						=> 'Password',
        'implicit'						=> 'Implicit',
        'refresh_token'				=> 'Refresh token']) ?>

    <?= $form->field($model, 'scope')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
