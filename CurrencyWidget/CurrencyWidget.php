<?php
namespace app\widgets\CurrencyWidget;

use Yii;
use app\widgets\CurrencyWidget\assets\AppAsset;

class CurrencyWidget extends \yii\bootstrap\Widget
{

    public function init()
    {
        parent::run();
        AppAsset::register($this->view);
    }

    /**
     *
     * {@inheritdoc}
     */
    public function run()
    {
        return $this->render('currency/index');
    }
}
