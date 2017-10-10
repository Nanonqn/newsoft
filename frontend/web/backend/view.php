<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\CarouselSettings */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Carousel Settings', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="carousel-settings-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'carousel_name',
            'image_height',
            'image_width',
            'carousel_autoplay',
            'show_indicators',
            'show_caption_title',
            'show_captions',
            'show_caption_background',
            'caption_font_size',
            'show_controls',
            'status_id',
            'created_at',
            'updated_at',
        ],
    ]) ?>

</div>
