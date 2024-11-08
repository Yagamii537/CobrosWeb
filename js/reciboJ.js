function guardarTodo() {
  var detalleR = [];

  // Obtener los datos de la tabla
  var tabla = document.getElementById("tabla");
  var filas = tabla.getElementsByTagName("tr");

  for (var i = 1; i < filas.length; i++) {
    // Comenzar desde 1 para omitir la fila de encabezados
    var fila = filas[i];
    var celdas = fila.getElementsByTagName("td");
    var cantidad = celdas[0].innerText;
    var detalle = celdas[1].innerText;
    var valUnit = celdas[2].innerText;

    detalleR.push({
      cantidad: cantidad,
      detalle: detalle,
      valUnit: valUnit
    });
  }

  //? PARA RECIBO
  var hash = document.getElementById("hash").value;
  var nombre = document.getElementById("nombre").value;
  var contacto = document.getElementById("contacto").value;
  var empleado = document.getElementById("empleado").value;
  var efectivo = Number(document.getElementById("efectivo").value);
  var transferencia = Number(document.getElementById("transferencia").value);
  var total = Number(document.getElementById("datoInvisible").value);
  var saldo = total - efectivo - transferencia;

  // Obtener la fecha actual
  const today = new Date();

  // Extraer el año, mes y día
  const year = today.getFullYear();
  // El mes está basado en 0 (enero es 0), por lo que necesitamos sumar 1
  const month = String(today.getMonth() + 1).padStart(2, "0");
  const day = String(today.getDate()).padStart(2, "0");
  const fecha = `${year}-${month}-${day}`;

  var dat = {
    accion: "guardarC",
    hash: hash,
    nombre: nombre,
    contacto: contacto,
    empleado: empleado,
    efectivo: efectivo,
    transferencia: transferencia,
    saldo: saldo,
    total: total,
    estado: 1,

    detalleR: detalleR
  };

  var xhr = new XMLHttpRequest();
  xhr.onreadystatechange = function () {
    if (xhr.readyState === XMLHttpRequest.DONE) {
      if (xhr.status === 200) {
        console.log(xhr.responseText);
      } else {
        console.error("Error en la solicitud:", xhr.status);
      }
    }
  };
  xhr.open("POST", "../includes/reciboLogica.php", true);
  xhr.setRequestHeader("Content-Type", "application/json");
  xhr.send(JSON.stringify(dat));

  //obj = JSON.parse(idRec);
  
  url = "../includes/ticket.php?hash=" + hash;
  window.open(url, "_blank");
  window.location.href = "principal.php";
  
}
