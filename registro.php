<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body>
    <section class="content">
        <div class="container">
            <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-8">
                    <div class="card bg-danger text-center text-white">
                        <h3>Formulario de registro</h3>  
                    </div>
                    <form action="archivos/registrar.php" method="post">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-12">
                                    <br>
                                   <div class="form-group">
                                    <label for="nombre">Nombre</label>
                                    <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Inserta tu nombre" required>
                                   </div> 

                                   <div class="form-group">
                                    <label for="apellidos">Apellidos</label>
                                    <input type="text" class="form-control" name="apellidos" id="apellidos" placeholder="Inserta tus apellidos" required>
                                   </div> 

                                   <div class="form-group">
                                    <label for="fecha">Fecha de nacimiento</label>
                                    <input type="date" class="form-control" name="fecha" id="fecha" placeholder="Inserta tu segundo apellido" >
                                   </div> 

                                   <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="text" class="form-control" name="email" id="email" placeholder="Inserta tu email" >
                                   </div> 
                                </div>
                            </div>
                        </div>
                        <br>
                        <div class="card-footer text-center">
                            <button type="submit" class="btn btn-danger btn-lg">Registrar</button>
                        </div>
                    </form>
                </div>
                <div class="col-md-2"></div>
            </div>
        </div>
    </section>


    <form action="archivos/registrar.php" method="post">
        
        
    </form>
    <script src="js/bootstrap.min.js"></script>



</body>
</html>
