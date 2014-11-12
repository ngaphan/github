/*******************************************************************************************/
/********************************** FONCTIONS UTILITAIRES **********************************/
/*******************************************************************************************/

/*
 * TODO: la fonction n'efface que les valeurs des balises HTML <input type="text">,
 *       il faudrait prendre en compte les <textarea> et les <select>...
 */
function clearForm(selectorString)
{
	/* selectorString = Id du formulaire pr qu'on sache dans quoi il faut agir
	 * ici : selectorString = id ="js-contact-form"
	 * Donc , il faut aller dans <form> et agir sur ces enfants( = les inputs)
	 */


	// créer 1 varable pr stocker ts les champs à chaisir du formulaire
	var inputsArray;

	// Récupération de tous les champs de saisi du formulaire spécifié(=Id reçu).
	inputsArray = document.querySelectorAll(selectorString + ' input[type=text]');
	/* 
	 * va dans document,chercher moi tous les éléments de "selectorString=Id du formulaire"  
	 * qui contient les éléments input(=balise input) dont de "type=text".
	 * on a bcp de <input> de différents types(type="text",type="radio",type="button"...>, 
	 * donc input devient 1 tab qui contient les types différents .
	 * Ici on veut qu'il ns envoie que le type=text.
	 */
	console.log(inputsArray);
	// result : NodeList [ <input#lastName>, <input#firstName>, <input#phone> ]

	for(var indexInt = 0; indexInt < inputsArray.length; indexInt++)
	{
		/*
		 * Pour chaque champ de formulaire, on supprime le contenu de la propriété value
		 * correspondant à l'attribut HTML ' value="..." ' du champ de formulaire.
		 */
		inputsArray[indexInt].value = null;//donner value null=supprimer l'ancienne value
	}
}




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

function hideHtml(selectorString)
{
	console.log(selectorString);
	
	// result : "#js-contact-form"(= id du formulaire) 				utilities.js:100
	// pour qu'on sache quoi à cacher

	/*
	 * 'classList' retourne 1 liste des classes ayant dans le formulaire
     * on affiche cette liste pr voir ce qu'il y a dedans
     */

	console.log(document.querySelector(selectorString).classList);
	// DOMTokenList [ "standard-form", "hide" ]

	// Ajout de la classe CSS hide sur l'objet DOM trouvé avec le sélecteur spécifié.
    document.querySelector(selectorString).classList.add('hide');
    /*
     * va dans document, sélectionner le 'selectorString'(= id du formulaire) 
     * grace à la methode 'classList' qui retourne 1 liste des classes ayant dans
     * le formulaire,on ajoute à cette liste la class ='hide' grace à la methode 'add' 
     */ 
    console.log(document.querySelector(selectorString).classList);
    // DOMTokenList [ "standard-form", "hide" ]
}


	/*
	 * function installEventHandler : au singulier -> pour 1 seul contact
	 * pour écouter un évenement et prépare les conduites à faire si l'évenement arrive. 
	 * On a besoin 3 param  :
	 * a. selectorString 		: sur quel élément faut-il agir ?
	 * b. eventString    		: quel évenement ?( click ?,onmouseover? ...)
	 * c. eventHandlerFunction  : que faut-il faire ? Comment agir si l'évenement arrive?
	 * Que faut-il faire dans la fonction ? il faut 2 étapes :
	 * 1. Récupération du premier objet DOM correspondant au sélecteur(selectorString)
	 * 2. Installation d'un gestionnaire d'évènement sur cet objet DOM.
	 *    Pour pouvoir gérer l'évenement sur l'obj, faut savoir quel évenement qu'il reçoit 
	 *	  et ce qu'il faut faire -> attend 2 param : eventString, eventHandlerFunction
	 *    Ce gestionnaire est assuré par la fonction : 
	 *    addEventListener(eventString, eventHandlerFunction)qui est attaché à l'obj DOM
	 *    qu'on vient de récupérer à l'étape précédente
	 *    'addEventListener' est 1 function existé dans DevDocs.io,pas besoin de créer. On
	 *    l'attache directement à l'élément qu'on veut écouter
	 */

