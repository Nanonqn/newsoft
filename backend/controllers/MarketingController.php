<?php

namespace backend\controllers;

use Yii;
use backend\models\Marketingimage;
use backend\models\search\MarketingimageSearch;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\ForbiddenHttpException;
use yii\filters\VerbFilter;
use common\models\PermisosHelpers;
use yii\web\UploadedFile;
use yii\imagine\Image;


/**
 * MarketingController implements the CRUD actions for Marketingimage model.
 */
class MarketingController extends Controller
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
                'rules'=>[
                    [
                        'actions' => ['index','view','create','update','delete'],
                        'allow' => true,
                        'roles' => ['@'],
                        'matchCallback' => function ($rule,$action){
                            return PermisosHelpers::requerirRol('SuperUsuario') && PermisosHelpers::requerirEstado('Activo');
                        }
                    ]
                ]
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
     * Lists all Marketingimage models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new MarketingimageSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Marketingimage model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Marketingimage model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Marketingimage();

        $model->scenario = 'create';

        if($model->load(Yii::$app->request->post())){

            $imageName = $model->marketingImageName;

            $model->file = UploadedFile::getInstance($model,'file');

            $fileName = 'uploads/' . $imageName . '.' . $model->file->extension;
            $fileName = preg_replace('/\s+/', '',$fileName);

            $thumbName = 'uploads/' . 'thumbnail/' . $imageName . 'thumb.' . $model->file->extension;
            $thumbName = preg_replace('/\s+/', '', $thumbName);

            $model->marketingImagePath = $fileName;
            $model->marketingThumbPath = $thumbName;

            $model->save();
            $model->file->saveAs($fileName);

            Image::thumbnail($fileName, 60, 60)->save($thumbName,['quality'=>50]);

            return $this->redirect(['view','id' => $model->id,'model' => $model]);
        }else{
            return $this->render('create',[
                'model' => $model,
            ]);
        }

    }

    /**
     * Updates an existing Marketingimage model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if($model->load(Yii::$app->request->post())){

            $imageName = $model->marketingImageName;

            $oldImage = Marketingimage::find('marketingImageName')->where(['id'=>$id])->one();

            if($oldImage->marketingImageName != $imageName){
                throw new ForbiddenHttpException('No puedes cambiar el nombre, debe eliminarlo');
            }
            if($model->file = UploadedFile::getInstance($model,'file')){
                $thumbName = 'uploads/' . 'thumbnail/' . $imageName . 'thumb.'. $model->file->extension;
                $model->save();
            }else{
                $model->save();
            }
            if($model->file){
                $fileName = 'uploads/' . $imageName . '.' . $model->file->extension;
                $model->file->saveAs($fileName);
                Image::thumbnail( $fileName , 60, 60)->save($thumbName, ['quality' => 50]);
            }

            return $this->redirect(['view','id' => $model->id]);
        }else{
            return $this->render('update',['model'=>$model]);
        }
    }

    /**
     * Deletes an existing Marketingimage model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);

        try{
            unlink($model->marketingImagePath);
            unlink($model->marketingThumbPath);
            $model->delete();
            return $this->redirect(['index']);
        }
        catch (\Exception $e){
            throw new NotFoundHttpException($e->getMessage());
        }
    }

    /**
     * Finds the Marketingimage model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Marketingimage the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Marketingimage::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
