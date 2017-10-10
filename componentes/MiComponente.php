<?php
namespace componentes;

use Yii;
use yii\base\Component;
use yii\base\InvalidConfigException;

class MiComponente extends Component
{
	public function blastOff()
	{
		echo "HOUSTON, tenemos ignicion...";
	}
}