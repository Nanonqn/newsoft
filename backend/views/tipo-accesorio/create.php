<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Tipoaccesorios */

$this->title = 'Crear Tipo:';
$this->params['breadcrumbs'][] = ['label' => 'Tipo Accesorios', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tipoaccesorios-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
