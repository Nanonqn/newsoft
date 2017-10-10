<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "tcp_ip".
 *
 * @property string $id
 * @property string $ip
 * @property string $gateway
 * @property string $descripcion
 */
class TcpIp extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tcp_ip';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['ip', 'gateway', 'descripcion'], 'required'],
            [['descripcion'], 'string'],
            [['ip', 'gateway'], 'string', 'max' => 25],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'ip' => 'IP',
            'gateway' => 'Puerta Enlance',
            'descripcion' => 'Descripción',
        ];
    }
}
