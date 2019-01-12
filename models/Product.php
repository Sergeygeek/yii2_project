<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 11.01.2019
 * Time: 22:33
 */

namespace app\models;


use yii\base\Model;

class Product extends Model
{
    public $id;
    public $name;
    public $category;
    public $price;
}