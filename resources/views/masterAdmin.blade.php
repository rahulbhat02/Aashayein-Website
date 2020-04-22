<!DOCTYPE html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Panel</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="{{ asset('css/styleAdmin.css') }}">

    <!-- page specific styles -->
    @yield('pagespecificstyles')

</head>

<body>
    <div id="floating">
        <div class="title">

            Admin Panel

            <span id="nav_button" style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776; </span>
        </div>
        <hr />
        <div id="side_nav">
            <div id="mySidenav" class="sidenav">
                <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
                <a href="/admin/posts">Edit posts</a>
                <a href="/admin/top_posts">Edit Top Posts</a>
                <a href="/admin/carousel">Edit Carousel</a>
                <a href="/admin/trendPosts">Edit Trending Posts</a>
                <a href="/admin/editorspick">Edit Editors's Pick</a>
                <a href="/admin/info">Edit Info</a>
                <a href="/admin/siteSettings">Site Settings</a>
                <a href="/admin/changePassword">Change Password</a>
                <a href="/admin/logout">Logout</a>

            </div>



        </div>
    </div>


    @yield('content')

</body>
<script>
function openNav() {
    document.getElementById("mySidenav").style.width = "150px";
}

function closeNav() {
    document.getElementById("mySidenav").style.width = "0";
}
var addSerialNumber = function() {
    $('table tr').each(function(index) {
        $(this).find('td:nth-child(1)').html(index);
    });
};



addSerialNumber();

    @yield('pagespecificscripts')
</script>

</html>