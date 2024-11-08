document.addEventListener("DOMContentLoaded", function () {
  //! PARA EFECTIVO
  let celdaSuma1 = document.querySelectorAll("#recibos tbody td.efectivo");

  let efect = Array.from(celdaSuma1).reduce((total, celda) => {
    let valorCelda = parseFloat(celda.textContent || 0);
    console.log(
      `Total acumulado: ${total}, Valor de la celda actual: ${valorCelda}`
    );
    return total + valorCelda;
  }, 0);

  let celdaSuma2 = document.querySelectorAll("#pagos tbody td.efectivo");

  let efect2 = Array.from(celdaSuma2).reduce((total, celda) => {
    let valorCelda = parseFloat(celda.textContent || 0);
    console.log(
      `Total acumulado: ${total}, Valor de la celda actual: ${valorCelda}`
    );
    return total + valorCelda;
  }, 0);

  //! PARA TRANSFERENCIAS
  let celdaSuma3 = document.querySelectorAll("#recibos tbody td.transferencia");

  let transf1 = Array.from(celdaSuma3).reduce((total, celda) => {
    let valorCelda = parseFloat(celda.textContent || 0);
    console.log(
      `Total acumulado: ${total}, Valor de la celda actual: ${valorCelda}`
    );
    return total + valorCelda;
  }, 0);

  let celdaSuma4 = document.querySelectorAll("#pagos tbody td.transferencia");

  let transf2 = Array.from(celdaSuma4).reduce((total, celda) => {
    let valorCelda = parseFloat(celda.textContent || 0);
    console.log(
      `Total acumulado: ${total}, Valor de la celda actual: ${valorCelda}`
    );
    return total + valorCelda;
  }, 0);

  let celdaSaldo = document.querySelectorAll("#recibos td:nth-child(6)");

  let saldo = Array.from(celdaSaldo).reduce(
    (total, celda) => total + parseFloat(celda.textContent || 0),

    0
  );

  let efectivo = celdaSuma1;
  //let transf = t1 + t2;
  // Mostrar la suma total en el elemento con id "sumaTotal"

  document.getElementById("efectivo").textContent = efect + efect2;

  document.getElementById("transferencia").textContent = transf1 + transf2;

  document.getElementById("saldo").textContent = saldo;
});
