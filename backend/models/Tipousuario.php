<?php

namespace backend\models;

use Yii;
use common\models\User;

/**
 * This is the model class for table "tipousuario".
 *
 * @property integer $id
 * @property string $nombreTipoUsuario
 * @property integer $valorTipoUsuario
 */
class Tipousuario extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tipousuario';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nombreTipoUsuario', 'valorTipoUsuario'], 'required'],
            [['valorTipoUsuario'], 'integer'],
            [['nombreTipoUsuario'], 'string', 'max' => 45],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nombreTipoUsuario' => 'Nombre Tipo Usuario',
            'valorTipoUsuario' => 'Valor Tipo Usuario',
        ];
    }
    
    public function getUsers()
    {
    	return $this->hasMany(User::className(), ['tipo_usuario_id' =>'id' ]);
    }
}
