<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Tipoaccesorios */

$this->title = 'Actualizar: ' . $model->accesorio;
$this->params['breadcrumbs'][] = ['label' => 'Tipo Accesorio', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Actualizando...';
?>
<div class="tipoaccesorios-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
