/***************************************************************************************/
/***************************** DONNEES CARNET D'ADRESSES *******************************/
/***************************************************************************************/

const DOM_STORAGE_ITEM_NAME = 'Address Book'; 
// cette constante a une valeur égale à 'Address Book' de type' string' 


/***************************************************************************************/
/**************************** EVENEMENTS CARNET D'ADRESSES *****************************/
/***************************************************************************************/

//click sur le bouton " ajouter un user "
function onClickAddContact()
{
    // Effacement du contenu du formulaire saisi avant.

    $("#js-user-form input[type=text]").val(null) ;

    // Mise à jour de l'affichage = afficher le formulaire vide.
    $('#js-user-form').show();
}


//click sur le bouton " enregister/valider "
function onClickSaveContact()
{
    var userObject;   // petite boite contient les infos d'un seul user
    var addressBookArray;// grande boite pr ranger les ptites boites
    

    // Création d'un seul objet user avec les données du formulaire= petite boite.
    userObject = createContact
    (
        getFormFieldValue('js-user-form', 'title'),
        getFormFieldValue('js-user-form', 'firstName'),
        getFormFieldValue('js-user-form', 'lastName'),
        getFormFieldValue('js-user-form', 'phone')
    );

     // Les 4 lignes entre () au-dessus corresponendent à 4 params attendus de la fonction 
     // 'createContact' définie ci-dessous
     
    /*
     * Le carnet d'adresses est un tableau d'objets.
     *
     * 1. Chargement du carnet d'adresses ( c'est 1 tableau , la grande boite)
     * 2. Ajout du user à la fin = insérer la petite boite dans la grande boite,
     *    le carnet d'adresses est considéré comme une pile de users
     * 3. Sauvegarde du carnet d'adresses(grande boite) avec le nouveau user(ptite boite)
     */
    addressBookArray = loadAddressBook();// 1.
    addressBookArray.push(userObject);// 2.
    saveAddressBook(addressBookArray);   // 3.

    // Mise à jour de l'affichage.
    $('#js-user-form').hide();
    refreshAddressBook();

    /*
     * L'évènement submit de formulaire ne doit pas s'exécuter.
     *
     * Le fait de retourner false dans un gestionnaire d'évènements permet
     * d'interrompre l'évènement dans le navigateur, qu'il n'y ait rien d'autre
     * qui s'exécute.
     */
    return false;
}

    /* 
     * clicker sur le button 'effacer le carnet d'adress'
     * il faut :
     *   1. Affichier le carnet vide ( = n'affiche rien)
     *   2. Cacher le formulaire 
     *   3. Effacer les infos saisis avant afin de réutiliser le formualire vide
     *      pour le nouveau user
     */

function onClickClearAddressBook()
{
    // Sauvegarde d'un carnet d'adresse vide, écrasant le carnet d'adresse existant.
    saveAddressBook(new Array());       // 1.

    // Mise à jour de l'affichage.
    $('#js-user-details').hide();    // 2.
    refreshAddressBook();               // 3.

}

    /*
     * utilisateur click sur son nom dans le carnet d'adress, il faut :
     * affichier tous les infos qu'il a saisis
     */

function onClickShowContactDetails()
{
    var addressBookArray;    //grande boite
    var userObject;       // ptite boite
    var userElementObject;// les infos dans l'Object user sont les éléments de cet Object
    var indexInt;            // pour parcourir le tableau 'addressBookArray'

    /*
     * this = objet DOM qui a déclenché l'évènement,
     *        ici il s'agit donc de l'un des hyperliens généré dans refreshAddressBook()
     *
     * La propriété dataset des objets DOM permet de récupérer les attributs HTML
     * data-xxx : data-machin = dataset.machin.
     *
     * Les hyperliens générés dans refreshAddressBook() ont un attribut HTML data-index
     * donc cela donne dataset.index.
     */
    indexInt = this.dataset.index;

    // Chargement du carnet d'adresses puis récupération du user sur lequel on a cliqué.
    addressBookArray    = loadAddressBook();
    userObject       = addressBookArray[indexInt];

    // Affichage HTML des données du user, avec un hyperlien permettant son édition.
    userElementObject            = document.getElementById('js-user-details');


    
    userElementObject.innerHTML  = '<h3>' + userObject.title 
                                             + ' ' 
                                             + userObject.firstName 
                                             + ' ' 
                                             + userObject.lastName 
                                             + '</h3>';// en tout =  Mlle Nga PHAN
    userElementObject.innerHTML += '<p>' + userObject.phone + '</p>';

    // Mise à jour de l'affichage.
    $('#js-user-details').show();

}



