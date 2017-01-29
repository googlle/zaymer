<?php
namespace app\controllers;

use app\models\Comment;
use app\models\CommentForm;
use Yii;
use yii\db\Query;
use yii\web\Controller;

class CommentController extends Controller
{
    /**
     * Comment action.
     *
     * @return string
     */
    public function actionIndex()
    {
        $models = Comment::getRecentComments();

        $model = new CommentForm();
        $messageType = null;
        $message = null;

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $comment = new Comment();
            $comment->user_id = \Yii::$app->user->identity->getId();
            $comment->text = $model->text;
            $comment->created_at = date('Y-m-d H:i:s');

            if ($comment->save()) {
                return $this->refresh();
            } else {
                $messageType = 'error';
                $message = 'Error db. Try again';
            }
        }

        return $this->render('index', [
            'models'      => $models,
            'model'       => $model,
            'messageType' => $messageType,
            'message'     => $message,
        ]);
    }
}
