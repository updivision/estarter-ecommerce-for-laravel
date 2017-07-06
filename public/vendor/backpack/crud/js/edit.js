/*
*
* Backpack Crud / Edit
*
*/

jQuery(function($){
    'use strict';

	$(document).ready(function() {
		// Go to tab from url hash
		$(function(){
		  var hash = window.location.hash;
		  hash && $('ul.nav a[href="' + hash + '"]').tab('show');

		  $('.nav-tabs a').click(function (e) {
		    $(this).tab('show');
		    var scrollmem = $('body').scrollTop() || $('html').scrollTop();
		    window.location.hash = this.hash;
		    $('html,body').scrollTop(scrollmem);
		  });
		});
	});

});
