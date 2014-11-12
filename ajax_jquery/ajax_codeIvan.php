// On définit une variable globale
// permettant de stocker l'identifiant de l'utilisateur

var userId = 0;

// Fonction de connection au t'chat du nouvel utilisateur
function userConnect()
{
$.ajax({
// On définit l'URL appelée
url: 'http://192.168.1.95/tchatRomain/API/index.php',
// On définit la méthode HTTP
type: 'GET',
// On définit les données qui seront envoyées
data: {
action: 'userAdd',
userNickname: $('#userNickname').val()
},
// l'équivalent d'un "case" avec les codes de statut HTTP
statusCode: {
// Si l'utilisateur est bien créé
201: function (response) {
// On stocke l'identifiant récupéré dans la variable globale userId
window.userId = response.userId;
// On masque la fenêtre, puis on rafraichit la liste de utilisateurs
// (à faire...)
},
// Si l'utilisateur existe déjà
208: function (response) {
// On fait bouger la fenêtre de gauche à droite
// et de droite à gauche 3 fois
// (à faire...)
}
}
})
}
