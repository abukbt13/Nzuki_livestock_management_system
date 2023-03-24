<?php
// reference the Dompdf namespace
include '../connection.php';
require_once '../vendor/autoload.php';
$data="select b.item_name, b.bid_amount,b.date, i.min_price from biddings b join items i on i.id=b.item_id  where b.status='0'";
$datarun=mysqli_query($conn,$data);
$rows=mysqli_fetch_all($datarun,MYSQLI_ASSOC);
$totalminprice =0;




use Dompdf\Dompdf;
$html= '<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>items on bid</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
<style>
td,th{
border: 2px solid #ddd;
}
</style>
    <div style="background: #7C125; padding-left: 4rem;">
        <div class="tems">

        <h2 style="text-align: center;">Products On Bids</h2>
        
        <table style="border-collapse: collapse; border: 2px solid #6AE512">
            <thead>
            <tr>
                <th>Item name</th>
                <th>Amount</th>
                <th>min_price</th>
                <th>Date</th>
            </tr>
            </thead>
            <tbody>
        ';



foreach ($rows as $row){
    $html .='<tr>
            <td>'.$row['item_name'].'</td>
            <td>'.$row['amount'].'</td>
            <td>'.$row['min_price'].'</td>
            <td>'.$row['date'].'</td>
</tr>';
}
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
$dompdf->stream('biddedproducts.pdf', array('Attachment' => 0));
?>


