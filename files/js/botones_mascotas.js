const btnVerMas = document.getElementById("ver-mas-btn");
const btnVerMenos = document.getElementById("ver-menos-btn");
const contenedorOculto = document.getElementById("hidden-animals");
const contenedorVerMenos = document.getElementById("ver-menos-container");

btnVerMas.addEventListener("click", function () {
  contenedorOculto.style.display = "block";
  btnVerMas.parentElement.style.display = "none";
  contenedorVerMenos.style.display = "block";
});

btnVerMenos.addEventListener("click", function () {
  contenedorOculto.style.display = "none";
  contenedorVerMenos.style.display = "none";
  btnVerMas.parentElement.style.display = "block";
});
