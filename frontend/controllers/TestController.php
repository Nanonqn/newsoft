<?php

namespace frontend\controllers;

use Yii;

class TestController extends \yii\web\Controller
{
    public function actionIndex()
    {
        Yii::$app->micomponente->blastOff();
    }

}
