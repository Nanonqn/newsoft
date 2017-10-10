<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\FaqRatingSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Faq Ratings';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="faq-rating-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Faq Rating', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        ['attribute'=>'Rating', 'value' => function($model){
            return $model->getFaqRatings($model->id);
        }],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'user_id',
            'faq_id',
            'faq_rating',
            'created_at',
            // 'update_at',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
