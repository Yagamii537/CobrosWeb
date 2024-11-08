<div class="modal fade" id="mmm<?php echo $fila['rrr']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="exampleModalLabel">Recibo Nº <?php echo  $fila['rrr']; ?></h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>


            </div>

            <div class="modal-body">
                <h3>Detalle Recibo</h3>
                <table class="table table-striped table-dark table_id">


                    <thead>
                        <tr>
                            <th>Cantidad</th>
                            <th>Detalle</th>
                            <th>Valor Unitario</th>
                            <th>Valo Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $id = $fila['rrr'];

                        $ccc = mysqli_connect("localhost", "root", "", "dbimagen");
                        $queryy = "SELECT d.cantidad,d.descripcion,d.valorUnitario
                                    FROM detalle d
                                    INNER JOIN recibo r
                                    on r.idRecibo=d.idRecibo
                                    where d.idRecibo=$id";



                        $detalle = mysqli_query($ccc, $queryy);

                        if ($detalle->num_rows > 0) {
                            while ($f = mysqli_fetch_array($detalle)) {

                        ?><tr>
                                    <td><?php echo $f['cantidad']; ?></td>
                                    <td><?php echo $f['descripcion']; ?></td>
                                    <td><?php echo $f['valorUnitario']; ?></td>
                                    <td><?php echo $f['cantidad'] * $f['valorUnitario']; ?></td>




                                </tr>



                            <?php
                            }
                        } else {

                            ?>
                            <tr class="text-center">
                                <td colspan="16">No existen registros</td>
                            </tr>


                        <?php

                        }

                        ?>


                    </tbody>
                </table>
                <hr class="border border-black border-1 opacity-100">


                <?php


                $ccc1 = "SELECT * FROM recibo WHERE idRecibo = $id";
                $queryy2 = mysqli_query($ccc, $ccc1);
                $reee = mysqli_fetch_assoc($queryy2);
                ?>

                <div class="form-group">
                    <label for="nombre" class="form-label text-dark">Nombre Cliente</label>
                    <input type="text" id="nombre" name="nombre" class="form-control" value="<?php echo $reee['nombreCli']; ?>" readonly>
                </div>
                <div class="form-group">
                    <label for="nombre" class="form-label text-dark">Valor</label>
                    <input type="text" id="nombre" name="nombre" class="form-control" value="<?php echo $reee['total']; ?>" readonly>
                </div>
                <div class="form-group">
                    <label for="nombre" class="form-label text-dark">Saldo</label>
                    <input type="text" id="nombre" name="nombre" class="form-control" value="<?php echo $reee['saldo']; ?>" readonly>
                </div>

                <div class="form-group">
                    <label for="nombre" class="form-label text-dark">Efectivo</label>
                    <input type="text" id="nombre" name="nombre" class="form-control" value="<?php echo $reee['efectivo']; ?>" readonly>
                </div>

                <div class="form-group">
                    <label for="nombre" class="form-label text-dark">Transferencia</label>
                    <input type="text" id="nombre" name="nombre" class="form-control" value="<?php echo $reee['transferencia']; ?>" readonly>
                </div>

                <hr class="border border-black border-1 opacity-100">
                <h3>Pagos</h3>

                <table class="table table-striped table-dark table_id">


                    <thead>
                        <tr>
                            <th>Fecha</th>
                            <th>Efectivo</th>
                            <th>Transferencia</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php



                        $queryy3 = "SELECT p.fecha,p.efectivo,p.transferencia
                                    FROM pagos p
                                    INNER JOIN recibo_pagos rp
                                    ON rp.idPagos=p.idPagos
                                    INNER JOIN recibo r
                                    ON r.idRecibo=rp.idRecibo
                                    WHERE r.idRecibo=$id";



                        $pagos = mysqli_query($ccc, $queryy3);

                        if ($pagos->num_rows > 0) {
                            while ($p = mysqli_fetch_array($pagos)) {

                        ?><tr>
                                    <td><?php echo $p['fecha']; ?></td>
                                    <td><?php echo $p['efectivo']; ?></td>
                                    <td><?php echo $p['transferencia']; ?></td>
                                </tr>
                            <?php
                            }
                        } else {

                            ?>
                            <tr class="text-center">
                                <td colspan="16">No existen registros</td>
                            </tr>


                        <?php

                        }

                        ?>


                    </tbody>
                </table>

            </div>
        </div>
    </div>
</div>