<?php

?>

<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <div class="title">
                <h2>Detalles del contrato</h2>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">Empresa: <?= $empresa->nombre ?></h3>
                </div>

                <div class="panel-body">
                    <table class="table table-striped">
                        <tbody>
                            <tr>
                                <td>Usuario: <?= $usuario->nombres.' '.$usuario->apellidos ?></td>
                                <td>Correo: <?= $usuario->correo ?></td>
                            </tr>
                            <tr>
                                <td>Username: <?= $usuario->username ?></td>
                                <td>Base de datos: <?= $empresa->db_name ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