/***************************************************************************************/
/***************************** FONCTIONS CARNET D'ADRESSES *****************************/
/***************************************************************************************/

function createContact(titleString, firstNameString, lastNameString, phoneString)
{
	var userObject;

	userObject           = new Object();    // création d' 1 nouveau Object
	userObject.firstName = firstNameString; // attacher firstName à cet Object
	userObject.lastName  = lastNameString.toUpperCase();
	userObject.phone     = phoneString;

	switch(titleString)
	{
		case 'madam':
    		userObject.title = 'Mme.';
    		break;

		case 'miss':
    		userObject.title = 'Mlle.';
    		break;

		case 'mister':
    		userObject.title = 'M.';
    		break;
	}

    return userObject;
}


/* function loadAddressBook() est 1 function anonyme (=default, marcher toute seule) ,
 * pas besoin de param, donc pas besoin d'envoyer de param lors qu'on l'appelle 
 */

function loadAddressBook()
{
	var addressBookArray;

	// Chargement du carnet d'adresses depuis le DOM storage.
	addressBookArray = loadDataFromDomStorage(DOM_STORAGE_ITEM_NAME);

	// Est-ce qu'il n'y avait aucune donnée dans le DOM storage ?
	if(addressBookArray == null)
	{
		// Oui, création d'un carnet d'adresses vide.
		addressBookArray = new Array();// pas besoin  de donner un param
	}

    console.log(addressBookArray); 
    // result = Array [  ] si personne ne renseigne les champs
    // result = Array [ Object ] si l'utilisateur renseigne les champs et 'enregistrer'
    // clicker sur 'Object',ça ns donne les infos renseigné par l'utilisateur

	return addressBookArray;
}



function refreshAddressBook()
{
    var addressBookArray;
	var addressBookElementObject;

	addressBookArray = loadAddressBook();
    //console.log(addressBookArray);// result = Array [ Object ]

	// Suppression de l'ensemble du carnet d'adresses HTML.
    //addressBookElementObject           = document.getElementById('js-address-book');


	addressBookElementObject             = $('#js-address-book').val();//????????????



    //console.log(addressBookElementObject);// = <ul id="js-address-book">


	addressBookElementObject.innerHTML = null;// effacer les infos précédemment saisi 
    // console.log(addressBookElementObject.innerHTML);
     //result = "" (càd cet Object existe mais = valeur null)

	// Affichage HTML du carnet d'adresses, un user à la fois.
	for(var indexInt = 0; indexInt < addressBookArray.length; indexInt++)
	{
        console.log(addressBookArray);// result = Array [ Object ]


		// Chaque user est un hyperlien <a> entouré d'une balise HTML <li>.
        // x+=y -> x=x+y / x*=y -> x=x*y
		addressBookElementObject.innerHTML +=
			'<li>' +
				'<a data-index="' + indexInt + '" href="#">' + 
					addressBookArray[indexInt].firstName + ' ' + 
					addressBookArray[indexInt].lastName + 
				'</a>' +
			'</li>';
	}

	// Installation d'un gestionnaire d'évènement sur chaque hyperlien <a>.

    
            $("#js-address-book a").click.show();
      
}

function saveAddressBook(addressBookString)
{
	// Enregistrement du carnet d'adresses dans le DOM storage.
    // addressBookString = addressBookArray

	saveDataToDomStorage(DOM_STORAGE_ITEM_NAME, addressBookString);

}



/************************************************************************************/
/********************************** CODE PRINCIPAL **********************************/
/************************************************************************************/

/*
 * Installation d'un gestionnaire d'évènement déclenché quand l'arbre DOM sera
 * totalement construit par le navigateur.
 *
 * Le gestionnaire d'évènement est une fonction anonyme que l'on donne en deuxième
 * argument directement à document.addEventListener().
 */

$(function()
    {
        $("#js-add-user").click(onClickAddContact);
        $("#js-save-user").click(onClickSaveContact);
        $("#js-clear-address-book").click(onClickClearAddressBook);
        refreshAddressBook();
    }
);

