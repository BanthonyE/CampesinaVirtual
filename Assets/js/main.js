/* $(document).ready(function(){
 
    if(window.innerWidth < 768){
        $('.btn').addClass('btn-sm');
    }
    
    // Medida por defecto (Sin ningún nombre de clase)
    else if(window.innerWidth < 900){
        $('.btn').removeClass('btn-sm');
    }
 
    // Si el ancho del navegador es menor a 1200 px le asigno la clase 'btn-lg' 
    else if(window.innerWidth < 1200){
        $('.btn').addClass('btn-lg');
    }
 
}); */
(function () {
	"use strict";

	var treeviewMenu = $('.app-menu');

	// Toggle Sidebar
	$('[data-toggle="sidebar"]').click(function(event) {
		event.preventDefault();
		$('.app').toggleClass('sidenav-toggled');
	});

	// Activate sidebar treeview toggle
	$("[data-toggle='treeview']").click(function(event) {
		event.preventDefault();
		if(!$(this).parent().hasClass('is-expanded')) {
			treeviewMenu.find("[data-toggle='treeview']").parent().removeClass('is-expanded');
		}
		$(this).parent().toggleClass('is-expanded');
	});

	// Set initial active toggle
	$("[data-toggle='treeview.'].is-expanded").parent().toggleClass('is-expanded');

	//Activate bootstrip tooltips
	$("[data-toggle='tooltip']").tooltip();

})();
