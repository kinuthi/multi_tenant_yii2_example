<?php
/* @var $this yii\web\View */
$modulos = [];
if (!Yii::$app->user->isGuest)
    $modulos = Yii::$app->db->createCommand("SELECT * FROM config_modulos;")->query()->readAll();
$this->title = 'My Yii Application';
?>
<div class="site-index">

    <?php
    if (Yii::$app->user->isGuest) {
        ?>

        <div class="row">
            <hr>
            <h1>...</h1>
            <hr>
        </div>

        <?php
    } else {
        ?>
        <div class="">
            <!--               <pre>
            <?/*= var_dump(Yii::$app->user->identity) */
            ?>
        </pre>-->
            <div class="row">
                <hr>
                <h1 style="text-align: center;">Datos del usuario</h1>
                <hr>

                <table class="table table-striped table-hover ">
                    <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Empresa</th>
                        <th>BD</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td><?= Yii::$app->user->identity->nombres . ' ' . Yii::$app->user->identity->apellidos ?></td>
                        <td><?= \app\models\Empresa::findOne(['id_empresa' => Yii::$app->user->identity->id_empresa])->razon_social ?></td>
                        <td><?= \app\models\Empresa::findOne(['id_empresa' => Yii::$app->user->identity->id_empresa])->db_name ?></td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="body-content">

            <div class="row">
                <hr>
                <h1 style="text-align: center;">Módulos</h1>
                <hr>
            </div>
            <div class="row">
                <?php

                foreach ($modulos as $modulo) {
                    ?>
                    <div class="col-md-3">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <h3 class="panel-title"><?= $modulo['name'] ?></h3>
                            </div>
                            <div style="padding: 15px 0px 15px 0px; overflow: hidden;" class="panel-body">
                                <?= ($modulo['state'] == 1) ? '<span style="text-align: center; padding: 110px;" class="label label-success">Activado</span>' : '<span style="text-align: center; padding: 110px;" class="label label-danger">Desactivado</span>' ?>
                            </div>
                            <div class="panel-footer" style="overflow: hidden;">
                                <a href="index.php?r=<?= $modulo['name'] ?>" class="btn btn-info btn-sm pull-right">Ir
                                    al módulo <span class="glyphicon glyphicon-menu-right"></span></a>
                            </div>
                        </div>
                    </div>
                    <?php
                }
                ?>
            </div>

        </div>
        <?php
    }
    ?>

</div>
