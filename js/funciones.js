var segundos =0;
var minutos =0;
var val =0;
var valor=0;
var unidad =0;

var t= "";
var t2= "";



 $(document).ready(function(e) {

  $("#btnuevo").hide();
   $("#recibe").hide();
  $("#cont2").hide();

   });

function nuevo_calculo ()
{
  if (confirm("¿Desea realizar un nuevo calculo?")) {location.reload();};

}



 function calcular()
    {

              // alert(r.msg);

if ( $("#buscar").val() != "")
{


              $("#recibe").show();
              $("#cont2").show();
              $("#btnverde").hide();
              $("#btnuevo").show();
              $("#v2").html("$"+" "+0);
              $("#u2").html(0);
               reiniciar_tiempo();

  
}
else
{
  alert("Ingrese Direccion");
}

 

}



 function tarifa()
    {

valor=valor + 800 ;
unidad = valor/800;

             $("#v2").html("$"+" "+valor);
             $("#val").val(valor);
             
             
                         
    }


function tiempo () 
{

time=setInterval(function()
{

 segundos = segundos + 1;


 if (segundos>=60)
 {
  minutos= minutos +1;
  segundos=0;
 
 }

 $("#t2").html(minutos+" : "+segundos);


},1000);


}

function reiniciar_tiempo () {
    tiempo();
    time2=setInterval(tarifa,60000);
}