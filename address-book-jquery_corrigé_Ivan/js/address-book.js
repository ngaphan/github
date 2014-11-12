/***************************************************************************************/
/***************************** DONNEES CARNET D'ADRESSES *******************************/
/***************************************************************************************/

const DOM_STORAGE_ITEM_NAME = 'Address Book';



/***************************************************************************************/
/**************************** EVENEMENTS CARNET D'ADRESSES *****************************/
/***************************************************************************************/

function onClickAddContact()
{
    // Effacement du contenu du formulaire.
    $('#js-contact-form input[type=text]').val(null);

    // Mise à jour de l'affichage.
    $('#js-contact-form').show();
}

function onClickClearAddressBook()
{
    // Sauvegarde d'un carnet d'adresse vide, écrasant le carnet d'adresse existant.
    saveAddressBook(new Array());

    // Mise à jour de l'affichage.
    $('#js-contact-details').hide();
    refreshAddressBook();
}

function onClickSaveContact()
{
    var addressBookArray;
    var contactObject;

    // Création d'un objet contact avec les données du formulaire.
    contactObject = createContact
    (
        $('#js-contact-form select#title').val(),
        $('#js-contact-form input#firstName').val(),
        $('#js-contact-form input#lastName').val(),
        $('#js-contact-form input#phone').val()
    );

    /*
     * Le carnet d'adresses est un tableau d'objets.
     *
     * 1. Chargement du carnet d'adresses
     * 2. Ajout du contact à la fin,
     *    le carnet d'adresses est considéré comme une pile de contacts
     * 3. Sauvegarde du carnet d'adresses avec le nouveau contact
     */
    addressBookArray = loadAddressBook();
    addressBookArray.push(contactObject);
    saveAddressBook(addressBookArray);

    // Mise à jour de l'affichage.
    $('#js-contact-form').hide();
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

function onClickShowContactDetails()
{
    var addressBookArray;
    var contactObject;
    var contactElementObject;
    var indexInt;

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
    indexInt = $(this).data('index');

    // Chargement du carnet d'adresses puis récupération du contact sur lequel on a cliqué.
    addressBookArray = loadAddressBook();
    contactObject = addressBookArray[indexInt];

    // Affichage HTML des données du contact, avec un hyperlien permettant son édition.
    $('#js-contact-details').html(
        '<h3>' + contactObject.title + ' ' + contactObject.firstName + ' ' + contactObject.lastName + '</h3>'
        + '<p>' + contactObject.phone + '</p>'
    );

    // Mise à jour de l'affichage.
    $('#js-contact-details').show();
}



/***************************************************************************************/
/***************************** FONCTIONS CARNET D'ADRESSES *****************************/
/***************************************************************************************/

function createContact(titleString, firstNameString, lastNameString, phoneString)
{
	var contactObject;

	contactObject           = new Object();
	contactObject.firstName = firstNameString;
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

function loadAddressBook()
{
	var addressBookArray;

	// Chargement du carnet d'adresses depuis le DOM storage.
	addressBookArray = loadDataFromDomStorage(DOM_STORAGE_ITEM_NAME);

	// Est-ce qu'il n'y avait aucune donnée dans le DOM storage ?
	if(addressBookArray == null)
	{
		// Oui, création d'un carnet d'adresses vide.
		addressBookArray = new Array();
	}

	return addressBookArray;
}

function refreshAddressBook()
{
	var addressBookArray = loadAddressBook();

	// Suppression de l'ensemble du carnet d'adresses HTML.
	$('#js-address-book').empty();

	// Affichage HTML du carnet d'adresses, un contact à la fois.
	for(var indexInt = 0; indexInt < addressBookArray.length; indexInt++)
	{
		// Chaque contact est un hyperlien entouré d'une balise HTML <li>.
		$('#js-address-book').append(
			'<li>' +
				'<a data-index="' + indexInt + '" href="#">' + 
					addressBookArray[indexInt].firstName + ' ' + 
					addressBookArray[indexInt].lastName + 
				'</a>' +
			'</li>'
        );
	}

	// Installation d'un gestionnaire d'évènement sur chaque hyperlien.
    $('#js-address-book a').click(onClickShowContactDetails);
}

function saveAddressBook(addressBookString)
{
	// Enregistrement du carnet d'adresses dans le DOM storage.
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
    // Installation des gestionnaires d'évènements.
    $('#js-add-contact').click(onClickAddContact);
    $('#js-clear-address-book').click(onClickClearAddressBook);
    $('#js-save-contact').click(onClickSaveContact);

    // Affichage initial du carnet d'adresses.
    refreshAddressBook();
});
