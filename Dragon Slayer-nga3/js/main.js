function modifyDragon()
{
	var dragonIdInt	  = this.dataset.dragonId;
	
	var tableRowId 	  = 'dragon_' + dragonId;
	var DOMObject 	  = document.getElementById(tableRowId);
	var dragonName    = document.querySelector('#' + tableRowId + ' .dragonName').innerText;
	var dragonLifeMax = document.querySelector('#' + tableRowId + ' .dragonLifeMax').innerText;
	var dragonForce   = document.querySelector('#' + tableRowId + ' .dragonForce').innerText;
	
	
	DOMObject.innerHTML = '<td colspan="5">'
		+ '	<form action="" method="post">'
		+ '		<input name="dragonName" value="' + dragonName + '" type="text">'
		+ '		<input name="dragonLifeMax" value="' + dragonLifeMax + '" type="numeric">'
		+ '		<input name="dragonForce" value="' + dragonForce + '" type="numeric">'
		+ '		<input name="dragonId" value="' + dragonName + '" type="hidden">'
		+ '		<input name="action" action="updateDragon" type="hidden">'
		+ '		<input value="METTRE À JOUR" type="submit">'
		+ '	</form>'
		+ '</td>'
}

document.addEventListener('DOMContentLoaded', function()
{
    installEventHandlers('#dragons a', 'click', modifyDragon);
});