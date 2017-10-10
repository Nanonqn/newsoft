<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Marcas */

$this->title = 'Actualizar Marca: ' . $model->marca;
$this->params['breadcrumbs'][] = ['label' => 'Marcas', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Actualizando...';
?>
<div class="marcas-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
