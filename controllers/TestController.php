<?php

namespace app\controllers;


use app\models\Product;
use yii\web\Controller;

class TestController extends Controller
{
    /**
     * @return string
     */

    public function actionIndex()
    {
        $product = new Product();
        $product->id = 1;
        $product->category = 'игрушки';
        $product->name = 'Lego Friends';
        $product->price = 1590;
        //return $this->renderContent('Здравствуйте, это тестовая страница');
        return $this->render('index', [
            'product' => $product
        ]);
    }
}