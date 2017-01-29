<?php
namespace app\controllers;

use app\models\TransferForm;
use app\models\User;
use Yii;
use yii\web\Controller;

class TransferController extends Controller
{
    /**
     * Transfer action.
     *
     * @return string
     */
    public function actionIndex()
    {
        $models = User::getAll();

        $model = new TransferForm();
        $messageType = null;
        $message = null;

        $me = User::findOne(\Yii::$app->user->identity->getId());

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->email != $me->email) {
                $user = User::findByEmail($model->email);

                if ($user) {
                    if ($me->balance >= $model->amount) {
                        $transaction = Yii::$app->db->beginTransaction();

                        try {
                            $me->balance = $me->balance - $model->amount;
                            $user->balance = $user->balance + $model->amount;

                            if ($me->save() && $user->save()) {
                                $transaction->commit();

                                return $this->refresh();
                            } else {
                                $messageType = 'error';
                                $message = 'Error db. Try again';
                            }
                        } catch (\Exception $e) {
                            $transaction->rollBack();
                            Yii::error($e->getMessage());
                        }
                    } else {
                        $messageType = 'error';
                        $message = 'Error. Not enough money';
                    }
                } else {
                    $messageType = 'error';
                    $message = 'Error. User not found';
                }
            } else {
                $messageType = 'error';
                $message = 'Error. You can\'t send to yourself';
            }
        }

        return $this->render('index', [
            'model'       => $model,
            'models'      => $models,
            'me'          => $me,
            'messageType' => $messageType,
            'message'     => $message,
        ]);
    }
}
