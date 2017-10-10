<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\Marketingimage */

$this->title = 'Crear Imagen';
$this->params['breadcrumbs'][] = ['label' => 'Imagenes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="marketingimage-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
