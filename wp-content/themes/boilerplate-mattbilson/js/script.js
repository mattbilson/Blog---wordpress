/*
	Any site-specific scripts you might have.
	Note that <html> innately gets a class of "no-js".
	This is to allow you to react to non-JS users.
	Recommend removing that and adding "js" as one of the first things your script does.
	Note that if you are using Modernizr, it already does this for you. :-)
*/


$(function() {
	setupFootnote();
});

function setupFootnote() {
	
	var container = $("footer #latest-tweet a");
	var footnoteContent = container.text();
	var footnoteWords = footnoteContent.split(" ");
	var output = "";
	for(var i = 0; i < footnoteWords.length; i++) {
		output += '<span>' + footnoteWords[i] + '</span> ';
	}
	output.substring(0, output.length-1);
	container.html(output);
	footer = $('footer');
	
	footer.mouseover(function() {
		container.find('span').addClass(function() {
			return "textColor" + (($(this).index() % 5) + 1);
		})
	});
	footer.mouseout(function() {
		container.find('span').attr("class", "");
	});
}

function popup(name, options) {
	window.open(event.currentTarget.href, name, options);
	return false;
}