<?php

/* @var $this yii\web\View */
/* @var $models [] */

use yii\helpers\Url;

$this->title = 'Zaymer';
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
                                <h4 class="media-heading"><?php echo $item['name'] ?></h4>
                                <p><?php echo $item['text'] ?></p>
                                <p><?php echo $item['created_at'] ?></p>
                            </div>
                        </li>
                    <?php endforeach ?>
                </ul>
            <?php endif ?>

        </div>
        <div class="col-md-6">
            <a href="<?php echo Url::to(['/site/login']) ?>" class="btn btn-primary btn-md">
                To leave a comment log in
            </a>
        </div>
    </div>
</div>
