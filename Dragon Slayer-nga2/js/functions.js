function attack(attackerSide)
{
	if (attackerSide == 0) // Le personnage attaque
	{
		var hitPoints = hitPointsCalculate(character.weapon.attack);
		
		document.write("Le personnage attaque (" + hitPoints + ")<br>");
		
		if (dragon.defence < hitPoints)
		{
			dragon.lifeLevel -= hitPoints - dragon.defence;
			// dragon.lifeLevel = dragon.lifeLevel - hitPoints + dragon.defence;
			
			document.write("Le dragon subit " + (hitPoints - dragon.defence) + " de dégats.<br>");
			document.write("Sa nouvelle vie est de " + dragon.lifeLevel + ".<br>");
		}
		else
		{
			document.write("Dragon: \"Reviens me voir dans 20 kilos !\"<br>");
		}

		if (dragon.lifeLevel > 0)
		{
			attack(1);
		}
		else
		{
			document.write("Le dragon est mort ce soir...");
		}
	}
	else // Le dragon attaque
	{
		var hitPoints = hitPointsCalculate(dragon.force);
		
		document.write("Le dragon attaque (" + hitPoints + ")<br>");
		
		if (character.armor < hitPoints)
		{
			character.lifeLevel -= hitPoints - character.armor;
			// character.lifeLevel = character.lifeLevel - hitPoints + character.armor;
			
			document.write("Le personnage subit " + (hitPoints - character.armor) + " de dégats.<br>");
			document.write("Sa nouvelle vie est de " + character.lifeLevel + ".<br>");
		}
		else
		{
			document.write("Personnage: \"Dragon de pacotille !\"<br>");
		}

		if (character.lifeLevel > 0)
		{
			attack(0);
		}
		else
		{
			document.write("Il n'y a que des héros morts...");
		}
	}
}

function hitPointsCalculate(hitPointsOrigin)
{
	var hitPointsNew = hitPointsOrigin - (hitPointsOrigin * (Math.random()/2));

	return Math.round(hitPointsNew);
}



/*
character.weapon.attack :
attack: proprité de waeapon;
weapon:proprité de character;
character : grandparent de attack .

les [] entre les [] permet d'appeler directment les proprités de n'importe quel niveau, de n'importe quel objet. On met juste 1 point (.) et le nom de la propriété qu'on veut

*/