<?php

/* @var $this yii\web\View */
/* @var $models [] */
/* @var $model \app\models\CommentForm */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Comments';
?>
<div class="site-index">

    <div class="row">
        <div class="col-md-6">

            <h2><?php echo 'Comments' ?></h2>
            <?php if (isset($models)) : ?>
                <ul class="media-list">
                    <?php foreach ($models as $item) : ?>
                        <li class="media">
                            <div class="media-left">
                                <span class="glyphicon glyphicon-user"></span>
                            </div>
                            <div class="media-body">
                                <h4 class="media-heading"><?php echo Html::encode($item['name']) ?></h4>
                                <p><?php echo Html::encode($item['text']) ?></p>
                                <p><?php echo Html::encode($item['created_at']) ?></p>
                            </div>
                        </li>
                    <?php endforeach ?>
                </ul>
            <?php endif ?>

        </div>
        <div class="col-md-6">

            <?php if (isset($model)) : ?>
                <?php $form = ActiveForm::begin([
                    'id' => 'comment-form'
                ]); ?>

                <?php echo $form->field($model, 'text')->textarea() ?>

                <div class="form-group">
                    <div class="">
                        <?php echo Html::submitButton('Comment', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
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
    </div>

</div>
