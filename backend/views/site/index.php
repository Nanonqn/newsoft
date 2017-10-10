<?php
use yii\helpers\Html;
use common\models\PermisosHelpers;

use yii\bootstrap\Modal;

/**
*@var yii\web\View $this
*/

$this->title = 'Admin Yii 2 Framework';
$esAdmin = PermisosHelpers::requerirMinimoRol('Administrador');
?>

<div class = "site-index">
	<div class = "jumbotron">


        <?php
            if(!Yii::$app->user->isGuest && $esAdmin){
                Modal::begin([
                    'class' => 'modal-body',
                    'header' => '<h2>BIENVENIDO '. Yii::$app->user->identity->username .' al panel de Administrador</h2>',
                    'toggleButton' => ['label' => 'Bienvenido','class' => 'btn btn-primary btn-sm'],
                    'size' => 'modal-lg',

                ]);

                echo 'Aqui puede realizar cualquier modificacion con respecto a usuarios, roles, perfiles y mucho más.';

                Modal::end();
            } else {
                Modal::begin([
                    'header' => '<h2>' . Yii::$app->user->identity->username . ' necesita un upgrade</h2>',
                    'toggleButton' => [
                            'label' =>" " . Yii::$app->user->identity->username . " ingrese aqui",
                            'class' => 'btn btn-warning',
                    ],
                    'class' => 'modal-body'
                ]);

                echo '<h4>Contactese con nosotros</h4>'. Html::a('Contacto',['site/contact'],['class'=>'btn btn-default']);

                Modal::end();
            }
        ?>


	</div>
	<div class="body-content">
		<div class="row">
			<div class="col-lg-4">
				<p>
					<?php 
						if(!Yii::$app->user->isGuest && $esAdmin){
							echo Html::a('Administrar Usuarios',['user/index'],['class' => 'btn btn-primary btn-lg btn-block']);
						}
					?>
				</p>
			</div>
			<div class="col-lg-4">
				<p>
					<?php 
						if(!Yii::$app->user->isGuest && $esAdmin){
							echo Html::a('Administrar Roles',['rol/index'],['class'=>'btn btn-primary btn-lg btn-block']);
						}
					?>
				</p>
			</div>
			<div class="col-lg-4">
				<p>
					<?php 
						if(!Yii::$app->user->isGuest && $esAdmin){
							echo Html::a('Administrar Perfiles',['perfil/index'],['class'=>'btn btn-primary btn-lg btn-block']);
						}
					?>
				</p>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-4">
				<p>
					<?php 
						if(!Yii::$app->user->isGuest && $esAdmin){
							echo Html::a('Administrar Tipo de Usuarios',['tipo-usuario/index'],['class'=>'btn btn-info btn-lg btn-block']);
						}
					?>
				</p>
			</div>
			<div class="col-lg-4">
				<p>
					<?php 
						if(!Yii::$app->user->isGuest && $esAdmin){
							echo Html::a('Administrar Estados',['estado/index'],['class'=>'btn btn-info btn-lg btn-block']);
						}
					?>
				</p>
			</div>
        </div>
        <div class="row">
            <div class="col-lg-4">
                <p>
                    <?php
                    if(!Yii::$app->user->isGuest && $esAdmin){
                        echo Html::a('Administrar Equipos',['equipos/index'],['class'=>'btn btn-success  btn-lg btn-block']);
                    }
                    ?>
                </p>
            </div>
            <div class="col-lg-4">
                <p>
                    <?php
                        if(!Yii::$app->user->isGuest && $esAdmin) {
                            echo Html::a('Administrar Monitores', ['monitores/index'], ['class' => 'btn btn-success btn-lg btn-block']);
                        }
                    ?>
                </p>
            </div>
            <div class="col-lg-4">
                <p>
                    <?php
                        if(!Yii::$app->user->isGuest && $esAdmin){
                            echo Html::a('Administrar Impresoras',['impresora/index'], ['class' => 'btn btn-success btn-lg btn-block']);
                        }
                    ?>
                </p>
            </div>
            <div class="col-lg-4">
                <p>
                    <?php
                        if(!Yii::$app->user->isGuest && $esAdmin){
                            echo HTML::a('Administrar Conexiones',['conectividad/index'],['class'=>'btn btn-warning btn-lg btn-block']);
                        }
                    ?>
                </p>
            </div>
		</div>
	</div>
</div>
