/*******************************************************************************************/
/********************************** FONCTIONS UTILITAIRES **********************************/
/*******************************************************************************************/

/*
 * TODO: la fonction n'efface que les valeurs des balises HTML <input type="text">,
 *       il faudrait prendre en compte les <textarea> et les <select>...
 */
function getFormFieldValue(formIdString, formFieldNameString)
{
	var formObject;		//cré 1 obj pr stocker le formulaire qui est identifié par Id 
  	var formFieldObject;//cré 1 obj pr stocker les'name' des champs à saisir du formulaire 
  						//ex: dans balise <input name="firstName">->on récupère:firstName

	formObject = document.getElementById(formIdString);
	/*
	 * va dans 'document',récupère l'élément qui a pour Id = 'formIdString' reçu en param.
	 * ici,'formIdString' = id du formulaire = "js-contact-form"
	 */

	/*
	 * Les objets DOM de formulaires ont une propriété elements qui elle-même
	 * a une méthode namedItem permettant de retrouver un objet DOM de champ
	 * de formulaire en fonction de son 'attribut HTML name'(=Ici:civility,firstName,
	 * lastName et phone qu'on a besoin de récupérer) qui va être envoyée 
	 * en param à la place de formFieldNameString.
	 */
	formFieldObject = formObject.elements.namedItem(formFieldNameString);
	/* 
	 *va dans formObject(= formulaire),grace à la methode 'namedItem'(existé ds DevDocs) 
	 * cherche moi tous les éléments(=tous les balises)qui ont pour 'formFieldNameString'
	 * (formFieldNameString = valeur de l'attr 'name' de chaque balise.
	 * EX: name="civility/firstName/lastName/phone" -> formFieldNameString = civility)
	 * Puis les stocker dans l'obj 'formFieldObject'.
	 */
	console.log(formFieldObject);
	 /*
	  * result :
	  * <select name="title" id="title"> // title = vivilité			utilities.js:72
	  * <input type="text" name="firstName" id="firstName"> 			utilities.js:72
	  * <input type="text" name="lastName" id="lastName"> 				utilities.js:72
	  * <input type="text" maxlength="10" name="phone" id="phone">		utilities.js:72
	  */

  	/*
  	 * Une fois qu'on a obtenu l'objet DOM de champ de formulaire, on renvoie
     * sa propriété value, correspondant à l'attribut HTML value du champ de formulaire.
     */

    console.log(formFieldObject.value);
    /*
     * result :
     * "mister" 														utilities.js:86
     * "nga" 															utilities.js:86
     * "phan" 															utilities.js:86
     * "0102030405" 													utilities.js:86
     */

  	return formFieldObject.value;
}



function loadDataFromDomStorage(nameString)
{
  	var jsonDataString; //Stocker le string récupéré du DOMStorage
	var jsonDataObject; //Stocker l'Obj' après 'Parse'(= convertir) selon la méthode JSON
	// JSON is a syntax for serializing objects, arrays,strings... It is based upon JavaScript

	jsonDataString = window.localStorage.getItem(nameString);

	console.log(jsonDataString);
	// "[{"firstName":"nga","lastName":"PHAN","phone":"0102","title":"Mme."}]"

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

  	console.log(jsonDataObject);
  	//(FF)= Array [ Object ] , (Chrome) = [Object] 0: Object length: 1__proto__: Array[0]

	return jsonDataObject;
	// Donc ce qu'on récupère de cette fonction sera 1 Obj maintenant
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







