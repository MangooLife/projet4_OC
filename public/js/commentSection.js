//2. Slider (Object Constructor) permettant de récuperer les différents contenus de notre slider (flèches, p et les images)
function CommentSection( element ) {
	// Attribut implémenté au niveau de l'instance
	this.el = document.querySelector( element );
	// Appel de la méthode init pour activer les différentes méthodes voulues
	this.init();
}

//3. Ajout de plusieurs méthodes pour Slider (Object Constructor)
CommentSection.prototype = {
	init: function() {
		this.commentsPart = document.querySelector(".listComments");
		this.emptyDiv();
	},

	emptyDiv: function(){
		if(this.commentsPart.children.length=== 0){
	        this.commentsPart.innerHTML = "Pas de commentaires pour le moment... <i class=\"far fa-comment-dots\"></i><hr/>";
	    } 
	}
}