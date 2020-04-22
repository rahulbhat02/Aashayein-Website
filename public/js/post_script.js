$(".trigger_popup_fricc").click(function(){
       $('.hover_bkgr_fricc').show();
    });
    $('.hover_bkgr_fricc').click(function(){
        $('.hover_bkgr_fricc').hide();
    });
    $('.popupCloseButton').click(function(){
        $('.hover_bkgr_fricc').hide();
    });

$(document).ready(function(){
    $(".up,.down").click(function(){
        var row = $(this).parents("tr:first");
        if ($(this).is(".up")) {
            row.insertBefore(row.prev());
        } else if ($(this).is(".down")) {
            row.insertAfter(row.next());
        }
    });
});



var ind = {};



function  getId(element) {
	
	 var x = document.getElementsByClassName(element);
	 for (i = 0; i < x.length;i++) {
		 var d = x[i].rowIndex;
	 }
	 ind[d] = element; 

 
}



var addSerialNumber1 = function () {
    $('.table1 tr').each(function(index) {
        $(this).find('td:nth-child(1)').html(index);
    });
};
var addSerialNumber2 = function () {
    $('.table2 tr').each(function(index) {
        $(this).find('td:nth-child(1)').html(index);
    });
};




addSerialNumber1();
addSerialNumber2();

/*$('table').on('click', '.move-up', function () {
    var thisRow = $(this).closest('tr');
    var prevRow = thisRow.prev();
    if (prevRow.length) {
        prevRow.before(thisRow);
    }
});

$('table').on('click', '.move-down', function () {
    var thisRow = $(this).closest('tr');
    var nextRow = thisRow.next();
    if (nextRow.length) {
        nextRow.after(thisRow);
    }
	alert("yes");
});*/


function actionFunc() {
	var arrayOfElements=document.getElementsByClassName('arrange_button');
var lengthOfArray=arrayOfElements.length;

for (var i=0; i<lengthOfArray;i++){
    arrayOfElements[i].style.display='none';
}

var arrayOfElements=document.getElementsByClassName('action_buttons');
var lengthOfArray=arrayOfElements.length;

for (var i=0; i<lengthOfArray;i++){
    arrayOfElements[i].style.display='block';
}


	document.getElementById("add_button").style.display = "none"; 

	document.getElementById("done_button").style.display = "block"; 
}

