<?php

namespace app\controllers;

use app\models\Comment;
use app\models\LoginForm;
use app\models\RegisterForm;
use app\models\User;
use Yii;
use yii\db\Query;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;

class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only'  => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow'   => true,
                        'roles'   => ['@'],
                    ],
                ],
            ],
            'verbs'  => [
                'class'   => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error'   => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class'           => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->redirect(['/comment/index']);
        }

        $models = Comment::getRecentComments();

        return $this->render('index', [
            'models'      => $models,
        ]);
    }

    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        $messageType = null;
        $message = null;

        if ($model->load(Yii::$app->request->post())) {
            $user = User::findByEmail($model->email);

            if ($user != null && $user->validatePassword($model->password)) {
                Yii::$app->user->login($user, $model->rememberMe ? 3600 * 24 * 30 : 0);

                return $this->redirect(['/site/index']);
            } else {
                $messageType = 'error';
                $message = 'Incorrect email or password.';
            }
        }

        return $this->render('login', [
            'model'       => $model,
            'messageType' => $messageType,
            'message'     => $message,
        ]);
    }

    public function actionRegister()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new RegisterForm();
        $messageType = null;
        $message = null;

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $user = new User();
            $user->name = $model->name;
            $user->balance = 1000;
            $user->email = $model->email;
            $user->password = $model->password;
            $user->role = User::ROLE_GUEST;
            $user->status = User::STATUS_ACTIVE;
            $user->created_at = date('Y-m-d H:i:s');
            $user->setPassword($model->password);
            $user->setAuthKey();

            if ($user->save()) {
                Yii::$app->user->login($user);

                return $this->redirect(['/site/index']);
            } else {
                $messageType = 'error';
                $message = 'Error db. Try again';
            }
        }

        return $this->render('register', [
            'model'       => $model,
            'messageType' => $messageType,
            'message'     => $message,
        ]);
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
}
