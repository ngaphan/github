/***************************************************************************************/
/***************************** DONNEES CARNET D'ADRESSES *******************************/
/***************************************************************************************/

const DOM_STORAGE_ITEM_NAME = 'Address Book'; 
// cette constante a une valeur égale à 'Address Book' de type' string' 


/***************************************************************************************/
/**************************** EVENEMENTS CARNET D'ADRESSES *****************************/
/***************************************************************************************/

//click sur le bouton " ajouter un contact "
function onClickAddContact()
{
    // Effacement du contenu du formulaire saisi avant.

    $('#js-contact-form input[type="text"]').val(null) ;

    // Mise à jour de l'affichage = afficher le formulaire vide.
    $('#js-contact-form').show();
}

//click sur le bouton " enregister/valider "
function onClickSaveContact()
{
    // Création d'un seul objet contact avec les données du formulaire= petite boite.
    var contactObject = createContact
    (
        $('#js-contact-form select[name="title"]').val(),
        $('#js-contact-form input[name="firstName"]').val(),
        $('#js-contact-form input[name="lastName"]').val(),
        $('#js-contact-form input[name="phone"]').val()
    );
    var addressBookArray = loadAddressBook();

    addressBookArray.push(contactObject);
    saveAddressBook(addressBookArray);

    // Mise à jour de l'affichage.
    $('#js-contact-form').hide();
    refreshAddressBook();

    return false;
}

    /* 
     * clicker sur le button 'effacer le carnet d'adress'
     * il faut :
     *   1. Affichier le carnet vide ( = n'affiche rien)
     *   2. Cacher le formulaire 
     *   3. Effacer les infos saisis avant afin de réutiliser le formualire vide
     *      pour le nouveau contact
     */

function onClickClearAddressBook()
{
    // Sauvegarde d'un carnet d'adresse vide, écrasant le carnet d'adresse existant.
    saveAddressBook(new Array());       // 1.

    // Mise à jour de l'affichage.
    $('#js-contact-details').hide();    // 2.
    refreshAddressBook();               // 3.

}

    /*
     * utilisateur click sur son nom dans le carnet d'adress, il faut :
     * affichier tous les infos qu'il a saisis
     */

function onClickShowContactDetails()
{
    var addressBookArray;    //grande boite
    var contactObject;       // ptite boite
    var indexInt;            // pour parcourir le tableau 'addressBookArray'

    indexInt = $(this).data('index');

// Chargement du carnet d'adresses puis récupération du contact sur lequel on a cliqué.

    addressBookArray    = loadAddressBook();
    contactObject       = addressBookArray[indexInt];

    // Affichage HTML des données du contact, avec un hyperlien permettant son édition.

    $('#js-contact-details').html('<h3>' + contactObject.title
                                             + ' ' 
                                             + contactObject.firstName 
                                             + ' ' 
                                             + contactObject.lastName 
                                             + '</h3>'
                                             + '<p>'
                                             + contactObject.phone
                                             + '</p>'
                                     ).show();

}

/***************************************************************************************/
/***************************** FONCTIONS CARNET D'ADRESSES *****************************/
/***************************************************************************************/

function createContact(titleString, firstNameString, lastNameString, phoneString)
{
	var contactObject;

	contactObject           = new Object();    // création d' 1 nouveau Obj
	contactObject.firstName = firstNameString; // attacher firstName à cet Obj
	contactObject.lastName  = lastNameString.toUpperCase();
	contactObject.phone     = phoneString;

	switch(titleString)
	{
		case 'madam':
    		contactObject.title = 'Mme.';
    		break;

		case 'miss':
    		contactObject.title = 'Mlle.';
    		break;

		case 'mister':
    		contactObject.title = 'M.';
    		break;
	}

    return contactObject;
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
	// Affichage HTML du carnet d'adresses, un contact à la fois.

    var addressBookArray = loadAddressBook();
    //récupérer le carnet d'address pour faire la boucle

    $("#js-address-book").empty();// effacer le carnet d'addresse avant de refreshir

	for(var indexInt = 0; indexInt < addressBookArray.length; indexInt++)
	{
        console.log(addressBookArray);// result = Array [ Object ]


		// Chaque contact est un hyperlien <a> entouré d'une balise HTML <li>.
        // x+=y -> x=x+y / x*=y -> x=x*y
        $("#js-address-book").append
    (
        '<li>' +
            '<a data-index="' + indexInt + '" href="#">' +
            addressBookArray[indexInt].firstName + ' ' +
            addressBookArray[indexInt].lastName +
            '</a>' +
        '</li>'
    );

	}

	// Installation d'un gestionnaire d'évènement sur chaque hyperlien <a>.

    //installEventHandlers('#js-address-book a', 'click', onClickShowContactDetails);
    $(function()
    {
            $("#js-address-book a").click(onClickShowContactDetails);
    });
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
        $("#js-add-contact").click(onClickAddContact);
        $("#js-save-contact").click(onClickSaveContact);
        $("#js-clear-address-book").click(onClickClearAddressBook);
        refreshAddressBook();
    }
);

