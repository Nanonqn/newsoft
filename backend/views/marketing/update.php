<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\MarketingImage */

$this->title = 'Actualizar Marketing Image: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Marketing Images', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Actualizando';
?>
<div class="marketing-image-update">

    <h1><?= Html::encode($this->title) ?></h1>
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

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>