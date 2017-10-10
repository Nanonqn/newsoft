<?php

use yii\bootstrap\Modal;
use kartik\social\FacebookPlugin;
use yii\bootstrap\Collapse;
use yii\bootstrap\Alert;
use yii\helpers\Html;
use componentes\FaqWidget;
use componentes\CarouselWidget;

/* @var $this yii\web\View */

$this->title = 'Mi Aplicacion con Yii2 ';
?>
<div class="site-index">
	<div class="jumbotron">
		<?php
			if (Yii::$app->user->isGuest) {
				echo yii\authclient\widgets\AuthChoice::widget([
				        'baseAuthUrl' => ['site/auth'],
                        'popupMode' => false,
                ]);
			}
		?>
        <div>
            <?= CarouselWidget::widget(['settings' =>
                ['height' => '300px', 'width' => '600px','autoplay'=>true]])?>
        </div>
        <h1>Yii 2 Framework <i class="fa fa-plug"></i></h1><br>
        <?php // echo Html::img(Yii::$app->urlManagerBackend->baseUrl.'/uploads/Clan.png');?>
        <?php
		    if(!Yii::$app->user->isGuest){
		        echo '<p class="lead">Use this Yii 2 Template to start Projects.</p>';
            }else{
                echo '<h4>'. Html::a('<i class="fa fa-facebook"></i>Sign Up or Sign In',
                        ['auth', 'authclient' => 'facebook'],
                        ['class' => 'btn btn-primary ']).'</h4>';
            }
	    ?>
    </div>
	
	<?php
		echo Collapse::widget([
			'items' => [
				[
					'label' => 'Características Principales' ,
					'content' => FacebookPlugin::widget([
						'type'=>FacebookPlugin::SHARE,
						'settings' => ['href'=>'http://www.yii2build.com','width'=>'350']
					]),
				// open its content by default
				//'contentOptions' => ['class' => 'in']
				],
				// another group item
				[
					'label' => 'Recursos Principales',
					'content' => FacebookPlugin::widget([
						'type'=>FacebookPlugin::SHARE,
						'settings' => ['href'=>'http://www.yii2build.com','width'=>'350']
					]),
					// 'contentOptions' => [],
					// 'options' => [],
				],
			],
		]);
		Modal::begin([
			'header' => '<h2>�ltimos Comentarios</h2>',
			'toggleButton' => ['label' => 'comentarios'],
		]);
		echo FacebookPlugin::widget([
			'type'=>FacebookPlugin::COMMENT,
			'settings' => ['href'=>'http://www.yii2build.com','width'=>'350']
		]);
		Modal::end();
	?>
	<br/>
	
	<br/>
	<?Php
		echo Alert::widget([
			'options' => [
				'class' => 'alert-info',
			],
		'body' => 'Lance su proyecto como un cohete...',
		]);
	?>
	<div class="body-content">
		<div class="row">
			<div class="col-lg-4">
			<p>
			<?php
				if (!Yii::$app->user->isGuest) {
					echo Yii::$app->user->identity->username . ' est&aacute; haciendo cosas geniales.';
				}
			?>
			<p>
				Partiendo de esta plantilla de c�digo abierto y gratuita de Yii 2 ahorrar�
				mucho tiempo.
				Puede entregar proyectos al cliente r�pidamente, con mucho de c�digo ya
				disponible, para que pueda concentrarse en los asuntos complejos.
			</p>
			<p>
				<a class="btn btn-default" href="http://www.yiiframework.com/doc-2.0/guide-index.html">Documentaci�n de Yii &raquo;</a>
			</p>
				<?php
					echo FacebookPlugin::widget([
						'type'=>FacebookPlugin::LIKE,
						'settings' => []
					]);
				?>
			</div>
			<div class="col-lg-4">
				<h2>Ventajas</h2>
				<p>
					La facilidad de uso es una enorme ventaja. Hemos simplificado el RBAC y le hemos
					otorgado tipos de usuario Gratuito/Pago de manera predeterminada. Los plugins
					sociales son tan sencillos y r�pidos de instalar, �que los amar�!
				</p>
				<p>
					<a class="btn btn-default" href="http://www.yiiframework.com/forum/"> Foro de Yii &raquo;</a>
				</p>
				<?php
					echo FacebookPlugin::widget([
						'type'=>FacebookPlugin::COMMENT,
						'settings' => ['href'=>'http://www.yii2build.com','width'=>'350']
					]);
				?>
			</div>
			<div class="col-lg-4">
			<h2>Codifique R&aacute;pidamente, Codifique Correctamente!</h2>
			<p>
				Libere el poder del asombroso framework Yii 2 con esta plantilla mejorada.
				Con base en la plantilla avanzada de Yii 2, obtiene una implementaci�n de
				frontend y backend completa que presenta una IU rica para la
				administraci&oacute;n del backend.
			</p>
			<p>
				<a class="btn btn-default" href="http://www.yiiframework.com/extensions/"> Extensiones de Yii &raquo;</a>
			</p>
			</div>
		</div>
    </div>

    <?= FaqWidget::widget(['settings' => ['pageSize' => 3,
        'featuredOnly' => true]]) ?>
    </div>
</div>
