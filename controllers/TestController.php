<?php

namespace app\controllers;


use app\components\TestService;
use app\models\Product;
use yii\web\Controller;

class TestController extends Controller
{
    /**
     * @return string
     */

    public function actionIndex()
    {
        $product = new Product(['id' => 1, 'category' => 'игрушки','name' => 'Lego Friends','price' => 1590]);
        $service = \Yii::$app->test->launch();

        return $this->render('index', [
            'product' => $product,
            'service' => $service,
        ]);
    }
}