<?php

namespace frontend\models;

use Yii;

use yii\db\ActiveRecord;
use common\models\User;
use yii\helpers\Url;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\db\Expression;

/**
 * This is the model class for table "perfil".
 *
 * @property string $id
 * @property string $user_id
 * @property string $nombre
 * @property string $apellido
 * @property string $created_at
 * @property string $updated_at
 *
 * @property User $user
 */
class Perfil extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'perfil';
    }
    
    /*
     * behaviors to control time stamp, don't forget to use statement for expression 
     */
    
    
    public function behaviors()
    {
    	return[
    		'timestamp' => [
    			'class' => 'yii\behaviors\TimestampBehavior',
    			'attributes' => [
    					ActiveRecord::EVENT_BEFORE_INSERT => ['created_at','updated_at'],
    					ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
    			],
    			'value' => new Expression('NOW()'),
    		],
    	];
    }
    
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id'], 'required'],
            [['user_id'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['nombre', 'apellido'], 'string', 'max' => 100],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'nombre' => 'Nombre',
            'apellido' => 'Apellido',
            'created_at' => 'Creado',
            'updated_at' => 'Actualizado',
       		'userLink' => Yii::t('app', 'Usuario'),
       		'perfilIdLink' => Yii::t('app', 'Perfil'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
    
    /*
     * get User Name
     */
    public function getUsername()
    {
    	return $this->user->username;
    }
    
    /*
     * get User Id
     */
    public function getUserId()
    {
    	return $this->user ? $this->user->id : '-ninguno-';
    }
    
    /*
     * getUserLink
     */
    public function getUserLink()
    {
    	$url = Url::to(['user/view', 'id' => $this->getUserId()]);
    	$opciones = [];
    	return Html::a($this->getUsername(),$url,$opciones);
    }
    
    /*
     * getPerfilLink
     */
    public function getPerfilIdLink()
    {
    	$url = Url::to(['user/view', 'id' => $this->id]);
    	$opciones = [];
    	return Html::a($this->id, $url,$opciones);
    }
    
    public function beforeValidate()
    {
    	if ($this->created_at != null) {
    		$nuevo_formato_fecha = date('Y-m-d', strtotime($this->created_at));
    		$this->created_at = $nuevo_formato_fecha;
    	}
    	return parent::beforeValidate();
    }
}
