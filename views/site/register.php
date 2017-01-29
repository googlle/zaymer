<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\RegisterForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Register';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login">
    <h1><?php echo Html::encode($this->title) ?></h1>

    <p>Please fill out the following fields to login:</p>

    <?php $form = ActiveForm::begin([
        'id' => 'login-form',
        'layout' => 'horizontal',
        'fieldConfig' => [
            'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
            'labelOptions' => ['class' => 'col-lg-1 control-label'],
        ],
    ]); ?>

        <?php echo $form->field($model, 'name')->textInput(['autofocus' => true]) ?>
        
        <?php echo $form->field($model, 'email')->textInput(['autofocus' => true]) ?>

        <?php echo $form->field($model, 'password')->passwordInput() ?>

        <div class="form-group">
            <div class="col-lg-offset-1 col-lg-11">
                <?php echo Html::submitButton('Register', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
            </div>
        </div>
        
        <?php if (isset($messageType) && $messageType == 'success' && isset($message)): ?>
            <div class="alert alert-success">
                <?php echo Html::encode($message); ?>
            </div>
        <?php endif; ?>

        <?php if (isset($messageType) && $messageType == 'error' && isset($message)): ?>
            <div class="alert alert-danger">
                <?php echo Html::encode($message); ?>
            </div>
        <?php endif; ?>

    <?php ActiveForm::end(); ?>
</div>
