@extends('masterAdmin')

@section('pagespecificstyles')
<link rel="stylesheet" href="{{ asset('css/adminPostStyle.css') }}">
@stop

@section('content')
<div id="main">

    <div class="hover_bkgr_fricc">
        <span class="helper"></span>
        <div>
            <div class="popupCloseButton">X</div>
            <div id="myForm">
                <h1>Select Post</h1>
                <table class="table2">

                    <tr>
                        <th width="10%">Sl no.</th>
                        <th width="70%">Title</th>
                        <th>Action</th>

                    </tr>
                    @foreach($posts2 as $value)
                    <tr id="{{ $value->id }}">

                        <td></td>

                        <td>{{ $value->heading }}</td>

                        <td>
                            <form method="post" action="{{ url('/admin/addCarousel') }}">
                                {{ csrf_field() }}
                                <input name="id" value="{{ $value->id }}" style="display:none">
                                <button type="submit" class="btn btn-outline-primary btn-sm">Add</button>
                            </form>

                        </td>
                    </tr>
                    @endforeach

                </table>
            </div>
        </div>
    </div>



    <h3>Carousel</h3>
    @if ($message = Session::get('success'))
    <div class="alert alert-success alert-block">
        <strong>{{ $message }}</strong>
    </div>
    @endif
    <div style="overflow-x:auto;">
        <table class="table1">
            <tbody>
                <tr>
                    <th width="10%">Sl no.</th>
                    <th width="50%">Title</th>
                    <th>Action</th>
                    <th>Remove</th>
                </tr>
                @foreach($posts as $value)
                <tr class="{{ $value->post_id }}">
                    <td></td>
                    <td>{{ $value->title }}</td>
                    <td class="arrange_button">
                        <button class="btn btn-outline-primary btn-sm " onclick="actionFunc()">Arrange</button>
                    </td>
                    <td class="action_buttons" style="display:none"><button
                            class="btn btn-outline-primary btn-sm up">Up</button>
                        <button class="btn btn-outline-primary btn-sm down">Down</button>
                    </td>

                    <td>
                        <form method="post" action="{{ url('/admin/removeCarousel') }}">
                            {{ csrf_field() }}
                            <input name="id" value="{{ $value->post_id }}" style="display:none">
                            <button type="submit" class="btn btn-outline-danger btn-sm">Remove</button>
                        </form>
                    </td>
                </tr>
                @endforeach

            </tbody>
        </table>

    </div>
    <a id="add_button" class="trigger_popup_fricc"><button class="btn btn-primary btn-sm ">Add</button></a>
    <div id="done_button" style="display:none">
        <form method="post" action="{{ url('/admin/arrangeCarousel') }}">
            {{ csrf_field() }}
            <input name="id" id="arrange" style="display:none">
            <button type="submit" onclick="clicked()" class="btn btn-outline-primary btn-sm">Done</button>
        </form>



    </div>



</div>
@endsection

@section('pagespecificscripts')



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
function clicked(){
	ind = {};
	@foreach ($posts as $val)
		getId("{{ $val->post_id }}");
	@endforeach
	
	ind = JSON.stringify(ind)
	document.getElementById("arrange").value = ind; 
}


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



@stop