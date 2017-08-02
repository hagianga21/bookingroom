<!DOCTYPE html>
<html>
<head>
<style>
table {
    font-family: arial, sans-serif;
    border-collapse: collapse;
    width: 70%;
    margin: auto;
}
td, th {
    border: 1px solid #dddddd;
    text-align: center;
    padding: 8px;
}
th{
    background-color: #004dc6;
    color: #ffffff;
}
tr:nth-child(even) {
    background-color: #9ebdef;
}
#title{
    text-align: center;
    color: red;
}
#clear{

}
</style>
</head>
<body>
<div id="image"><center><img src="./image/logo.png" alt="Northern Lights"></center></div>
<div id="title"><h1>LIST ROOM IN MEETING ROOM BOOKING SYSTEM</h1></div>
<table>
    <tr>
        <th>ROOM ID</th>
        <th>ROOM NAME</th>
    </tr>
<?php
include "ViewListRoom.php";
?>
</table>
<div id="clear">    </div>
</body>
</html>
