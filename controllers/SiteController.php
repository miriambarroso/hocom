<?php

namespace app\controllers;

use app\models\User;
use app\models\UserQuery;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout', 'users'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return Response|string
     */
    public function actionIndex()
    {
        if(!Yii::$app->user->identity){
            return $this->redirect('/site/sign-in');
        }
        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (Yii::$app->user->identity && Yii::$app->user->identity->id) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|Response
     * @throws \yii\base\Exception
     */
    public function actionSignUp()
    {
        $model = new User();

        if ($model->load($this->request->post())) {
            $existingUser = User::find()->where(['username' => $model->username])->one();
            if ($existingUser) {
                $model->addError('username', Yii::t('main', 'Registration already in use.'));
            } else {
                $model->password_hash = Yii::$app->getSecurity()->generatePasswordHash($model->password);
                if ($model->save()) {
                    return $this->redirect(['sign-in']);
                } else {
                    Yii::$app->session->addFlash('danger', 'Internal error. Try again later.');
                }
            }
        }

        return $this->render('/user/create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @return string|Response
     */
    public function actionSignIn()
    {
        $model = new User();
        if ($model->load($this->request->post())) {
            $user = $model->username ? User::find()->where(['username'=> $model->username])->one() :'';
            if($user){
                if(Yii::$app->getSecurity()->validatePassword($model->password, $user->password_hash)) {
                    if (Yii::$app->user->login($model)) {
                        return $this->redirect(['index']);
                    }
                } else {
                    Yii::$app->session->addFlash('danger', Yii::t('main', 'Registration or password incorrect.'));
                }
            } else {
                Yii::$app->session->addFlash('danger', Yii::t('main', 'Registration not found.'));
            }
        }

        return $this->render('/user/login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    /**
     * Displays user/list page.
     *
     * @return string
     */
    public function actionUsers()
    {
        $searchModel = new UserQuery();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('/user/index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single User model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Finds the User model based on its primary key value.
     * If the model User is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
