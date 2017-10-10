<?php
namespace common\models;

use common\models\ValorHelpers;
use yii;
use yii\web\Controller;
use yii\helpers\Url;

class PermisosHelpers
{
	public static function requerirUpgrade($tipoUsuarioNombre)
	{
		if(!ValorHelpers::tipoUsuarioRolCoincide($tipoUsuarioNombre)){
			return Yii::$app->getResponse()->redirect(URL::to(['upgrade/index']));
		}
	}
	
	public static function requerirEstado($estadoNombre)
	{
		return ValorHelpers::estadoCoincide($estadoNombre);
	}
	
	public static function requerirRol($rolNombre)
	{
		return ValorHelpers::rolCoincide($rolNombre);
	}
	
	public static function requerirMinimoRol($rolNombre, $userId=null)
	{
		if(ValorHelpers::esRolNombreValido($rolNombre)){
			if($userId == null){
				$userRolValor = ValorHelpers::getUserRolValor();
			}else{
				$userRolValor = ValorHelpers::getUserRolValor($userId);
			}
			return $userRolValor >= ValorHelpers::getRolValor($rolNombre) ? true : false;
		}else{
			return false;
		}
	}
	
	public static function userDebeSerPropietario($modeloNombre, $modeloId)
	{
		$conexion = \Yii::$app->db;
		$userId = Yii::$app->user->identity->id;
		$sql = "SELECT id FROM $modeloNombre WHERE user_id=:userId AND id=:model_id";
		$comando = $conexion->createCommand($sql);
		$comando->bindValue(":userId", $userId);
		$comando->bindValue(":model_id", $modeloId);
		if($result = $comando->queryOne()){
			return true;
		}else{
			return false;
		}
	}
}