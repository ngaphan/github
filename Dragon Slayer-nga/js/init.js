var dragons = {
	aquaDragon: {
		lifeLevelMax: 100,
		force: 10,
		defence: 5
	},
	volcanoDragon: {
		lifeLevelMax: 200,
		force: 20,
		defence: 10
	},
	stormDragon: {
		lifeLevelMax: 400,
		force: 40,
		defence: 20
	}
};

var weapons = {
	magicWand: {
		attack: 10
	},
	crossBow: {
		attack: 20
	},
	sword: {
		attack: 30
	}
};

var character = {
	lifeLevelMax: 300,
	armor: 15
};

var dragon = new Object();

/* 
On cré en avance l'objet "dragon", car dragon est 1 objet à part, il peut jouer seul et il peut être changé par 1 autre dragon , donc c'est 1 varible "dragon"*/

/* 
on peut créer l'objet weapon en avance comme ce-ci : (character.weapon = new Object();)dans le cas où l'on a besoin pour la suite.

mais ici , weapon ne peut pas jouer sans l'objet "character" . Donc "weapon" ici est juste 1 propriété qui va être attachée à "weapon".Alors on a pas besoin de créer cet objet. On attend lors de la demande au utilisateur, on récuperera et attachera directement au "character" une seule fois pour tous !*/

