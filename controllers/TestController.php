<?php

namespace app\controllers;


use app\components\TestService;
use app\models\Product;
use yii\db\Query;
use yii\web\Controller;

class TestController extends Controller
{
    /**
     * @return string
     */

    public function actionIndex()
    {
        $product = new Product();
        $product->safeAttributes(
            ['id' => 11, 'name' => 'First', 'category' => 'car', 'price' => 123]
        );
        $service = \Yii::$app->test->launch();
        return $this->render('index', [
            'product' => $product,
            'service' => $service,
        ]);
    }

    public function actionInsert()
    {
//        \Yii::$app->db->createCommand()->batchInsert('user',
//            ['username', 'password_hash', 'creator_id', 'created_at'],
//            [
//                ['Serj', '12345', 1, 1548252061],
//                ['Olga', '000000', 2, 1548252061],
//                ['Sonya', '007', 3, 1548252061]
//            ])
//            ->execute();
//        \Yii::$app->db->createCommand()->batchInsert('task',
//            ['title', 'description', 'creator_id', 'created_at'],
//            [
//                ['Бег', 'Пробежать 10 км', 1, 1548266461],
//                ['Подтягивания', '5 подходов по 10 раз', 1, 1548266461],
//                ['Отжимания', '5 подходов по 15 раз', 1, 1548266461]
//            ])
//            ->execute();
    }
    public function actionSelect()
    {
        $query = new Query();
    //        $result = $query
    //            ->from('user')
    //            ->where(['id' => 1])
    //            ->all();
        //echo \yii\helpers\VarDumper::dumpAsString($result, 5, true);

//        $result2 = $query
//            ->from('user')
//            ->where(['<>', 'id', 1])
//            ->orderBy(['username' => SORT_DESC])
//            ->all();
        //echo \yii\helpers\VarDumper::dumpAsString($result2, 5, true);

//        $result3 = $query
//            ->from('user')
//            ->count();
//        echo \yii\helpers\VarDumper::dumpAsString($result3, 5, true);

        $result4 = $query
            ->from('task')
            ->innerJoin('user', 'task.creator_id = user.id')
            ->all();
        echo \yii\helpers\VarDumper::dumpAsString($result4, 5, true);
    }
}