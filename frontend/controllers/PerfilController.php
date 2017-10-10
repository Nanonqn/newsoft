<?php

namespace frontend\controllers;

use Yii;
use frontend\models\Perfil;
use frontend\models\search\PerfilSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;


use common\models\PermisosHelpers;
use common\models\RegistrosHelpers;
use yii\filters\AccessControl;
/**
 * PerfilController implements the CRUD actions for Perfil model.
 */
class PerfilController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
        	'access' => [
        		'class' => AccessControl::className(),
        		'only' => ['index','view','create','update','delete'],
        		'rules' => [
        			[
	        			'actions' => ['index','view','create','update','delete'],
	        			'allow' => true,
	        			'roles' => ['@']
        			],
        		],
        	],
        	'acces2' => [
        		'class' => \yii\filters\AccessControl::className(),
        		'only' => ['index', 'view','create', 'update', 'delete'],
        		'rules' => [
        				[
        					'actions' => ['index', 'view','create', 'update', 'delete'],
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
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Perfil models.
     * Este está pensado para devolver una lista de resultados y usa un modelo diferente, PerfieSearch, que
     * extiende el modelo perfil para proveer de funcionalidad de búsqueda. Pero en el caso del perfil de
     * usuario, sólo permitimos un perfil por usuario, así que no usaremos este código.
     * @return mixed
     */
//     public function actionIndex()
//     {
//         $searchModel = new PerfilSearch();
//         $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

//         return $this->render('index', [
//             'searchModel' => $searchModel,
//             'dataProvider' => $dataProvider,
//         ]);
//     }

    public function actionIndex()
    {
    	if($yaExiste = RegistrosHelpers::userTiene('perfil')){
    		return $this->render('view',['model' => $this->findModel($yaExiste)]);
    	} else {
    		return $this->redirect(['create']);
    	}
    }

    /**
     * Displays a single Perfil model.
     * @param string $id
     * @return mixed
     */
//     public function actionView($id)
//     {
//         return $this->render('view', [
//             'model' => $this->findModel($id),
//         ]);
//     }

    public function actionView()
    {
    	if($yaExiste = RegistrosHelpers::userTiene('perfil')){
    		return $this->render('view',['model' => $this->findModel($yaExiste)]);
    	}else{
    		return $this->redirect(['create']);
    	}
    }
    /**
     * Creates a new Perfil model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * Básicamente esto dice si el formulario es cargado, salvarlo e ir a la vista o mostrar el formulario de creación.
     * @return mixed
     */
//     public function actionCreate()
//     {
//         $model = new Perfil();

//         if ($model->load(Yii::$app->request->post()) && $model->save()) {
//             return $this->redirect(['view', 'id' => $model->id]);
//         } else {
//             return $this->render('create', [
//                 'model' => $model,
//             ]);
//         }
//     }

    public function actionCreate()
    {
    	$model = new Perfil; //Comenzamos llamando una nueva instancia del modelo,
    	
    	$model->user_id = Yii::$app->user->identity->id; //asignamos al atributo user_id del modelo el usuario actual
    	
    	//Luego comprobamos si el usuario ya tiene un perfil
    	if($yaExiste = RegistrosHelpers::userTiene('perfil')){
    		//Si obtenemos una id de modelo como respuesta, mostramos el archivo de vista con esa id.
    		return $this->render('view',['model' => $this->findModel($yaExiste)]); 
    	//Si $ya_existe evalúa a falso, la siguiente que hace el código es llamar al método load sobre los datos enviados e intentar guardarlo:
    	}elseif ($model->load(Yii::$app->request->post()) && $model->save()){ 
    		return $this->redirect(['view']);
   		//Finalmente, si no hay datos enviados o si hay errores de validación mostramos el formulario:
    	}else{
    		return $this->render('create',['model' => $model]);
    	}
    }

    /**
     * Updates an existing Perfil model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
//     public function actionUpdate($id)
//     {
//         $model = $this->findModel($id);

//         if ($model->load(Yii::$app->request->post()) && $model->save()) {
//             return $this->redirect(['view', 'id' => $model->id]);
//         } else {
//             return $this->render('update', [
//                 'model' => $model,
//             ]);
//         }
//     }

    public function actionUpdate()
    {
    	PermisosHelpers::requerirUpgrade('Pago');
    	if($model = Perfil::find()->where(['user_id' => Yii::$app->user->identity->id])->one()){
    		if($model->load(Yii::$app->request->post()) && $model->save()){
    			return $this->redirect(['view']);
    		}else{
    			return $this->render('update',['model' => $model]);
    		}
    	}else{
    		throw new NotFoundHttpException('No Existe el Perfil');
    	}
    }

    /**
     * Deletes an existing Perfil model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
//     public function actionDelete($id)
//     {
//         $this->findModel($id)->delete();

//         return $this->redirect(['index']);
//     }

    public function actionDelete()
    {
    	$model = Perfil::find()->where(['user_id' => Yii::$app->user->identity->id])->one();
    	
    	$this->findModel($model->id)->delete();
    	
    	return $this->redirect(['site/index']);
    }
    /**
     * Finds the Perfil model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Perfil the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Perfil::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
