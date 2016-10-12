Feature: pictotime login
	In order to login
	As a facebook user
	I need logearme en la aplicacion

Scenario: Exito al hacer login
        Given I go to "/login.php"
	Then I go to "/index.php"
