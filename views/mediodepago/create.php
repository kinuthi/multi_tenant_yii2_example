<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Mediodepago */

$this->title = 'Create Mediodepago';
$this->params['breadcrumbs'][] = ['label' => 'Mediodepagos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mediodepago-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
