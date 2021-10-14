<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ReceiversSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Получатели';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="receivers-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Добавить', ['create'], ['class' => 'btn btn-secondary']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'fullname',
            'is_active',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
