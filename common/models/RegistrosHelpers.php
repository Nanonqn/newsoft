<?php
namespace common\models;

use yii;
use backend\models\Estadomensaje;

class RegistrosHelpers
{
	public static function userTiene($modeloNombre)
	{
		$conexion = \Yii::$app->db;
		$userId = Yii::$app->user->identity->id;
		$sql = "SELECT id FROM $modeloNombre WHERE user_id=:userId";
		$comando = $conexion->createCommand($sql);
		$comando->bindValue(":userId", $userId);
		$resultado = $comando->queryOne();
		if($resultado == null){
			return false;
		}else{
			return $resultado['id'];
		}
	}
	
	public static function encontrarEstadoMensaje($accionNombre,$controladorNombre){
		$resultado = Estadomensaje::find('id')->where(
				['accionNombre' => $accionNombre])->andWhere(
						['controladorNombre' => $controladorNombre])->one();
		return isset($resultado['id']) ? $resultado['id'] : false;
	}
	
	public static function obtenerAsuntoMensaje($id){
		$resultado = Estadomensaje::find('asunto')->where(['id' => $id])->one();
		return isset($resultado['asunto']) ? $resultado['asunto'] : false;
	}
	
	public static function obtenerCuerpoMensaje($id){
		$resultado = Estadomensaje::find('cuerpo')->where(['id' => $id])->one();
		return isset($resultado['cuerpo']) ? $resultado['cuerpo'] : false;
	}
}