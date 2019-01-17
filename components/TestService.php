<?php

namespace app\components;


use yii\base\Component;

class TestService extends Component
{
    public $attribute = 'def_attr';

    public function launch()
    {
        return $this->attribute;
    }
}