<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\TipoConectividad */

$this->title = 'Crear Tipo de Conectividad';
$this->params['breadcrumbs'][] = ['label' => 'Tipo de Conectividades', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tipo-conectividad-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
