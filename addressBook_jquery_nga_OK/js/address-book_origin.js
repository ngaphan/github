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
    clearForm('#js-contact-form');

    // Mise à jour de l'affichage = afficher le formulaire vide.
    showHtml('#js-contact-form');
}


//click sur le bouton " enregister/valider "
function onClickSaveContact()
{
    var contactObject;   // petite boite contient les infos d'un seul contact
    var addressBookArray;// grande boite pr ranger les ptites boites
    

    // Création d'un seul objet contact avec les données du formulaire= petite boite.
    contactObject = createContact
    (
        getFormFieldValue('js-contact-form', 'title'),
        getFormFieldValue('js-contact-form', 'firstName'),
        getFormFieldValue('js-contact-form', 'lastName'),
        getFormFieldValue('js-contact-form', 'phone')
    );

     // Les 4 lignes entre () au-dessus corresponendent à 4 params attendus de la fonction 
     // 'createContact' définie ci-dessous
     
    /*
     * Le carnet d'adresses est un tableau d'objets.
     *
     * 1. Chargement du carnet d'adresses ( c'est 1 tableau , la grande boite)
     * 2. Ajout du contact à la fin = insérer la petite boite dans la grande boite,
     *    le carnet d'adresses est considéré comme une pile de contacts
     * 3. Sauvegarde du carnet d'adresses(grande boite) avec le nouveau contact(ptite boite)
     */
    addressBookArray = loadAddressBook();// 1.
    addressBookArray.push(contactObject);// 2.
    saveAddressBook(addressBookArray);   // 3.

    // Mise à jour de l'affichage.
    hideHtml('#js-contact-form');
    refreshAddressBook();

    /*
     * L'évènement submit de formulaire ne doit pas s'exécuter.
     *
     * Le fait de retourner false dans un gestionnaire d'évènements permet
     * d'interrompre l'évènement dans le navigateur, qu'il n'y ait rien d'autre
     * qui s'exécute.
     */
    return false;//eviter on click plusirur fois dessus
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
    hideHtml('#js-contact-details');    // 2.
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
    var contactElementObject;// les infos dans l'Obj contact sont les éléments de cet Obj
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

    // Chargement du carnet d'adresses puis récupération du contact sur lequel on a cliqué.
    addressBookArray    = loadAddressBook();
    contactObject       = addressBookArray[indexInt];

    // Affichage HTML des données du contact, avec un hyperlien permettant son édition.
    contactElementObject            = document.getElementById('js-contact-details');
    contactElementObject.innerHTML  = '<h3>' + contactObject.title 
                                             + ' ' 
                                             + contactObject.firstName 
                                             + ' ' 
                                             + contactObject.lastName 
                                             + '</h3>';// en tout =  Mlle Nga PHAN
    contactElementObject.innerHTML += '<p>' + contactObject.phone + '</p>';

    // Mise à jour de l'affichage.
    showHtml('#js-contact-details');
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
    var addressBookArray;
	var addressBookElementObject;

	addressBookArray = loadAddressBook();
    console.log(addressBookArray);// result = Array [ Object ]

	// Suppression de l'ensemble du carnet d'adresses HTML.
	addressBookElementObject           = document.getElementById('js-address-book');
    console.log(addressBookElementObject);// = <ul id="js-address-book">


	addressBookElementObject.innerHTML = null;// effacer les infos précédemment saisi 
     console.log(addressBookElementObject.innerHTML);
     //result = "" (càd cet Obj existe mais = valeur null)

	// Affichage HTML du carnet d'adresses, un contact à la fois.
	for(var indexInt = 0; indexInt < addressBookArray.length; indexInt++)
	{
        console.log(addressBookArray);// result = Array [ Object ]


		// Chaque contact est un hyperlien <a> entouré d'une balise HTML <li>.
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
    installEventHandlers('#js-address-book a', 'click', onClickShowContactDetails);
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
document.addEventListener('DOMContentLoaded', function()
{
    // Installation des gestionnaires d'évènements. 4 choses à faire
    installEventHandler('#js-add-contact', 'click', onClickAddContact);//1     
    installEventHandler('#js-save-contact', 'click', onClickSaveContact);//2
    installEventHandler('#js-clear-address-book', 'click', onClickClearAddressBook);//3
    refreshAddressBook(); // 4

    // 1. click sur "ajouter un contact" : afficher le formulaire vide(default il est caché)   
    // 2. click sur "enregistrer/valider": save les infos dans la ptite boite oContact
    // 3. click sur "supp 1 contact"     : effacer l'Obj contact
    // 4. Affichage initial du carnet d'adresses: carnet vide, formulaire caché
    
});