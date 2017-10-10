<?php
namespace common\models;

use Yii;
use yii\base\NotSupportedException;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\db\Expression;
use yii\web\IdentityInterface;
use yii\helpers\Security;
use yii\helpers\Url;
use backend\models\Rol;
use backend\models\Estado;
use yii\helpers\ArrayHelper;
use backend\models\Tipousuario;
use frontend\models\Perfil;
use yii\helpers\Html;
/**
 * User model
 *
 * @property integer $id
 * @property string $username
 * @property string $passwordHash
 * @property string $passwordResetToken
 * @property string $email
 * @property string $authKey
 * @property integer $rol_id
 * @property integer $estado_id
 * @property integer $tipoUsuario_id
 * @property integer $created_at
 * @property integer $updated_at
 * @property string $password write-only password
 */
class User extends ActiveRecord implements IdentityInterface
{
    const ESTADO_ACTIVO = 1;

    public static function tableName()
    {
        return 'user';
    }

    /**
     * behaviors
     */
    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => 'yii\behaviors\TimestampBehavior',
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                ],
                'value' => new Expression('NOW()'),
            ],
        ];
    }

    /**
     * reglas de validación
     */
    public function rules()
    {
        return [
            ['estado_id', 'default', 'value' => self::ESTADO_ACTIVO],
        	[['estado_id'],'in', 'range' => array_keys($this->getEstadoLista())],
            ['rol_id', 'default', 'value' => 1],
        	[['rol_id'],'in','range' => array_keys($this->getRolLista())],
            ['tipoUsuario_id', 'default', 'value' => 1],
        	[['tipoUsuario_id'],'in', 'range'=>array_keys($this->getTipoUsuarioLista())],
            ['username', 'filter', 'filter' => 'trim'],
            ['username', 'required'],
            ['username', 'unique'],
            ['username', 'string', 'min' => 2, 'max' => 255],
            ['email', 'filter', 'filter' => 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'unique'],
        ];
    }

    /* Las etiquetas de los atributos de su modelo */
    public function attributeLabels()
    {
        return [
        /* Sus otras etiquetas de atributo */
        	
        	'rolNombre' => Yii::t('app', 'Rol'),
        	'estadoNombre' => Yii::t('app', 'Estado'),
        	'perfilId' => Yii::t('app', 'Perfil'),
        	'perfilLink' => Yii::t('app', 'Perfil'),
        	'userLink' => Yii::t('app', 'Usuario'),
        	'username' => Yii::t('app', 'Usuario'),
        	'tipoUsuarioNombre' => Yii::t('app', 'Tipo Usuario'),
        	'tipoUsuarioId' => Yii::t('app', 'Tipo Usuario'),
        	'userIdLink' => Yii::t('app', 'ID'),
        	'rol_id' => 'Rol',
        	'estado_id' => 'Estado',
        	'tipoUsuario_id' => 'Tipo Usuario',
        ];
    }

    /**
     * @findIdentity
     */
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id, 'estado_id' => self::ESTADO_ACTIVO]);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    /**
     * Encuentra usuario por username
     * dividida en dos líneas para evitar ajuste de línea * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username, 'estado_id' => self::ESTADO_ACTIVO]);
    }

    /**
     * Encuentra usuario por clave de restablecimiento de password
     *
     * @param string $token clave de restablecimiento de password
     * @return static|null
     */
    public static function findByPasswordResetToken($token)
    {
        if (!static::isPasswordResetTokenValid($token)) {
            return null;
        }
        return static::findOne([
            'passwordResetToken' => $token,
            'estado_id' => self::ESTADO_ACTIVO,
        ]);
    }

    /**
     * Determina si la clave de restablecimiento de password es válida
     *
     * @param string $token clave de restablecimiento de password
     * @return boolean
     */
    public static function isPasswordResetTokenValid($token)
    {
        if (empty($token)) {
            return false;
        }
        $expire = Yii::$app->params['user.passwordResetTokenExpire'];
        $parts = explode('_', $token);
        $timestamp = (int) end($parts);
        return $timestamp + $expire >= time();
    }

    /**
     * @getId
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * @getAuthKey
     */
    public function getAuthKey()
    {
        return $this->authKey;
    }

    /**
     * @validateAuthKey
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Valida password
     *
     * @param string $password password a validar
     * @return boolean si la password provista es válida para el usuario actual
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->passwordHash);
    }
    
    /**
     * Genera hash de password a partir de password y la establece en el modelo
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->passwordHash = Yii::$app->security->generatePasswordHash($password);
    }

    /**
     * Genera clave de autenticación "recuerdame"
     */
    public function generateAuthKey()
    {
        $this->authKey = Yii::$app->security->generateRandomString();
    }

    /**
     * Genera nueva clave de restablecimiento de password
     * dividida en dos líneas para evitar ajuste de línea
     */
    public function generatePasswordResetToken()
    {
        $this->passwordResetToken = Yii::$app->security->generateRandomString() . '_' . time();
    }

    /**
     * Remueve clave de restablecimiento de password
     */
    public function removePasswordResetToken()
    {
        $this->passwordResetToken = null;
    }
    /*
     *getPerfil 
     */
    public function getPerfil()
    {
    	return $this->hasOne(Perfil::className(), ['user_id' => 'id']);
    }
    
    /*
     * getPerfilId
     */
    public function getPerfilId()
    {
    	return $this->perfil ? $this->perfil->id : 'ninguno';
    }
    
    /*
     * getPerfilLink
     */
    public function getPerfilLink()
    {
    	$url = Url::to(['perfil/view', 'id' => $this->perfilId]);
    	$opciones = [];
    	return Html::a($this->perfil ? 'perfil' : 'ninguno', $url, $opciones);
    }
    
    /*
     * Relacion getRol
     */
    public function getRol()
    {
    	return $this->hasOne(Rol::className(), ['id' => 'rol_id']);
    }
    
    /*
     * getRolNombre()
     */
    public function getRolNombre()
    {
    	return $this->rol ? $this->rol->nombreRol : '-sin rol-';
    }
    
    /*
     * get lista de roles
     */
    public static function getRolLista()
    {
    	$dropciones = Rol::find()->asArray()->all();
    	return ArrayHelper::map($dropciones, 'id', 'nombreRol');
    }
    
    /*
     * Relacion getEstado
     */
    public function getEstado()
    {
    	return $this->hasOne(Estado::className(), ['id' => 'estado_id']);
    }
    
    /*
     * getEstadoNombre
     */
    public function getEstadoNombre()
    {
    	return $this->estado ? $this->estado->nombreEstado : '-sin estado-';
    }
    
    /*
     * get lista de estados
     */
    public static function getEstadoLista()
    {
    	$dropciones = Estado::find()->asArray()->all();
    	return ArrayHelper::map($dropciones, 'id', 'nombreEstado');
    }
    
    /*
     * get Tipo Usuario
     */
    public function getTipoUsuario()
    {
    	return $this->hasOne(Tipousuario::className(), ['id' => 'id']);
    }
    
    /**
     * get Tipo Usuario Nombre
     */
    public function getTipoUsuarioNombre()
    {
    	return $this->tipoUsuario ? $this->tipoUsuario->nombreTipoUsuario : '-sin tipo-';
    }
    
    /*
     * get Tipo Usuarios Lista
     */
    public static function getTipoUsuarioLista()
    {
    	$dropciones = Tipousuario::find()->asArray()->all();
    	return ArrayHelper::map($dropciones, 'id', 'nombreTipoUsuario');
    }
    
    /*
     * get TipoUsuarioId()
     */
    public function getTipoUsuarioId()
    {
    	return $this->tipoUsuario ? $this->tipoUsuario->id : '-ninguno-';
    }
    
    /*
     * getUserIdLink
     */
    public function getUserIdLink()
    {
    	$url = Url::to(['user/update', 'id'=> $this->id]);
    	$opciones = [];
    	return Html::a($this->id, $url, $opciones);
    }
    
    /*
     * getUserLink
     */
    public function getUserLink()
    {
    	$url = Url::to(['user/view','id' => $this->id]);
    	$opciones = [];
    	return Html::a($this->username, $url, $opciones);
    }
    
} 
