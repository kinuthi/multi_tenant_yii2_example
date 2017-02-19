<?php
/**
 * Created by PhpStorm.
 * User: Alink
 * Date: 10-02-2017
 * Time: 20:45
 */

use yii\bootstrap\Html;
?>

<div class="container">
    <div class="row">
        <hr>
        <h1 style="text-align: center">Planes</h1>
        <hr>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="col-md-4">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <h3 class="panel-title">Plan 1</h3>
                    </div>
                    <div class="panel-body">
                        <ul class="list-group">
                            <li class="list-group-item">
                                <span class="badge">2</span>
                                Número de usuarios
                            </li>
                            <li class="list-group-item">
                                <span class="badge">3</span>
                                Número de módulos
                            </li>
                            <li class="list-group-item">
                                <span class="badge">$5.000/mes</span>
                                Precio
                            </li>
                        </ul>
                    </div>
                    <div style="overflow: hidden; text-align: center;" class="panel-footer">
                        <?= Html::a('<span class="glyphicon glyphicon-menu-right"></span> Contratar', '?r=site/contratar&plan=1', ['class'=>'btn btn-info']) ?>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <h3 class="panel-title">Plan 2</h3>
                    </div>
                    <div class="panel-body">
                        <ul class="list-group">
                            <li class="list-group-item">
                                <span class="badge">3</span>
                                Número de usuarios
                            </li>
                            <li class="list-group-item">
                                <span class="badge">4</span>
                                Número de módulos
                            </li>
                            <li class="list-group-item">
                                <span class="badge">$10.000/mes</span>
                                Precio
                            </li>
                        </ul>
                    </div>
                    <div style="overflow: hidden; text-align: center;" class="panel-footer">
                        <?= Html::a('<span class="glyphicon glyphicon-menu-right"></span> Contratar', '?r=site/contratar&plan=2', ['class'=>'btn btn-info']) ?>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="panel panel-info">
                    <div class="panel-heading">
                        <h3 class="panel-title">Plan 3</h3>
                    </div>
                    <div class="panel-body">
                        <ul class="list-group">
                            <li class="list-group-item">
                                <span class="badge">4</span>
                                Número de usuarios
                            </li>
                            <li class="list-group-item">
                                <span class="badge">5</span>
                                Número de módulos
                            </li>
                            <li class="list-group-item">
                                <span class="badge">$15.000</span>
                                Precio
                            </li>
                        </ul>
                    </div>
                    <div style="overflow: hidden; text-align: center;" class="panel-footer">
                        <?= Html::a('<span class="glyphicon glyphicon-menu-right"></span> Contratar', '?r=site/contratar&plan=3', ['class'=>'btn btn-info']) ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


