<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Accesorios */

$this->title = 'Crear Accesorio';
$this->params['breadcrumbs'][] = ['label' => 'Accesorios', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="accesorios-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
