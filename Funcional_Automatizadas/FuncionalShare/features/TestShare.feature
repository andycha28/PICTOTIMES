Feature: pictotime share
	In order to compartir
	As a facebook user
	I need compartir una imagen

Scenario: Exito al compartir una imagen
        Given I go to "/index.php"
	Then I press "Ver"
	And I reload the page
	Then I go to "/image.php"
