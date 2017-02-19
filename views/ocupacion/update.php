<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Ocupacion */

$this->title = 'Update Ocupacion: ' . $model->id_ocupacion;
$this->params['breadcrumbs'][] = ['label' => 'Ocupacions', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_ocupacion, 'url' => ['view', 'id' => $model->id_ocupacion]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="ocupacion-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
