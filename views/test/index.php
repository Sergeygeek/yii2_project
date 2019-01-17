Тестовая вьюха
<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 11.01.2019
 * Time: 22:21
 */
/**
 * @var $product app\models\Product
 * @var $service app\components\TestService
 */
echo $service;
echo \yii\widgets\DetailView::widget(['model' => $product]);