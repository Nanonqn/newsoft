<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

use common\models\PermisosHelpers;

/* @var $this yii\web\View */
/* @var $model frontend\models\Perfil */

$this->title = $model->user->username;
$mostrarEsteNav = PermisosHelpers::requerirMinimoRol('SuperUsuario');
$this->params['breadcrumbs'][] = ['label' => 'Perfiles', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="perfil-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
    	<?php 
    		if(!Yii::$app->user->isGuest && $mostrarEsteNav){
				echo Html::a('Actualizar', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']);
    		}
    	?>
        <?php 
        if (!Yii::$app->user->isGuest && $mostrarEsteNav) {
			echo Html::a('Delete', ['delete', 'id' => $model->id], [
				'class' => 'btn btn-danger',
				'data' => [
					'confirm' => Yii::t('app', 'Are you sure you want to delete this item?'),
					'method' => 'post',
				],
			]);
        }
		?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
        	['attribute' => 'userLink', 'format'=>'raw'],
            //'id',
            'nombre',
            'apellido',
            'created_at',
            'updated_at',
        ],
    ]) ?>

</div>
