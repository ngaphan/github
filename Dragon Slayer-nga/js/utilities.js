
function installEventHandlers(selectorString, eventString, eventHandlerFunction)
{
    var DOMObjects;

    // Récupération de tous les objets DOM correspondant au sélecteur.
    DOMObjects = document.querySelectorAll(selectorString);

    // Installation d'un gestionnaire d'évènement sur chaque objet DOM.
    for(var index = 0; index < DOMObjects.length; index++)
    {
        DOMObjects[index].addEventListener(eventString, eventHandlerFunction);
    }
}
