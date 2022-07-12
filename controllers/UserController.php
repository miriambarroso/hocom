<?php

namespace app\controllers;

use app\models\Users;
use app\models\UsersQuery;
use Yii;
use yii\db\StaleObjectException;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;

/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::class,
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Users models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new UsersQuery();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
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
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|Response
     * @throws \yii\base\Exception
     */
    public function actionSignUp()
    {
        $model = new Users();

        if ($model->load($this->request->post())) {
            $existingUser = Users::find()->where(['username' => $model->username])->one();
            if ($existingUser) {
                $model->addError('username', Yii::t('main', 'Registration already in use.'));
            } else {
                $model->password = Yii::$app->getSecurity()->generatePasswordHash($model->password);
                if ($model->save()) {
                    return $this->redirect(['sign-in']);
                } else {
                    Yii::$app->session->addFlash('danger', 'Internal error. Try again later.');
                }
            }
        }

        return $this->render('create', [
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
        $model = new Users();
        if ( $model->load($this->request->post())) {
            $user = $model->username ? Users::find()->where(['username'=> $model->username])->one() :'';
            if($user){
                if(Yii::$app->getSecurity()->validatePassword($model->password, $user->password)) {
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

        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing User model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        try {
            $this->findModel($id)->delete();
        } catch (StaleObjectException $e) {
            Yii::$app->session->addFlash('danger', Yii::t('main', 'User could not be deleted.'));
        } catch (NotFoundHttpException $e) {
            Yii::$app->session->addFlash('danger', Yii::t('main', 'User could not be deleted.'));
        } catch (\Throwable $e) {
            Yii::$app->session->addFlash('danger', Yii::t('main', 'User could not be deleted.'));
        }

        return $this->redirect(['site/index']);
    }

    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
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
