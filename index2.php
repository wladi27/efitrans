<head>
  <meta charset="UTF-8">
 
  <script src="js/jquery/jquery-2.0.3.min.js"></script>
<link rel="stylesheet" href="vendors/bootstrap/css/bootstrap.min.css">
<script type="text/javascript" src="js/funciones.js"></script>
</head>
<body>
<div id="grande" class="pt-4"> 

	<section id="amarrillo">   <!--- SECTION 0 -->

	<div id="gradiante_a"> <h3> <BR>Taximetro EFITRANS<b style="color:green;float:right;margin-right:30px"> Activo </b> </h3> </div>

	</section>  <!--- SECTION 0 FIN-->



	<section id="azul"> <!--- SECTION 1 -->

	<!--<div id="curva"> <b style="color:#25729a"> A destino </b></div>-->
	<div class="cont">

<form id="formulario" class="formulario">
<table width="98%" border="0">
	<tr>

	<td colspan="2"> <input type="text" class="form-control camp-text" id="buscar" value="Taximetro EFITRANS " name="buscar"></td>
	<td> 
	<button type="button" class="btnverde btn btn-success center-block boton" id="btnverde" onclick="calcular()"> Iniciar Ahora</button> 
	<button type="button" class="btnuevo btn btn-warning center-block boton" id="btnuevo" onclick="nuevo_calculo()">Nuevo Calculo</button>  </td>
	
	</tr>


</table><br>

<div id="recibe">
	 






</div>

</form>

	</div>
		
	</section>   <!--- SECTION 1 FIN -->



	<section id="blanca">   <!--- SECTION 2 -->
<div id="cont2">
<table width="98%" border="0">
    <tr>
    
    <td ><b class="textos"> Cronometro </b> </td>
    <td ><b class="textos"> Minutos Completados</b> </td>
    <td> <b class="textos"> Valor</b> </td>
    
    </tr>

    <tr>

    <td> <b id="t2" style="font-size:25px;color:#B20000"></td>
    <td> <b id="u2" style="font-size:25px;color:#4ba614"></td>
    <td> <b id="v2" style="font-size:25px;color:#FF0000"></td>
    
    </tr>
    <tr>

    
    </tr>
</table>


</div>
	</section>