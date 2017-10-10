<?php

namespace backend\controllers;

use Yii;
use backend\models\FaqRating;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\models\Faq;
use yii\helpers\Html;
use yii\helpers\Url;

/**
 * FaqRatingController implements the CRUD actions for FaqRating model.
 */

class FaqRatingController extends Controller
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
     * Creates a new FaqRating model.
     * If creation is successful, the browser will be redirected to
     * the 'view' page.
     * @return mixed
     */
    public function actionRating()
    {
        if(Yii::$app->user->isGuest){

            return $this->redirect(['site/login']);
        }

        $model = new FaqRating();
        $model->user_id = (int) Yii::$app->user->identity->id;


        if ($model->load(Yii::$app->request->post())) {

            $existingRating = FaqRating::find()
                ->where(['user_id' => $model->user_id])
                ->andWhere(['faq_id' => $model->faq_id])
                ->one();

            if(isset($existingRating->id)){

                $existingRating->faq_rating = $model->faq_rating;

                $existingRating->update();



                $slug = Faq::find('slug')
                    ->where(['id' => $existingRating->faq_id])
                    ->one();

                Yii::$app->session->setFlash('success', 'Thank you for updating this Faq to '
                    .$existingRating->faq_rating.
                    ' stars.  Your result is factored into the average.');

                return $this->redirect(['faq/view', 'id' => $existingRating->faq_id,
                    'slug' => $slug->slug
                ]);

            } else {

                if($model->save()) {

                    $slug = Faq::find('slug')
                        ->where(['id' => $model->faq_id])
                        ->one();

                    Yii::$app->session->setFlash('success',
                        'Thank you for rating this Faq ' .$model->faq_rating.
                        ' stars. Your result is factored into the average.');

                    return $this->redirect(['faq/view',
                        'id' => $model->faq_id, 'slug' => $slug->slug
                    ]);

                }

            }


        } else {

            throw new NotFoundHttpException('There was a problem');

        }

    }

}