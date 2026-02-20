$(document).ready(function() {
	// Función para obtener los animales mediante AJAX
	function getAnimals() {
	  $.ajax({
		url: 'filter.php',
		type: 'POST',
		dataType: 'html',
		success: function(response) {

			
		  $('#animal-list').html(response);

			


		},
		error: function(xhr, status, error) {
		  console.log(error);
		}
	  });
	}

	// Cargar los animales al cargar la página
	getAnimals();
  });


  