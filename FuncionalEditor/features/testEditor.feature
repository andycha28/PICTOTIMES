Feature: pictotime editor
	In order to editar images
	As a facebook user
	I need editar any kind of images

Scenario: Exito al editar imagen
        Given I go to "/imageWithText.php"
	When I attach the file "perro.jpg" to "btnSeleccionar"
        And I press "btnSubir"
	And I should see "Imagen cargada exitosamente"
	Then I should see "EDITE EL TEXTO PARA LA IMAGEN"
	And I fill in "texto" with "Hola"
        And I fill in "rojo1" with "15"
	And I fill in "verde1" with "20"
	And I fill in "azul1" with "30"
        And I select "Center" from "alineacionTexto1"
	And I fill in "margen1" with "25"
        And I fill in "texto2" with "a todos"
	And I fill in "rojo2" with "25"
	And I fill in "verde2" with "30"
	And I fill in "azul2" with "25"
	And I select "Left" from "alineacionTexto2"
	And I fill in "margen2" with "20"
	And I select "arial" from "fuente"
	And I fill in "size" with "60"
	When I press "btnVisualizar"
	And I should see "resultado"


Scenario: Fallo al editar imagen
	Given I go to "/imageWithText.php"
        When I attach the file "perro.doc" to "btnSeleccionar"
        And I press "btnSubir"
        And I should see ": Formato invalido"
