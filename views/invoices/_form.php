<?php

use yii\bootstrap4\Html;
use yii\bootstrap4\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Invoices */
/* @var $form yii\widgets\ActiveForm */
?>
<?php if(!empty($message)): ?>
    <span id="message"><?= $message ?></span>
<?php endif; ?>
<?php $form = ActiveForm::begin(); ?>

<?= $form->field($model, 'from_id')->dropDownList(\yii\helpers\ArrayHelper::map(\app\models\Places::getList(), 'id', 'name'), ['prompt' => '', 'id' => 'from']) ?>

<?= $form->field($model, 'to_id')->dropDownList(\yii\helpers\ArrayHelper::map(\app\models\Places::getList(), 'id', 'name'), ['prompt' => '', 'id' => 'to']) ?>

<?= $form->field($model, 'receiver_id')->dropDownList(\yii\helpers\ArrayHelper::map(\app\models\Receivers::getList(), 'id', 'fullname'), ['prompt' => '', 'id' => 'receiver']) ?>

<?= $form->field($model, 'status_id')->dropDownList(\yii\helpers\ArrayHelper::map(\app\models\Status::getList(), 'id', 'name'), ['id' => 'status']) ?>

<?= $form->field($model, 'id')->hiddenInput(['id' => 'invoice_id'])->label(false) ?>

<div class="form-group">
    <?= Html::button('Сохранить', ['class' => 'btn btn-secondary', 'id' => 'saveBtn', 'data-text' => $text, 'onClick' => 'f(this)']) ?>
    <?= Html::button('Отменить', ['class' => 'btn btn-warning ', 'data-dismiss' => 'modal']) ?>
</div>
<?php ActiveForm::end(); ?>


