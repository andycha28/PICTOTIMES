Feature: pictotime upload
	In order to upload images
	As a facebook user
	I need upload any kind of images

Scenario: Success to upload images
	Given I go to "/upload.php"
	When I attach the file "index.png" to "btnSeleccionar"
	And  I fill in "txtNombre" with "Es un archivo" 
	And  I press "btnSubir"
	Then I reload the page 
	And I should see "Se ha cargado correctamente el archivo con exito. : Archivo subido al repositorio"
	

Scenario: Fail to upload images 
	Given I go to "/upload.php"
	When I attach the file "index.doc" to "btnSeleccionar"
	And I fill in "txtNombre" with "Imagen"
	And I press "btnSubir"
	Then I reload the page 
	And I should see "Ha ocurrido un error al cargar el archivo. : Formato invalido"
