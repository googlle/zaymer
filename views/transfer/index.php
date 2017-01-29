<?php

/* @var $this yii\web\View */
/* @var $models \app\models\User[] */
/* @var $model \app\models\TransferForm */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Transfer';
?>
<div class="site-index">

    <div class="row">
        <div class="col-md-6">
            <h2><?php echo Html::encode($this->title) ?></h2>

            <?php if (isset($model)) : ?>
                <?php $form = ActiveForm::begin([
                    'id' => 'transfer-form'
                ]); ?>

                <?php echo $form->field($model, 'email') ?>
                <?php echo $form->field($model, 'amount')->textInput() ?>

                <div class="form-group">
                    <div class="">
                        <?php echo Html::submitButton('Submit', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
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
            <?php endif ?>
        </div>
        <div class="col-md-3">
            <h2><?php echo 'My balance' ?></h2>
            <?php if (isset($me)) : ?>
                <p><?php echo Html::encode($me->balance) ?></p>
            <?php endif ?>
        </div>
        <div class="col-md-3">
            <h2><?php echo 'Users' ?></h2>
            <?php if (isset($models)) : ?>
                <ul class="media-list">
                    <?php foreach ($models as $item) : ?>
                        <li class="media">
                            <div class="media-left">
                                <span class="glyphicon glyphicon-user"></span>
                            </div>
                            <div class="media-body">
                                <h4 class="media-heading">
                                    <?php echo sprintf('%s (%s)', $item->name, $item->email) ?>
                                </h4>
                                <p><?php echo $item->balance ?></p>
                            </div>
                        </li>
                    <?php endforeach ?>
                </ul>
            <?php endif ?>
        </div>
    </div>

</div>
