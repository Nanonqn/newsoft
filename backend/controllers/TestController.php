<?php

namespace backend\controllers;

use Yii;
use backend\models\Faq;
use backend\models\search\FaqSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\Pagination;

class TestController extends \yii\web\Controller
{

    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
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
        $query = Faq::find()->where(['faqIsFeatured'=>1]);
        $query->orderBy(['faqWeight'=>SORT_ASC]);
        $countQuery = clone $query;
        $pages = new Pagination(['defaultPageSieze'=>3, 'totalCount'=>$countQuery->count()]);
        $models = $query->offset($pages->offset)->limit($pages->limit)->all();

        return $this->render('index',[
            'models' => $models,
            'pages' => $pages
        ]);
    }

}
