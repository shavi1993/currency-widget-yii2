<?php
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use app\widgets\CurrencyWidget\models\Currency;
use yii\helpers\Html;

$post = Yii::$app->request->post();

if (isset($post['convert'])) {
    $model = new Currency();
    $post = \Yii::$app->request->post();
    if ($model->load($post)) {
        $value = $model->convertPrice();
    }
}
?>



<div class="panel">

	<div class="panel-body">
	<?php

$form = ActiveForm::begin([
    'id' => 'currency-form'
]);
$model = new Currency();
?>
		<div class="row">
			<div class="col-md-3">
				<?= $form->field($model, 'from_currency')->dropDownList($model->getCountryOptions()) ?>
			</div>
			<div class="col-md-3">
				<?= $form->field($model, 'to_currency')->dropDownList($model->getCountryOptions()) ?>
			</div>
			<div class="col-md-2">
				<?= $form->field($model, 'amount')->textInput() ?>
			</div>
			<div class="col-md-2">
				<?= Html::submitButton('Convert',['class'=>'btn btn-primary','name'=>'convert']) ?>
			</div>
			<div class="col-md-2">
				<?= $form->field($model, 'final')->textInput(['value' => !empty($value) ? $value : '']) ?>
			</div>
		</div>
		<?php ActiveForm::end()?>
	</div>
</div>

