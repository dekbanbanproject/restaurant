<link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' /> 
    <link href='https://fonts.googleapis.com/css?family=Kanit&subset=thai,latin' rel='stylesheet' type='text/css'>
<style>

    body {
        font-family: 'Kanit', sans-serif;
        font-size: 14px;   
        }

   
</style>
<?php
    use SimpleSoftwareIO\QrCode\Facades\QrCode;
?>
<body onload="window.print()">
    
    <table> 
        <tr >
            <td style="text-align: center">  
            {!! QrCode::size(100)->generate(asset('order_add/'.$table_group_1->table_group_1_name)); !!}  <br> <br>  
            โต๊ะ {{ $table_group_1->table_group_1_name}}<br> 
            โซน {{$table_group_1->table_group_1_zone }}             
            </td> 
           
        </tr>
    </table>    
  
</body>
        
                     
