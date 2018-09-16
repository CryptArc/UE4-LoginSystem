if(location.hash){
	loadPage();
}
	
function loadPage(){
	/* get hash */
	var hash = location.hash.replace("#","");
		
	/* add CSS first based on hash (prevent css snap) */
	var css_E = $('<link rel="stylesheet" type="text/css">');
	var css_H = "css/" + hash + ".css";
	if($('<link rel="stylesheet" type="text/css" href="' + hash + '.css">')){
		$('head').append(
			css_E.attr('href',css_H)
		);
	}
	
	/* Check if it's php or html. */
	if(hash == "profile"){
		loadPage(".php");
	}else{
		loadPage(".html");
	}
	/* load file or page into the main element. */
	function loadPage(format) {
		$("main").load("/pages/" + hash + format);	
	}
	
	/* load script */
	$.getScript("/js/" + hash + ".js");
}
	
window.addEventListener('hashchange', function(){
	loadPage();
});
	
/* Filter invalid symbols from the Login input. */
$("input[name=uid]").on("input paste",function(){
	var a = $(this);
	var b = a.val();
	var c = b.replace(/[^a-zA-Z0-9]/g,'');
	a.val(c);
});