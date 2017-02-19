<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\MediodepagoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Mediodepagos';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mediodepago-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Mediodepago', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'nombreMP',
            'valorOPorcentaje',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
