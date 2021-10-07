<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="vendors/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="css/main.css">
  <script src="js/jquery/jquery-2.0.3.min.js"></script>
<link rel="stylesheet" type="text/css" href="css/.css">
<script type="text/javascript" src="js/funciones.js"></script>

  <title>EFITRANS</title>
</head>
<body>
    <nav class="navbar navbar-default">
     <div class="container-fluid text-center">
        <span class="title">EFITRANS</span>
      <div class="navbar-header">
        
      </div>
    </div>
  </nav>
  <section id="viaja" class="container-fluid color-found section-container">
    <article class="row height-map">
      <div class="col-xs-12 col-sm-4">
        <!-- <button id="encuentrame" class="btn btn-default center-block boton">!CONOCE TU UBICACION!</button> -->
        <h2>
          <strong>!Consulta lugares aquí!</strong>
        </h2>
        <h3></h3>
        <div class="section-inputs">
          <div class="input-group">
            <img src="assets/images/shape.png" alt="">
            <input id="start" type="text" class="form-control camp-text" placeholder="Ingrese su punto de partida">
          </div>
          <div class="input-group">
            <img src="assets/images/shape2.png" alt="">
            <input id="end" type="text" class="form-control camp-text end" placeholder="Ingrese su destino">
            <button id="search" class="btn btn-warning center-block boton">!TRAZAR RUTA!</button>
          </div>
        </div>
      </div>
      
      </div>
      <div id="map" class="col-xs-10 col-xs-offset-1 col-sm-7  img-ruta-movil">
        <div>
        </div>
      </div>
      <div class="container-fluid">
        <div class="row">
        <div class="col-xs-10 col-sm-5 ">
          <div id="options" class=></div>
          <table id="container-price" class="table box">

          </table>
        </div>
        </div>
      </div>
    </article>
  
  <div class="card-body">
      <?php 
	require_once("index2.php");

	?>
  </div>
  <BR><BR><BR>
</section>

  <script type="text/javascript" src="vendors/bootstrap/js/jquery.js">
  </script>
  <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVwz3mdh_9SgBU0vA6qFqD9eiVnhroNYE&callback=initMap&libraries=places,geometry">
  </script>
  <script type="text/javascript" src="vendors/bootstrap/js/bootstrap.min.js">
  </script>
  <script type="text/javascript" src="js/app.js">
  </script>
  <script type="text/javascript" src="js/api.js">
  </script>
</body>
</html>
