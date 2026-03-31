<?php require_once __DIR__ . "/Estructure/Admin_Autenticador.php"; ?>
<?php require_once __DIR__ . "/Estructure/Admin_Header.php"; ?>
<?php require_once __DIR__ . "/Estructure/Admin_NavBar.php"; ?>





<div class="container-fluid py-5  ">

  <div class="container_1">

    <h2 class="text-center text-muted py-4"><b>REGISTRAR NUEVA MASCOTA</b></h2>

    <form method="POST" action="" class="formulario_mascota" id="formulario">

      <!-- Nombre -->
      <div class="formulario_mascota__grupo">
        <label>Nombre</label>
        <input type="text" name="nombre" id="nombre" placeholder="Nombre mascota" required>
      </div>

      <!-- Características -->
      <div class="formulario_mascota__grupo">
        <label>Características</label>
        <textarea id="caracteristicas" name="caracteristicas" placeholder="Características de comportamiento" required></textarea>
      </div>

      <!-- Especie -->
      <div class="formulario_mascota__grupo">
        <label>Selecciona la especie</label>
        <select name="select_especie" id="especie_opcion" required></select>
      </div>

      <!-- Raza -->
      <div class="formulario_mascota__grupo">
        <label>Selecciona la raza</label>
        <select name="select_raza" id="raza_opcion" required></select>
      </div>

      <!-- Sexo -->
      <div class="formulario_mascota__grupo">
        <label>Selecciona el sexo</label>
        <select name="select_sexo" id="sexo_opcion" required></select>
      </div>

      <!-- Edad -->
      <div class="formulario_mascota__grupo">
        <label>Selecciona la edad</label>
        <select name="select_edad" id="edad_opcion" required></select>
      </div>

      <!-- Desparasitado -->
      <div class="formulario_mascota__grupo">
        <label>¿Está desparasitado?</label>
        <select name="select_desparasitacion" id="desparasitacion_opcion" required></select>
      </div>

      <!-- Esterilizado -->
      <div class="formulario_mascota__grupo">
        <label>¿Está esterilizado?</label>
        <select name="select_esterilizacion" id="esterilizacion_opcion" required></select>
      </div>

      <!-- Vacunado -->
      <div class="formulario_mascota__grupo">
        <label>¿Está vacunado?</label>
        <select name="select_vacuna" id="vacuna_opcion" required></select>
      </div>

      <!-- Foto -->
      <div class="formulario_mascota__grupo">
        <label>Foto de la mascota</label>
        <input type="file" id="image" required onchange="imagenes()">
      </div>

      <!-- Botón -->
      <div class="formulario_mascota__grupo formulario_mascota__full formulario_mascota__btn  py-3">
        <button type="submit" class="btn btn-success px-4">Registrar</button>
      </div>


    </form>


    </section>














    <!-- Start Script -->

    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="files/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="files/js/registrar_mascota.js"></script> <!-- siempre al final -->
    <script src="files/js/custom_menu.js"></script>
    <!-- End Script -->
    </body>

    </html>