function installEventHandler(selectorString, eventString, eventHandlerFunction)
{
    var DOMObject;// boîte individuelle = stocker info d'un seul contact    

    DOMObject = document.querySelector(selectorString);

    console.log(DOMObject);
    // <a href="#" id="js-add-contact">
    // <a href="#" id="js-clear-address-book">
    // <input type="button" value="Enregistrer" id="js-save-contact">

    /* Récupération du premier objet DOM correspondant au sélecteur.
     * car le querySelector(default) ne renvoie qu'une seule premier value
     * Donc si on veut sélectionner plusiseurs Obj -> faut appeler plusieurs fois.
     * Chaque appel, donner 1 nouveau selector
     */


    // Installation d'un gestionnaire d'évènement sur cet objet DOM.
    DOMObject.addEventListener(eventString, eventHandlerFunction);

    console.log(DOMObject);
    // on a trouvé : 3évenements + 3actions
    // <a href="#" id="js-add-contact">
    // <a href="#" id="js-clear-address-book">
    // <input type="button" value="Enregistrer" id="js-save-contact">
}

	/*
     * L'utilisateur peut vouloir regarder ce qu'il a déjà renseigné->faut avoir 1 
     * possiblité de revoir ces info. Donc :
     * 
	 * Après avoir récupéré les infos du 1er contact(boite individuelle) , 
	 * il faut mettre cette boite individuelle dans 1 grande boite qui a de même nom
	 * mais au pluriel(DOMObjects) pour 2 raisons:
	 * 1. Affichier tous les contacts( carnet d'adresse)
	 * 2. Si l'utilisateur veut revoir ces info en clickant sur son nom on cherche dans la 
	 *    grande boite et affichier ses infos en détail.
	 * 
	 * De la même logic, cré la fonction au pluriel:
	 * installEventHandlers(selectorString, eventString, eventHandlerFunction)
	 * pour stocker tous les évenements éventuels et les conduites à faire correspondantes. 
	 */


function installEventHandlers(selectorString, eventString, eventHandlerFunction)
{
    var DOMObjects;// grande boîte = table =>stocker ls ptite boite individuelle précédente  

    // Récupération de tous les objets DOM correspondant au sélecteur.
    DOMObjects = document.querySelectorAll(selectorString);


    /* 
     * La grande boite commence à s'agrandir, il faut parcourir la boite(= la table)
     * pour trouver les info voulues (indiqué par l'indice)
	 */

    for(var index = 0; index < DOMObjects.length; index++)
    {
    	// Installation d'un gestionnaire d'évènement sur chaque objet DOM.
        DOMObjects[index].addEventListener(eventString, eventHandlerFunction);
        
    }

    console.log(DOMObjects);
    // NodeList [ <a>, <a> ] : le nbre de <a> dépend du nbre de contact enregistré	 
}


	/*
		* DOM Storage is the name given to the set of 'storage-related features'
		* first introduced in the 'Web Applications 1.0 specification'
		*=> Chaque fois l'utilisateur click sur le bouton 'enregistrer/Valder' , les infos 
		* sont automatically enregistrés dans DOM Storage. On doit les récupérer pr stocker
		* dans notre storage créé nous même.(=var jsonDataString;)
		* DOM Storage ne supporte que des donnés simples (tring) , pas d'Obj, ni Tableau....
		* 'window.localStorage.getItem(nameString)' est une fonction de DOM pr récupérer Data 
		* dans DOMStorage.
		* D'où ce qu'on récupère du DOMStorage sera 1'string'->faut 'Parse' en Obj si besoin
	*/


/* 'nameString'= 1 String s'appellant 'DOM_STORAGE_ITEM_NAME' qui a pour valeur = les infos
 * enregistrés dans 'addressBook', 
 * donc = [{"firstName":"nga","lastName":"PHAN","phone":"0102","title":"Mme."}] 
 * fonction loadDataFromDomStorage(nameString) est applé ds adress-book.js , line 156
 * donc 'nameString'= 'DOM_STORAGE_ITEM_NAME' et
 * 'nameString' a une value = 
 * "[{"firstName":"nga","lastName":"PHAN","phone":"0102","title":"Mme."}]"
 * d'où : console.log(jsonDataString) lors de la récup est =
 * "[{"firstName":"nga","lastName":"PHAN","phone":"0102","title":"Mme."}]"
 */

function loadDataFromDomStorage(nameString)
{
  	var jsonDataString; //Stocker le string récupéré du DOMStorage
	var jsonDataObject; //Stocker l'Obj' après 'Parse'(= convertir) selon la méthode JSON
	// JSON is a syntax for serializing objects, arrays,strings... It is based upon JavaScript

	jsonDataString = window.localStorage.getItem(nameString);//window= navigateur

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

function showHtml(selectorString)
{
	// Suppression de la classe CSS hide de l'objet DOM trouvé avec le sélecteur spécifié.
	document.querySelector(selectorString).classList.remove('hide');
}