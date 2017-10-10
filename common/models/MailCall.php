<?php
namespace common\models;

use yii;

class MailCall
{
	public static function enviarMail($mensajeId)
	{
		return Yii::$app->mailer->compose()
			->setTo(\Yii::$app->user->identity->email)
			->setFrom(['no-reply@yii2framework.com'=>'Yii 2 Framework'])
			->setSubject(RegistrosHelpers::obtenerAsuntoMensaje($mensajeId))
			->setTextBody(RegistrosHelpers::obtenerCuerpoMensaje($mensajeId))
			->send();
	}
	
	public static function onMailableAction($accionNombre, $controladorNombre)
	{
		if ($mensajeId = RegistrosHelpers::encontrarEstadoMensaje
				($accionNombre, $controladorNombre)){
					static::enviarMail($mensajeId);
		}
	}
}