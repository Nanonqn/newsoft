<?php

namespace backend\models;

use Yii;
use common\models\User;

/**
 * This is the model class for table "rol".
 *
 * @property integer $id
 * @property string $nombreRol
 * @property integer $valorRol
 */
class Rol extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'rol';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['nombreRol', 'valorRol'], 'required'],
            [['valorRol'], 'integer'],
            [['nombreRol'], 'string', 'max' => 45],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nombreRol' => 'Nombre Rol',
            'valorRol' => 'Valor Rol',
        ];
    }
    
    public function getUsers()
    {
    	return $this->hasMany(User::className(), ['rol_id' =>'id' ]);
    }
}
