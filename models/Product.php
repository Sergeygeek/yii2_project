<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "product".
 *
 * @property int $id
 * @property string $name
 * @property string $price
 * @property int $created_at
 */
class Product extends \yii\db\ActiveRecord
{
    const SCENARIO_UPDATE = 'update';
    const SCENARIO_CREATE = 'create';
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'product';
    }

    public function scenarios()
    {
        return [
            self::SCENARIO_DEFAULT => ['name', 'price', 'created_at'],
            self::SCENARIO_CREATE => ['name', 'price'],
            self::SCENARIO_UPDATE => ['price'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
              ['name', 'string', 'max' => 20],
              ['name', 'filter', 'filter' => function($value){
                return trim(strip_tags($value));
              }],
              ['price', 'integer', 'min' => 0, 'max' => 1000]
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'price' => 'Price',
            'created_at' => 'Created At',
        ];
    }
}
