<?php

namespace app\controllers;

use Yii;
use app\models\Task;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\ForbiddenHttpException;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * TaskController implements the CRUD actions for Task model.
 */
class TaskController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ]
        ];
    }

    /**
     * Lists all Task models.
     * @return mixed
     */
    public function actionMy()
    {
        $query = Task::find()->byCreator(Yii::$app->user->id);
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        return $this->render('my', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Lists of shared Task models.
     * @return mixed
     */
    public function actionShared()
    {
        $query = Task::find()->byCreator(Yii::$app->user->id)
            ->innerJoinWith(Task::RELATION_TASK_USERS);
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        return $this->render('shared', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Lists of accessed Task models.
     * @return mixed
     */
    public function actionAccessed()
    {
        $query = Task::find()
            ->innerJoinWith(Task::RELATION_TASK_USERS)
            ->where(['user_id' => Yii::$app->user->id]);
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        return $this->render('accessed', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Task model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);

        return $this->render('view', [
            'model' => $model,
        ]);
    }

    /**
     * Creates a new Task model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Task();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', 'Вы успешно создали задачу');
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Task model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', 'Вы успешно обновили задачу');
            return $this->redirect(['view', 'id' => $model->id]);
        }

        throw new ForbiddenHttpException();
    }

    /**
     * Deletes an existing Task model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()){
            Yii::$app->session->setFlash('success', 'Вы успешно удалили задачу');

            return $this->redirect(['my']);
        }
        throw new ForbiddenHttpException();
    }

    /**
     * Finds the Task model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Task the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Task::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
