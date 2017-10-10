<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model backend\models\FaqCategory */

$this->title = 'Crear Categoria FAQ';
$this->params['breadcrumbs'][] = ['label' => 'Categorias FAQ', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="faq-category-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
