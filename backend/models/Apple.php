<?php

namespace app\models;

use Yii;

class Apple extends \yii\db\ActiveRecord
{

    public static function tableName()
    {
        return 'apple';
    }
    public static function createApple() {
        $date = time();
        $color = rand(0,255) . ',' . rand(0,255) . ',' . rand(0,255);
        $query = Yii::$app->db->createCommand(" INSERT INTO `apple`
        (`id`,
        `status`,
        `color`,
        `appearance_date`,
        `fall_date`,
        `eat`,
        `size`)
        VALUES 
        (NULL,
        'status',
        '". $color ."',
        '". $date . "',
        '". $date . "',
        '0',
        '100')")->execute();
    }
    public static function eatApple($id){
        $model = Apple::findOne(['id' => $id]);
        $model->size = $model->size - 25;
        if($model->size == 0) {
            $model->delete();
        }else {
            $model->save();
        }
    }
}