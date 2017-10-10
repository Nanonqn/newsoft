<?php
namespace common\models;

use yii;
use backend\models\Rol;
use backend\models\Estado;
use backend\models\Tipousuario;
use common\models\User;

class ValorHelpers
{
	/*
	 * rolCoincide - ve si el rol de los usuarios coincide con un rol espec�fico
	 */
	public static function rolCoincide($rolNombre)
	{
		$userTieneRolNombre = Yii::$app->user->identity->rol->nombreRol;
		return $userTieneRolNombre == $rolNombre ? true : false;
	}
	
	/*
	 * getUsersRolValor - encuentra el valor de un rol de usuario espec�fico
	 */
	public static function getUserRolValor($userId=null)
	{
		if($userId == null){
			$userRolValor = Yii::$app->user->identity->rol->valorRol;
			return isset($userRolValor) ? $userRolValor : false;
		}else{
			$user = User::findOne($userId);
			$userRolValor = $user->rol->valorRol;
			return isset($userRolValor) ? $userRolValor : false;
		}
	}
	
	/*
	 * getRolValor - encuentra el valor de un rol
	 */
	public static function getRolValor($rolNombre)
	{
		$rol = Rol::find('valorRol')->where(['nombreRol' => $rolNombre])->one();
		return isset($rol->valorRol) ? $rol->valorRol : false;
	}
	
	/*
	 * esRolNombreValido - confirma que tenemos un nombre de rol v�lido
	 */
	public static function esRolNombreValido($rolNombre)
	{
		$rol = Rol::find('nombreRol')->where(['nombreRol' => $rolNombre])->one();
		return isset($rol->nombreRol) ? true : false;
	}
	
	/*
	 * estadoCoincide - determina si el estado del usuario actual coincide con el estado deseado
	 */
	public static function estadoCoincide($estadoNombre)
	{
		$userTieneEstadoName = Yii::$app->user->identity->estado->nombreEstado;
		return $userTieneEstadoName == $estadoNombre ? true : false;
	}
	
	/*
	 * getEstadoId - retorna la id de estado basado en un nombre de estado ingresado.
	 */
	public static function getEstadoId($estadoNombre)
	{
		$estado = Estado::find('id')->where(['nombreEstado' => $estadoNombre])->one();
		return isset($estado->id) ? $estado->id : false;
	}
	
	/*
	 * tipoUsuarioCoincide - determina si el tipo usuario del usuario actual coincide con el tipo deseado
	 */
	public static function tipoUsuarioRolCoincide($tipoUsuarioNombre)
	{
		$userTieneTipoUsuario = Yii::$app->user->identity->tipoUsuario->nombreTipoUsuario;
		return $userTieneTipoUsuario == $tipoUsuarioNombre ? true : false;
	}
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
}