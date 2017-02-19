<?php

$planes = [
    '1' => [
        'nombre' => 'Plan 1',
        'precio' => '$5.000',
        'n_usuarios' => 2,
        'n_modulos' => 3
    ],
    '2' => [
        'nombre' => 'Plan 2',
        'precio' => '$10.000',
        'n_usuarios' => 3,
        'n_modulos' => 4
    ],
    '3' => [
        'nombre' => 'Plan 1',
        'precio' => '$15.000',
        'n_usuarios' => 4,
        'n_modulos' => 5
    ]
];


?>


<div class="container">
    <div class="row">
        <hr>
        <h1>Contratar plan <?= $planes[$plan]['nombre'] ?></h1>
        <hr>
        <div class="panel panel-info">
            <div class="panel-heading">
                <h3 class="panel-title">Panel info</h3>
            </div>
            <div class="panel-body">
                <div class="col-md-4">
                    <legend>Precio : <?= $planes[$plan]['precio'] ?>/mes</legend>
                </div>
                <div class="col-md-4">
                    <legend>Usuarios : <?= $planes[$plan]['n_usuarios'] ?></legend>
                </div>
                <div class="col-md-4">
                    <legend>Módulos : <?= $planes[$plan]['n_modulos'] ?></legend>
                </div>

            </div>
        </div>
    </div>
    <form method="post" class="form-horizontal">
        <input type="hidden" name="_csrf" value="<?=Yii::$app->request->getCsrfToken()?>" />
        <div class="row">
            <hr>
            <h2>Elija los módulos (máximo <?= $planes[$plan]['n_modulos'] ?>)</h2>
            <hr>

            <?php

            foreach ($modulos as $modulo) {
                ?>
                <div class="col-md-6">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <?= $modulo->nombre ?>
                            <div class="pull-right">
                                <label>
                                    <input onclick="seleccionados(this, '<?= $planes[$plan]['n_modulos'] ?>')"
                                          name="modulos_contratados[<?= $modulo->nombre  ?>]"  type="checkbox"> Contratar
                                </label>
                            </div>
                        </div>
                        <div class="panel-body">
                            <?= $modulo->descripcion ?>
                        </div>
                    </div>
                </div>
                <?php
            }
            ?>

        </div>

        <div class="row">
            <hr>
            <h2>Datos de la empresa</h2>
            <hr>

            <div class="row">

                <fieldset>
                    <div class="form-group">
                        <label for="nombre_empresa" class="col-lg-2 control-label">Nombre de la empresa</label>
                        <div class="col-lg-4">
                            <input type="text" class="form-control" id="nombre_empresa" name="nombre_empresa"
                                   placeholder="Nombre">
                        </div>
                        <label for="rut_empresa" class="col-lg-2 control-label">RUT</label>
                        <div class="col-lg-4">
                            <input type="text" class="form-control" id="rut_empresa" name="rut_empresa"
                                   placeholder="RUT">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="giro_empresa" class="col-lg-2 control-label">Giro</label>
                        <div class="col-lg-4">
                            <input type="text" class="form-control" id="giro_empresa" name="giro_empresa"
                                   placeholder="Giro">
                        </div>
                        <label for="rs_empresa" class="col-lg-2 control-label">Razón Social</label>
                        <div class="col-lg-4">
                            <input type="text" class="form-control" id="rs_empresa" name="rs_empresa"
                                   placeholder="Razón Social">
                        </div>
                    </div>

                    <h3>Datos de contacto</h3>
                    <hr>
                    <div class="form-group">
                        <label for="representante_empresa" class="col-lg-2 control-label">Nombre de
                            representante</label>
                        <div class="col-lg-4">
                            <input type="text" class="form-control" id="representante_empresa"
                                   name="representante_empresa" placeholder="Nombre">
                        </div>
                        <label for="correo_empresa" class="col-lg-2 control-label">Correo de contacto</label>
                        <div class="col-lg-4">
                            <input type="text" class="form-control" id="correo_empresa" name="correo_empresa"
                                   placeholder="Correo">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="numero_empresa" class="col-lg-2 control-label">Número de contacto</label>
                        <div class="col-lg-4">
                            <input type="text" class="form-control" id="numero_empresa" name="numero_empresa"
                                   placeholder="Número de contacto">
                        </div>
                    </div>


            </div>
        </div>

        <div class="row">
            <hr>
            <h2>Usuario</h2>
            <hr>

            <div class="form-group">
                <label for="rut_usuario" class="col-lg-2 control-label">RUT</label>
                <div class="col-lg-4">
                    <input type="text" class="form-control" id="rut_usuario" name="rut_usuario"
                           placeholder="RUT">
                </div>

                <label for="nombre_usuario" class="col-lg-2 control-label">Nombre Completo</label>
                <div class="col-lg-4">
                    <input type="text" class="form-control" id="nombre_usuario" name="nombre_usuario"
                           placeholder="Nombre">
                </div>
            </div>

            <div class="form-group">
                <label for="nick_usuario" class="col-lg-2 control-label">Alias</label>
                <div class="col-lg-4">
                    <input type="text" class="form-control" id="nick_usuario" name="nick_usuario"
                           placeholder="Alias">
                </div>

                <label for="correo_usuario" class="col-lg-2 control-label">Correo</label>
                <div class="col-lg-4">
                    <input type="text" class="form-control" id="correo_usuario" name="correo_usuario"
                           placeholder="Correo">
                </div>
            </div>

            <div class="form-group">
                <label for="password_usuario" class="col-lg-2 control-label">Contraseña</label>
                <div class="col-lg-4">
                    <input type="password" class="form-control" id="password_usuario" name="password_usuario"
                           placeholder="Contraseña">
                </div>

                <label for="password_confirm_usuario" class="col-lg-2 control-label">Repetir contraseña</label>
                <div class="col-lg-4">
                    <input type="password" class="form-control" id="password_confirm_usuario" name="password_confirm_usuario"
                           placeholder="Contraseña">
                </div>
            </div>

            <div class="form-group">
                <div style="text-align: center;">
                    <button type="submit" class="btn btn-lg btn-primary"><span class="glyphicon glyphicon-menu-right"></span> Contratar</button>
                </div>
            </div>
            </fieldset>
        </div>
    </form>

    <!--<div class="row">
        <hr>
        <h2>Usuarios</h2>
        <hr>
    </div>-->
</div>

<script>
    var contador = 0;

    function seleccionados(box, num_max) {
        if (box.checked) {
            if (contador < num_max) {
                contador += 1;
            } else {
                alert('No puede seleccionar mas de ' + num_max + ' módulos');
                box.checked = false;
            }
        } else {
            contador -= 1;
        }
    }
</script>
