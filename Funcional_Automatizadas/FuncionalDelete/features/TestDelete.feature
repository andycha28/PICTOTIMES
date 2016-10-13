Feature: pictotime delete
	In order to borrar 
	As a facebook user
	I need eliminar una imagen

Scenario: Exito al eliminar una imagen
	Given I go to "/miPerfil.php"
	Then I press "Ver"
	And I reload the page 
	Then I go to "/imagedel.php"
	And I press "btnEliminar"
	And I go to "/index.php"
