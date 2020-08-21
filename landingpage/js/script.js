/*navbar start*/
$('.menu').click(function(){
	$(this).toggleClass('is-active');
	$('header nav').toggleClass('open');
});
$(window).scroll(function(){
    if($(this).scrollTop()==0){
        $('header').removeClass('active');
    }else{
        $('header').addClass('active');
    }
});
/*navbar end*/
/* persnol space start*/
function attibuteHandle(){
	if(window.innerWidth>1300){
		for(var div of document.querySelectorAll('[pc]')) {
	     var field = div.getAttribute('pc');
	     div.style.height=field+'px'; 		    
	  }
	}
	else if(window.innerWidth<991 && window.innerWidth>1300){
		for(var div of document.querySelectorAll('[pc]')) {
	     var field = div.getAttribute('pc');
			if(field > 150)
	     		div.style.height=(field-50)+'px'; 		    
	  		else
	     		div.style.height=field+'px'; 		    
	  	}
	}
	else if(window.innerWidth < 991 && window.innerWidth>786){
		for(var div of document.querySelectorAll('[tb]')) {
	     var field = div.getAttribute('tb');
	     div.style.height=field+'px'; 		    
	  }
	}
	else{
		for(var div of document.querySelectorAll('[mb]')) {
		     var field = div.getAttribute('mb');	 		    
			 div.style.height=field+'px';
		}
	}
}attibuteHandle();
window.onresize = function(event) {
	attibuteHandle();
};
/* persnol space start*/
/* testimonail */
	var m=0;
	var cardCount=$('.rotating-cards div').length;
	var currentCard=0;
    for(var i=0;i<cardCount;i++){
	    if($('.rotating-cards div')[i].offsetHeight>m)
	        m=$('.rotating-cards div')[i].offsetHeight;
    }
	$('.rotating-cards').css('height',m+'px');
	function setCards(){
        for(var i=0;i<cardCount;i++){
            $('.rotating-cards div')[i].classList.remove("current");
            $('.rotating-cards div')[i].classList.remove("next");
            $('.rotating-cards div')[i].classList.remove("prev");
            $('.rotating-cards div')[i].classList.remove("back");
            if(i==currentCard)
                $('.rotating-cards div')[i].classList.add("current");
            else if(i==(currentCard+1)%cardCount)
                $('.rotating-cards div')[i].classList.add("next");
            else if(i==(currentCard-1+cardCount)%cardCount)
                $('.rotating-cards div')[i].classList.add("prev");
            else $('.rotating-cards div')[i].classList.add("back");
        }
	}
	setCards();
	function rotateCardsLeft(){
	    currentCard=(currentCard+1)%cardCount;
    	setCards();
	}
	function rotateCardsRight(){
        currentCard=(currentCard-1+cardCount)%cardCount;
    	setCards();
	}