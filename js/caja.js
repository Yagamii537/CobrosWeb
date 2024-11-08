document.addEventListener("DOMContentLoaded", function () {
  // Obtener todas las celdas de la segunda columna de ambas tablas
  let celdasTabla1 = document.querySelectorAll("#recibos td:nth-child(5)");
  let celdasTabla2 = document.querySelectorAll("#pagos td:nth-child(3)");

  let sumaTabla1 = Array.from(celdasTabla1).reduce(
    (total, celda) => total + parseFloat(celda.textContent || 0),
    0
  );
  let sumaTabla2 = Array.from(celdasTabla2).reduce(
    (total, celda) => total + parseFloat(celda.textContent || 0),
    0
  );

  let celdaT1 = document.querySelectorAll("#recibos td:nth-child(6)");
  let celdaT2 = document.querySelectorAll("#pagos td:nth-child(4)");

  let t1 = Array.from(celdaT1).reduce(
    (total, celda) => total + parseFloat(celda.textContent || 0),
    0
  );
  let t2 = Array.from(celdaT2).reduce(
    (total, celda) => total + parseFloat(celda.textContent || 0),
    0
  );

  let celdaSaldo = document.querySelectorAll("#recibos td:nth-child(7)");
  let saldo = Array.from(celdaSaldo).reduce(
    (total, celda) => total + parseFloat(celda.textContent || 0),
    0
  );

  let efectivo = sumaTabla1 + sumaTabla2;
  let transf = t1 + t2;

  // Mostrar la suma total en el elemento con id "sumaTotal"
  document.getElementById("efectivo").textContent = efectivo;
  document.getElementById("transferencia").textContent = transf;
  document.getElementById("saldo").textContent = saldo;
});
