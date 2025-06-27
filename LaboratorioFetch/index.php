<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>CRUD con estilo pastel</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"/>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@1,300&display=swap" rel="stylesheet"/>
  <style>
    * {
      box-sizing: border-box;
    }

    body, html {
      margin: 0;
      padding: 0;
      height: 100%;
      font-family: 'Poppins', cursive;
      font-style: italic;
    }

  
    #bg-video {
        position: fixed;
        top: 0;
        left: 0;
        width: 100vw;
        height: 100vh;
        object-fit: cover; 
        z-index: -1;
    }

    .container {
      padding-top: 40px;
    }

    .card {
      background-color: rgba(255, 255, 255, 0.55);;
      border: 2px solid #C19ADE;
      box-shadow: 0 8px 16px rgba(0, 0, 0, 0.15);
      backdrop-filter: blur(6px);
    }

    .card-header {
      background-color: #C19ADE;
      color: white;
    }

    .btn-primary {
      background-color: #6FCFEB;
      border: none;
    }

    .btn-primary:hover {
      background-color: #99E6D8;
    }

    .btn-success, .btn-danger {
      background-color: #F3B2DB;
      border: none;
      color: white;
    }

    .btn-success:hover, .btn-danger:hover {
      background-color: #FEAEBB;
    }

    .thead-dark {
      background-color: #99E6D8;
      color: #333;
    }

    .form-control {
      border: 1px solid #F3EFA1;
    }

    h3, label {
      font-weight: 400;
    }
    .tabla-container {
      background-color:  rgba(255, 255, 255, 0.55); /* blanco translúcido */
      border: 2px solid #99E6D8;
      border-radius: 8px;
      padding: 15px;
      backdrop-filter: blur(4px);
      box-shadow: 0 4px 10px rgba(0,0,0,0.1);
    }
    .buscar-container {
      background-color: rgba(255, 255, 255, 0.55); /* translúcido */
      border: 2px solid rgba(241, 171, 187, 0.6);  /* rosado claro pastel */
      border-radius: 10px;
      padding: 15px;
      margin-bottom: 15px;
      backdrop-filter: blur(6px);
      -webkit-backdrop-filter: blur(6px);
     box-shadow: 0 4px 10px rgba(0,0,0,0.1);
    }

  </style>
</head>

<body>


  <video autoplay muted loop id="bg-video">
    <source src="bosquee.mp4" type="video/mp4">
    Tu navegador no soporta videos en HTML5.
  </video>

  <div class="container">
    <div class="row">
      <div class="col-lg-4">
        <div class="card mb-3">
          <div class="card-header text-center">
            <h3>Registro de productos</h3>
          </div>
          <div class="card-body">
            <form id="frm">
              <input type="hidden" name="id" id="idp" value="">
              <div class="form-group">
                <label for="codigo">Código</label>
                <input type="text" name="codigo" id="codigo" class="form-control" placeholder="Código">
              </div>
              <div class="form-group">
                <label for="producto">Producto</label>
                <input type="text" name="producto" id="producto" class="form-control" placeholder="Descripción">
              </div>
              <div class="form-group">
                <label for="precio">Precio</label>
                <input type="text" name="precio" id="precio" class="form-control" placeholder="Precio">
              </div>
              <div class="form-group">
                <label for="cantidad">Cantidad</label>
                <input type="text" name="cantidad" id="cantidad" class="form-control" placeholder="Cantidad">
              </div>
              <div class="form-group">
                <input type="button" value="Registrar" id="registrar" class="btn btn-primary btn-block">
              </div>
            </form>
          </div>
        </div>
      </div>

      <div class="col-lg-8">
        <div class="row mb-3">
          <div class="col-lg-6 ml-auto">
            <div class="buscar-container">
              <form>
                <div class="form-group">
                <label for="buscar">Buscar:</label>
                <input type="text" id="buscar" placeholder="Buscar..." class="form-control">
                </div>
             </form>
           </div>
     </div>
     </div>

       <div class="tabla-container">
  <table class="table table-hover table-responsive">
    <thead class="thead-dark">
      <tr>
        <th>ID</th>
        <th>Descripción</th>
        <th>Precio</th>
        <th>Cantidad</th>
        <th>Acciones</th>
      </tr>
    </thead>
    <tbody id="resultado">
      
    </tbody>
  </table>
</div>

      </div>
    </div>
  </div>

  <script src="script.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
</body>
</html>
