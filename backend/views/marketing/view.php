<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\MarketingImage */

$this->title = $model->marketingImageName;
$this->params['breadcrumbs'][] = ['label' => 'Marketing Images', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="marketing-image-view">

    <p>
        <?= Html::a('Actualizar', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Eliminar', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <h1><?= Html::encode($model->marketingImageName) ?></h1>
    <br>
    <div>
        <?php

        echo Html::img('/'. $model->marketingImagePath . '?'. 'time='. time() , ['width' => '300px']);

        ?>

    </div>
    <br>
    <div>
        <?php

        echo Html::img('/'. $model->marketingThumbPath . '?'. 'time='. time());

        ?>

    </div>
    <br>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'marketingImageCaptionTitle',
            'marketingImageCaption',
            'marketingImagePath',
            'marketingThumbPath',
            //'marketing_image_name',
            ['attribute' => 'marketingImageIsFeatured', 'format' => 'boolean'],
            ['attribute' => 'marketingImageIsActive', 'format' => 'boolean'],
            'status.status_name',
            'created_at',
            'updated_at',
        ],
    ]) ?>

</div>