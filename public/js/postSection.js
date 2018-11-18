//2. PostSection (Object Constructor) permettant de récuperer les différents contenus de notre slider (flèches, p et les images)
function PostSection( element ) {
	// Attribut implémenté au niveau de l'instance
	this.el = document.querySelector( element );
	// Appel de la méthode init pour activer les différentes méthodes voulues
	this.init();
}

//3. Ajout de plusieurs méthodes pour PostSection (Object Constructor)
PostSection.prototype = {
	init: function() {
		this.ajoutPostElt = document.querySelector(".ajoutPost");
		this.annulerPostElt = document.querySelector(".annuler");
		this.action();
	},

	action: function(){
		this.showPostEdit();
		this.hidePostEdit();
	},

	showPostEdit: function(){
		this.ajoutPostElt.addEventListener('click', function(){
			this.el.style.display = 'block';
			this.el.style.width = '70%';
		}.bind(this));
	},

	hidePostEdit: function(){
		this.annulerPostElt.addEventListener('click', function(){
			this.el.style.display = 'none';
			this.el.style.width = '0%';
		}.bind(this));
	}
}

document.addEventListener( "DOMContentLoaded", function() {
	///*
	//* POSTSECTION.JS
	var postSection = new PostSection( ".formPost" );
});