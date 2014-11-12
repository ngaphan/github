/*******************************************************************************************/
/********************************** FONCTIONS UTILITAIRES **********************************/
/*******************************************************************************************/

function loadDataFromDomStorage(nameString)
{
  var jsonDataString;
	var jsonDataObject;

	jsonDataString = window.localStorage.getItem(nameString);

	/*
	 * Donnée simple (chaîne) -> JSON parse (= désérialisation) -> Donnée complexe
	 *
	 * Voir ci-dessous pour plus d'explications sur le pourquoi du JSON.
   * 
   * Note : l'objet retourné peut être un tableau (array)
   * puisque les tableaux ne sont qu'un type d'object particulier.
   *
	 */

  jsonDataObject = JSON.parse(jsonDataString);

	return jsonDataObject;
}

function saveDataToDomStorage(nameString, dataObject)
{
  var jsonDataString;

	/*
	 * Le DOM storage ne permet pas de stocker des données complexes (objet, tableau...).
	 * On doit donc d'aborder sérialiser nos données dans un format simple, le JSON.
	 *
	 * On obtient une chaîne représentant l'objet complexe, et c'est cette chaîne que
	 * l'on stocke dans le DOM storage.
	 *
	 * Donnée complexe -> JSON stringify (= sérialisation) -> Donnée simple (chaîne)
	 */
	jsonDataString = JSON.stringify(dataObject);

	window.localStorage.setItem(nameString, jsonDataString);
}
