<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use yii\jui\DatePicker;

use filsh\yii2\oauth2server\models\OauthClients;

/* @var $this yii\web\View */
/* @var $model filsh\yii2\oauth2server\models\OauthAccessTokens */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="oauth-access-tokens-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'access_token')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'client_id', [
        'inputOptions' => [
            'autofocus' => 'autofocus',
            'class' => 'form-control',
            'tabindex' => '1']])->dropDownList(ArrayHelper::map(OauthClients::find()->all(), 'client_id', 'client_id'));
    ?>

		<?= $form->field($model, 'expires')->widget(DatePicker::classname(), [
			'dateFormat' => 'yyyy-MM-dd',
		]);?>

    <?= $form->field($model, 'scope')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
