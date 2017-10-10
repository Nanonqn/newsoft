<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Impresora */

$this->title = 'Crear Impresora';
$this->params['breadcrumbs'][] = ['label' => 'Impresoras', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="impresora-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
