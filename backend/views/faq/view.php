<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Faq */

$this->title = 'FAQ: '.$model->faqQuestion;
$this->params['breadcrumbs'][] = ['label' => 'FAQs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="faq-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Actualizar', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Eliminar', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Esta seguro que desea eliminar este item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'faqQuestion',
            'faqAnswer',
            'faqCategory.faqCategoryName',
        	'faqWeight',
            ['attribute' => 'faqIsFeatured','format'=>'boolean'],
        	['attribute' => 'createdByUsername','format'=>'raw'],
        	['attribute' => 'createdByUsername','format'=>'raw'],
            ['attribute'=>'Rating', 'format'=>'raw',
                'value' => $model->getFaqRatings($model->id)
            ],
            'created_at',
            'updated_at',
        ],
    ]) ?>

</div>
