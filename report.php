<?php
// reference the Dompdf namespace
include 'connection.php';
require_once 'vendor/autoload.php';
$data="select * from items where status='0'";
$datarun=mysqli_query($conn,$data);
$rows=mysqli_fetch_all($datarun,MYSQLI_ASSOC);
$totalminprice =0;




use Dompdf\Dompdf;
$html='<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>items on bid</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<style>
td,th{
border: 2px solid #ddd;
}
</style>
    <div style="background: #7C125; padding-left: 4rem;">
        <div class="tems">

        <h2>Items On Bids</h2>
        <table style="border-collapse: collapse; border: 2px solid #6AE512">
            <thead>
            <tr>
                <th>Item name</th>
                <th>Min Price</th>
                <th>Max Price</th>
                <th>Livestock name</th>
            </tr>
            </thead>
            <tbody>
        ';



foreach ($rows as $row){
    $html .='<tr>
            <td>'.$row['item_name'].'</td>
            <td>'.$row['min_price'].'</td>
            <td>'.$row['max_price'].'</td>
            <td>'.$row['livestock_name'].'</td>
</tr>';
    $totalminprice +=$row['min_price'];
}
$html .= '<tr>
            <th>Total Min price</th>
            <th>'.$totalminprice.'</th>
</tr>';
$html .= '</tbody>
        </table>
        </div>
    </div>
</body>
</html>';
// instantiate and use the dompdf class
$dompdf = new Dompdf();
$dompdf->loadHtml($html);

// (Optional) Setup the paper size and orientation
$dompdf->setPaper('A4', 'landscape');

// Render the HTML as PDF
$dompdf->render();

// Output the generated PDF to Browser
$dompdf->stream('itemsonbid.pdf', array('Attachment' => 0));
?>


