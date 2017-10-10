<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Conectividad */

$this->title = 'Crear Conectividad';
$this->params['breadcrumbs'][] = ['label' => 'Conectividad', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="conectividad-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
