<?php
namespace frontend\controllers;
use yii;
class TestController extends \yii\web\Controller
{
	public function actionIndex()
	{
		Yii::$app->micomponente->blastOff();
	}
}