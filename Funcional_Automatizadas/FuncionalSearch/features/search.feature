Feature: Pictotime searching
	In order to search images by a name
	As a pictotime user
	I need to see the results 

Scenario: Searching for "no"
	Given I go to "/search.php"
	When I fill in "txtBuscar" with "no"
	And I press "btnBuscar"
	Then I should see "nosso logo"
	
