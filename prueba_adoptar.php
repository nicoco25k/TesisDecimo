<?php require_once __DIR__ . "/Estructure/Header.php"; ?>
<?php require_once __DIR__ . "/Estructure/NavBar.php"; ?>


<div class="contenedor-cards">

<?php

include_once("bd/Conexion.php");

try {

$sql = "
SELECT 
id_mascotas,
nombre_mascota, 
nombre_sexo, 
nombre_edad,  
nombre_raza, 
ruta_img_mascota
FROM tabla_mascotas tm

JOIN mascota_edad m3 
ON tm.id_edad_mascota = m3.id_edad_mascota

JOIN mascota_raza m9 
ON tm.id_razas_mascota = m9.id_razas_mascota

JOIN mascota_sexo m10 
ON tm.id_sexo_mascota = m10.id_sexo_mascota

WHERE id_estado_adopcion_mascota = '1'
";


$result = $dbh->query($sql);


while ($animal = $result->fetch(PDO::FETCH_ASSOC)) {

echo '

<div class="pf-card-wrap pb-4">

<div class="pf-card">


<!-- FRONT -->

<div class="pf-front">


<div class="pf-image">

<img src="'.$animal['ruta_img_mascota'].'">

<div class="pf-gradient"></div>

<div class="pf-text">

<h3>'.$animal['nombre_mascota'].'</h3>

<span> '.$animal['nombre_sexo'].'</span>

</div>

</div>


<div class="pf-body">


<div class="pf-breed">

Edad: '.$animal['nombre_edad'].'

</div>


<div class="pf-breed">

Raza: '.$animal['nombre_raza'].'

</div>
<div class="pf-divider"></div>


<div class="pf-buttons">


<button class="pf-btn-primary text-aling-center">

Conocer Más

</button>


<button class="pf-btn-secondary pf-fast text-aling-center">

<i class="fa-solid fa-clipboard-list"></i> Datos Rápidos

</button>


</div>

</div>


</div>




<!-- BACK -->


<div class="pf-back">

<div class="pf-back-overlay"></div>

<div class="pf-back-content">

<h3>
Datos de '.$animal['nombre_mascota'].'
</h3>


<div class="pf-facts">


<div>
<span>Sexo</span>
<b>'.$animal['nombre_sexo'].'</b>
</div>


<div>
<span>Edad</span>
<b>'.$animal['nombre_edad'].'</b>
</div>


<div>
<span>Raza</span>
<b>'.$animal['nombre_raza'].'</b>
</div>


<div>
<span>Esterilizado</span>
<b>Si</b>
</div>


<div>
<span>Desparasitado</span>
<b>No</b>
</div>


<div>
<span>Vacunación</span>
<b>Si</b>
</div>


</div>


<div class="pf-caracteristicas">

<span>Características</span>

<p>

Juguetón, cariñoso y amigable.

</p>

</div>



<div class="pf-buttons-back">

<button class="pf-btn-primary">

Conocer Más

</button>


<button class="pf-btn-secondary pf-btn-back">

<i class="fa-solid fa-rotate-left"></i> Volver

</button>

</div>


</div>

</div>


</div>

</div>

';





}

} catch (PDOException $e) {

echo $e->getMessage();

}

?>

</div>


<?php require_once __DIR__ . "/Estructure/Footer.php"; ?>


<script>document.addEventListener("click",function(e){

if(e.target.classList.contains("pf-fast")){

e.target.closest(".pf-card").classList.add("flip");

}


if(e.target.classList.contains("pf-btn-back")){

e.target.closest(".pf-card").classList.remove("flip");

}

});</script>