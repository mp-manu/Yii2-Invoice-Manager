<?php

use yii\bootstrap4\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\InvoicesSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Накладные';
$this->params['breadcrumbs'][] = $this->title;
?>
    <div class="invoices-index">

        <h1><?= Html::encode($this->title) ?></h1>

        <p>
            <?= Html::a('Создать накладную', ['#'], ['class' => 'btn btn-secondary actionBtn', 'data-text' => 'create']) ?>
        </p>

        <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,

            'columns' => [
                [
                    'class' => 'yii\grid\CheckboxColumn',
                    'checkboxOptions' => function ($model, $key, $index, $column) {
                        return ['value' => $model->id, 'id' => 'gridCheckbox'];
                    },
                ],
                [
                    'attribute' => 'from_id',
                    'value' => 'from.name'

                ],
                [
                    'attribute' => 'to_id',
                    'value' => 'to.name'

                ],
                [
                    'attribute' => 'receiver_id',
                    'value' => 'receiver.fullname'

                ],
                [
                    'attribute' => 'status_id',
                    'value' => 'status.name'

                ],
//            [
//                'attribute' => 'to_id',
//                'values' => function($model){
//                    return $model->to->name;
//                }
//
//            ],
//            [
//                'attribute' => 'receiver_id',
//                'values' => function($model){
//                    return $model->receiver->name;
//                }
//
//            ],
//            [
//                'attribute' => 'status_id',
//                'values' => function($model){
//                    return $model->status->name;
//                }
//
//            ],

                [
                    'class' => 'yii\grid\ActionColumn',
                    'header' => '',
                    'headerOptions' => ['style' => 'color:#337ab7;'],
                    'template' => '{update} | {delete}',
                    'buttons' => [
                        'update' => function ($url, $model) {
                            return Html::a('изменить', '#', [
                                'class' => 'actionBtn',
                                'data-text' => 'update',
                                'data-id' => $model->id,
                            ]);
                        },

                        'delete' => function ($url, $model) {
                            return Html::a('удалить', $url, [
                                'title'        => 'удалить',
                                'class' => 'deleteBtn',
                                'data-confirm' => 'Вы действительно хотите удалить этот элемент?',
                                'data-method'  => 'post',
                            ]);
                        },

                    ]
                ],
            ],
        ]); ?>
    </div>
<?= Html::beginForm('/invoices/change-status') ?>
    <div class="row">
        <div class="col-md-3 form-group">
            <?= Html::dropDownList('status', '1', \yii\helpers\ArrayHelper::map(\app\models\Status::getList(), 'id', 'name'), ['class' => 'form-control', 'id' => 'selectStatus']) ?>
            <?= Html::hiddenInput('selectedItems', '', ['class' => 'form-control', 'id' => 'selectedItems']) ?>
        </div>
        <div class="col-md-3">
            <?= Html::submitButton('Применить', ['class' => 'btn btn-warning', 'id' => 'actionBtn']) ?>
        </div>
    </div>
<?= Html::endForm() ?>

<?php \yii\bootstrap4\Modal::begin([
    "id"=>"crudModal",
]) ?>


<?php \yii\bootstrap4\Modal::end() ?>
