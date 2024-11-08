document.addEventListener("DOMContentLoaded", function () {
  let celdaSaldo = document.querySelectorAll("#recibos td:nth-child(7)");
  let saldo = Array.from(celdaSaldo).reduce(
    (total, celda) => total + parseFloat(celda.textContent || 0),
    0
  );

  console.log(saldo);

  document.getElementById("saldo").textContent = saldo;
});
