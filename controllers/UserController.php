<?php

namespace app\controllers;

use app\models\Task;
use Yii;
use app\models\User;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\helpers\VarDumper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends Controller
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
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => User::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single User model.
     * @param integer $id
     * @return mixed
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
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new User();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing User model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    public function actionTest()
    {
        //$user = User::findOne(2);
//        $user = new User();
//
//        $user->username = "John";
//        $user->password_hash = "1209380273r987";
//        $user->creator_id = 1;
//        $user->created_at = time();
//
//        $user->save();
//
//        $admin = User::findOne(1);
//        $task = new Task();
//        $task->title = "Торт";
//        $task->description = "Приготовить шоколадный торт";
//        $task->created_at = time();
//
//        $task->link(Task::CREATOR, $admin);
//
//        $task1 = new Task();
//        $task1->title = "Книга";
//        $task1->description = "Прочитать книгу паттерны проектирования";
//        $task1->created_at = time();
//
//        $task1->link(Task::CREATOR, $user);
//
//        $task2 = new Task();
//        $task2->title = "Бег";
//        $task2->description = "Пробежать 15 км";
//        $task2->created_at = time();
//
//        $task2->link(Task::CREATOR, $admin);
//        $users = User::find()->with(User::CREATED_TASKS)->all();
//        foreach ($users as $user){
//            echo VarDumper::dumpAsString($user, 5, true);
//        }
//        $users = User::find()->joinWith(User::CREATED_TASKS)->all();
//        foreach ($users as $user){
//            echo VarDumper::dumpAsString($user, 5, true);
//        }
        $user = User::findOne(3);
        $task = Task::findOne(4);
        $user->link(User::ACCESSED_TASKS, $task);
    }

    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
