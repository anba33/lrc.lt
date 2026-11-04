var rFactorReport = {};


$(function() {
	rFactorReport.TurnItOn("#menu");
	rFactorReport.Navigation("#menu", ".section");
	rFactorReport.Compactor(".section", "h4", ".subSection");
	$("#menu").find("a:first").click();
});



rFactorReport.TurnItOn = function (menu) {
	$(menu).find("a").each(function(){
		if( location.href.indexOf(this.href) != -1)  {
			$(this).addClass(" on");
		}
	});
}



rFactorReport.Navigation = function (linkList, section) {
	if ($(section).attr("id").length > 0 && location.hash) {
		$(location.hash).fadeIn("slow");
	}
	$(linkList).find("a").click(function() {
		if ($(this).size() > 0) {
			$(linkList).find("a").not(this).removeClass("on");
			$(this).addClass(" on");
			$("div" + section +":visible").not("#"+this.href.split("#")[1]).fadeOut("slow");
			$("#"+this.href.split("#")[1]).fadeIn("slow");
		}
		 else { 
			alert("This Link is not working."); 
		}
		return false;
	});
}



rFactorReport.Compactor = function ( list, link, item ) {
	if ($(list).length > 0 && location.hash) {
		here = location.hash;
		$(here).parent("div:hidden").prev().click();
		$(here).next(":hidden").slideDown("slow");
	}
	$(list).find(link).addClass("link")
		.hover( function () {
			$(this).addClass(" linkOver");
		}, function () {
			$(this).removeClass("linkOver");
		}).toggle( function () {
			$(this).addClass(" linkOn").next(item+":hidden").slideDown("slow");
		}, function () {
			$(this).removeClass("linkOn").next(item+":visible").slideUp("slow");
	});
}


