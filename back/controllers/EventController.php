<?php

namespace app\controllers;

use app\models\Event;
use yii;
use yii\rest\ActiveController;


class EventController extends ActiveController
{
    public $modelClass = 'app\models\Event';

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['corsFilter'] = [
                'class' => yii\filters\Cors::className(),
        ];
        return $behaviors;
    }
    public function actions(){
        $actions = parent::actions();
        unset($actions['index']);
        return $actions;
    }

    public function actionIndex(){
        $model = new $this->modelClass();
        $model->updateStatuses();
        $activeData = new yii\data\ActiveDataProvider([
            'query' => $model->find(),
            'pagination' => false,
        ]);
        return $activeData;
    }

}
