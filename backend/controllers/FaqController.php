<?php

namespace backend\controllers;

use Yii;
use backend\models\Faq;
use backend\models\search\FaqSearch;
use yii\behaviors\SluggableBehavior;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;
use yii\behaviors\BlameableBehavior;
use common\models\PermisosHelpers;

/**
 * FaqController implements the CRUD actions for Faq model.
 */
class FaqController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
        	'access' => [
        		'class' => \yii\filters\AccessControl::className(),
        		'only' => ['index', 'view','create', 'update', 'delete'],
        		'rules' => [
        				[
        					'actions' => ['index', 'view', 'create', 'update', 'delete'],
        					'allow' => true,
        					'roles' => ['@'],
        					'matchCallback' => function ($rule, $action) {
        						return PermisosHelpers::requerirRol('SuperUsuario') && PermisosHelpers::requerirEstado('Activo');
        					}
        				],
        		],
        	],
        	'timestamp' => [
        		'class' => TimestampBehavior::className(),
        		'attributes' => [
        			ActiveRecord::EVENT_BEFORE_INSERT => ['created_at','updated_at'],
        			ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
        		],
        		'value' => new Expression('NOW()'),
        	],
        	'blameable' => [
        		'class' => BlameableBehavior::className(),
        		'createdByAttribute' => 'created_by',
        		'updatedByAttribute' => 'updated_by',
        	],
            'sluggable' => [
                'class' => SluggableBehavior::className(),
                'attribute' => 'faqQuestion',
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
     * Lists all Faq models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new FaqSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Faq model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id, $slug=null)
    {
       $model = $this->findModel($id);
       if($slug == $model->slug){
           return $this->render('view',[
               'model' => $model,
               'slug' => $model->slug
           ]);
       }else{
           throw new NotFoundHttpException('La página solicitada no existe.');
       }
    }

    /**
     * Creates a new Faq model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Faq();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $url = Url::toRoute('faq/'.$model->id . '/' . $model->slug);
            return $this->redirect($url);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Faq model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $url = Url::toRoute('faq/'.$model->id . '/' . $model->slug);
            return $this->redirect($url);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Faq model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Faq model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Faq the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Faq::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
