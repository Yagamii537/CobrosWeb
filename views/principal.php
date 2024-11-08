<?php include '../includes/header.php'; ?>

<div class="container">
    <h2>Bienvenido al Sistema</h2>
    <p>Aquí puedes acceder a los distintos módulos y funcionalidades del sistema.</p>


    <div class="row">

        <div class="col-md-6 col-sm-6">
            <div class="card text-center">
                <div class="card-body">
                    <i class="bi bi-people-fill display-4 text-primary"></i>
                    <h5 class="card-title">Clientes</h5>
                    <p class="card-text">Administra y gestiona los clientes del sistema.</p>
                    <a href="clientes/index.php" class="btn btn-primary">Aceptar</a>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-sm-6">
            <div class="card text-center">
                <div class="card-body">
                    <i class="bi bi-cash-coin display-4 text-primary"></i>
                    <h5 class="card-title">Pretamos</h5>
                    <p class="card-text">Consulta los prestamos del sistema.</p>
                    <a href="prestamos/index.php" class="btn btn-primary">Aceptar</a>
                </div>
            </div>
        </div>

    </div>
    <br>



    <center>

        <p class="text-center">

            Desarrollado por

            <span class="text-primary">Xerat Solutions</span>

        </p>

    </center>



</div>


<?php include '../includes/footer.php'; ?>