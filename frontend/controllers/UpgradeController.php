<?php

namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\PermisosHelpers;
use common\models\RegistrosHelpers;
use frontend\models\Perfil;
use yii\filters\AccessControl;

class UpgradeController extends \yii\web\Controller
{
	public function behaviors()
	{
		return [
				'access' => [
					'class' => AccessControl::className(),
					'only' => ['index'],
					'rules' => [
							[
								'actions' => ['index'],
								'allow' => true,
								'roles' => ['@'],
								'matchCallback' => function ($rule, $action) {
									return PermisosHelpers::requerirEstado('Activo');
								}
							],
					],
				],
				'verbs' => [
					'class' => VerbFilter::className(),
					'actions' => [
						'delete' => ['post'],
					],
				],
		];
	}
	
	public function actionIndex()
	{
		$persona = Perfil::find()->where(['user_id' => Yii::$app->user->identity->id])->one();
		return $this->render('index',['persona' => $persona]);
	}
}
