
function cargar_push()
{
 $.ajax({
 async: true,
    type: "POST",
    url: "push/httpush.php",
 dataType:"text",
    success: function(data)
 {
  var alertas = JSON.parse(data);
  for (var i =0; i<alertas.length; i++) {
    

    $.ajax({
                async: false,
                data:  {data: alertas[i]},
                url:   'push/sendAlerts.php',
                type:  'post',
                beforeSend: function () {
                },
                success:  function (response) {
                  console.log(response);
                }
        });
  }
  
  setTimeout('cargar_push()',1000);

    }
 });
}

$(document).ready(function()
{
 cargar_push();
});
