function toggleMobileNavbar(){
    if($('.nw-navbar').hasClass('nw-smallnavbar')){
	    $('.nw-navbar').show();
        $('.nw-navbar').removeClass('nw-smallnavbar');
    }else{
        $('.nw-navbar').addClass('nw-smallnavbar');
        setTimeout(function(){
            $('.nw-navbar').hide();
        },300);
    }
}
(function(){
	window.onload=function(){
		var btns=document.getElementsByClassName('nw-toggle');
		for (var i = btns.length - 1; i >= 0; i--)(function(i){
			if(window.innerWidth<900){
				btns[i].children[0].innerHTML='close';
			}
			btns[i].onclick=function(){
				var par=btns[i].parentElement.parentElement;
				if(window.innerWidth>900){
					if(par.className=="nw-navbar")
						par.className="nw-small-navbar";
					else if(par.className=="nw-small-navbar")
						par.className="nw-navbar";
				}else{
				    toggleMobileNavbar();
				}
			}			
		})(i);
		var items=document.querySelectorAll('.nw-body ul li a');
		for (var i = items.length - 1; i >= 0; i--)(function(i){
			items[i].onclick=function(){
				if(items[i].className.indexOf('nw-expandable')==-1){
					items.forEach(function(e){
						e.parentElement.classList.remove('active-page');
					});
					items[i].parentElement.classList.add("active-page");
				}else{
					items.forEach(function(e){
						if(e!=items[i] && e.parentElement.className.indexOf('nw-open')>=0){
							e.parentElement.classList.remove('nw-open');
							$('ul',e.parentElement).slideUp();
						}
					});
					items[i].parentElement.classList.toggle("nw-open");
					$('ul',items[i].parentElement).slideToggle();
				}
			}			
		})(i);
	};
})();