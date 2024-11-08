var sumaTotal = 0;

function agregarDatos() {
  var cant = document.getElementById("cantidad").value;
  var detalle = document.getElementById("detalle").value;
  var valorU = document.getElementById("valU").value;
  var mult = cant * valorU;

  var tabla = document.getElementById("datosTabla");
  var fila = tabla.insertRow();

  var celdaCantidad = fila.insertCell(0);
  var celdaDetalle = fila.insertCell(1);
  var celdaValU = fila.insertCell(2);
  var celdaValT = fila.insertCell(3);
  var celdaAccion = fila.insertCell(4);

  celdaCantidad.innerHTML = cant;
  celdaDetalle.innerHTML = detalle;
  celdaValU.innerHTML = valorU;
  celdaValT.innerHTML = mult;

  var btnEliminar = document.createElement("button");
  btnEliminar.innerHTML = '<i class="fa fa-minus" aria-hidden="true"></i>';
  btnEliminar.className = "btn btn-danger btn-sm";
  btnEliminar.onclick = function () {
    eliminarFila(this);
  };
  celdaAccion.appendChild(btnEliminar);

  sumaTotal += mult;
  document.getElementById("suma").textContent = sumaTotal + "$";
  document.getElementById("datoInvisible").value = sumaTotal;
  document.getElementById("cantidad").value = "";
  document.getElementById("detalle").value = "";
  document.getElementById("valU").value = "";
}

function eliminarFila(btn) {
  var row = btn.parentNode.parentNode;
  var valorFila = Number(row.cells[3].innerHTML);

  row.parentNode.removeChild(row);

  sumaTotal -= valorFila;
  document.getElementById("suma").textContent = sumaTotal + "$";
  document.getElementById("datoInvisible").value = sumaTotal;
}
