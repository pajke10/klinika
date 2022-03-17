<?php
include "db.php";
session_start();
function checkSlots($mysqli, $date, $resource){
    $stmt = $mysqli->prepare("select * from zakazivanje where date = ? AND resource_id=?");
    $stmt->bind_param('ss', $date, $resource);
    $totalbookings = 0;
    if($stmt->execute()){
        $result = $stmt->get_result();
        if($result->num_rows>0){
            while($row = $result->fetch_assoc()){
                $totalbookings++;
            }
            
            $stmt->close();
        }
    }
    return $totalbookings;
}

function build_calendar($month, $year, $resource){

    global $mysqli;
    //We will get all rooms here
    $stmt = $mysqli->prepare('select * from doktori');
    $resources = "";
    $first_resource = 0;
    $i = 0;
    if($stmt->execute()){
        $result = $stmt->get_result();
        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
                if($i==0){
                    $first_resource = $row['id'];
                }
                $resources.= "<option value='".$row['id']."'>".$row['name']."</option>";
                $i++;
            }
            $stmt->close();
        }
    }
    
    if($resource!=0){
        $first_resource = $resource;
    }
    
    $stmt = $mysqli->prepare('select * from zakazivanje where MONTH(date) = ? AND YEAR(date) = ? AND resource_id = ?');
    $stmt->bind_param('ssi', $month, $year, $first_room);
    $bookings = array();
    if($stmt->execute()){
        $result = $stmt->get_result();
        if($result->num_rows > 0){
            while($row = $result->fetch_assoc()){
                $bookings[] = $row['date'];
            }
            $stmt->close();
        }
    }
    
    
    $daysOfWeek = array('Nedelja', 'Ponedeljak', 'Utorak', 'Sreda', 'Cetvrtak', 'Petak', 'Subota');
    $firstDayOfMonth = mktime(0, 0, 0, $month, 1, $year);
    $numberDays = date('t', $firstDayOfMonth);
    $dateComponents = getdate($firstDayOfMonth);
    $monthName = $dateComponents['month'];
    $dayOfWeek = $dateComponents['wday'];
    $dateToday = date('Y-m-d');
    
    $prev_month = date('m', mktime(0, 0, 0, $month-1, 1, $year));
    $prev_year = date('Y', mktime(0, 0, 0, $month-1, 1, $year));
    $next_month = date('m', mktime(0, 0, 0, $month+1, 1, $year));
    $next_year = date('Y', mktime(0, 0, 0, $month+1, 1, $year));
    $calendar = "<center><h2>$monthName $year</h2>";
    $calendar.= "<a class='btn btn-primary btn-xs' href='?month=".$prev_month."&year=".$prev_year."'>Prethodni mesec</a> ";
    $calendar.= "<a class='btn btn-primary btn-xs' href='?month=".date('m')."&year=".date('Y')."'>Trenutni mesec</a> ";
    $calendar.= "<a class='btn btn-primary btn-xs' href='?month=".$next_month."&year=$next_year'>Sledeci mesec</a></center>";
    $calendar.= "
    <form id='resource_select_form'>
    <div class='row'>
    <div class='col-md-6 col-md-offset-3 form-group'>
    <label>Select Resource</label>
    <select class='form-control' id='resource_select' name='resource'>
    ".$resources."
    </select>
    <input type='hidden' name='month' value='".$month."'>
    <input type='hidden' name='year' value='".$year."'>
    </div>
    </div>
    </form>
    
    
    <table class='table table-bordered'>";
    $calendar.= "<tr>";
    foreach($daysOfWeek as $day){
        $calendar.= "<th class='header'>$day</th>";
    }
    
    $calendar.= "</tr><tr>";
    $currentDay = 1;
    if($dayOfWeek > 0){
        for($k = 0; $k < $dayOfWeek; $k++){
            $calendar.= "<td class='empty'></td>";
        }
    }
    
    $month = str_pad($month, 2, "0", STR_PAD_LEFT);
    while($currentDay <= $numberDays){
       if($dayOfWeek == 7){
           $dayOfWeek = 0;
           $calendar.= "</tr><tr>";
       }

       $currentDayRel = str_pad($currentDay, 2, "0", STR_PAD_LEFT);
       $date = "$year-$month-$currentDayRel";
       $dayname = strtolower(date('l', strtotime($date)));
       $eventNum = 0;
       $today = $date==date('Y-m-d')? "today" : "";
       if($dayname=='sunday' || $dayname==''){
         $calendar.="<td><h4>$currentDay</h4> <button class='btn btn-danger btn-xs'>Neradan</button>";
     }elseif($date<date('Y-m-d')){
       $calendar.="<td><h4>$currentDay</h4> <button class='btn btn-danger btn-xs'>N/A</button>";
   }else{
       $calendar.="<td class='$today'><h4>$currentDay</h4> <a href='book.php?date=$date&resource=$resource' class='btn btn-success btn-xs'>Zakazi</a> <small><i></i></small>";
   }


   $currentDay++;
   $dayOfWeek++;

}

if($dayOfWeek<7){
    $remainingDays = 7 - $dayOfWeek;
    for($i=0; $i<$remainingDays; $i++){
        $calendar.= "<td class='empty'></td>";
    }
}

$calendar.= "</tr></table>";



return $calendar;

}

?>
<html>
<head>   
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
    <!-- ----------------------------------------------------------------------------------------------------------------------------------------- -->
    
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    
    <!-- +++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++ -->
    <script src="jquery-3.5.1.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="css/calendar_css.css">
</head>

<body>
    <?php include "includes/nav_cal.php"; ?>
    <div class="container">
        <div class="row" style="padding-bottom:50px">
            <div class="col-md-12">
                <?php
                $dateComponents = getdate();
                if(isset($_GET['month']) && isset($_GET['year'])){
                    $month = $_GET['month'];
                    $year = $_GET['year'];
                }else{
                    $month = $dateComponents['mon'];
                    $year = $dateComponents['year'];
                }
                
                if(isset($_GET['resource'])){
                    $resource = $_GET['resource'];
                }else{
                    $resource = 1;
                }
                
                echo build_calendar($month, $year, $resource);
                
                ?>

            </div>
        </div>
        <div>
            <table class="table">
              <thead>
                <tr>
                    <th style="text-align: center;">Ordinacije</th>
                </tr>
            </thead>
            <tbody>
                <tr>        
                    <?php 
                      $ord = $mysqli->prepare('select * from ordinacija');
                    if ($ord->execute()) {
                        $result1 = $ord->get_result();                    
                        if ($result1->num_rows > 0 ) {
                           while ($row=$result1->fetch_assoc()) { ?>                         
                               <td><input type="button" name="view" value="<?php echo $row["name_o"]; ?>" id="<?php echo $row["id"]; ?>" class="btn btn-info btn-xs view_data" /></td>  
                           <?php   }
                       }                                          
                   }

                   ?>
               </tr>
           </tbody>
       </table>
   </div>


</div>
<!-- <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>


<script>
    $("#resource_select").change(function(){
       $("#resource_select_form").submit(); 
   });

    $(document).ready(function() {
        $('#resource_select').select2({
            placeholder:'Select',
            width:'100%'
        });
    });


    $("#resource_select option[value='<?php echo $resource; ?>']").attr('selected', 'selected');


</script>
<div id="dataModal" class="modal fade">  
  <div class="modal-dialog">  
     <div class="modal-content">  
        <div class="modal-header">  
           <h4 class="modal-title">Zauzetost ordinacije na dan <?php echo $datum = date("d/m/Y"); ?></h4>  
           <button type="button" class="close" data-dismiss="modal">&times;</button>
       </div>  
       <div class="modal-body" id="employee_detail">  
       </div>  
       <div class="modal-footer">  
           <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> 
       </div>  
   </div>  
</div>  
</div>  
<script>  
   $(document).ready(function(){  
      $('.view_data').click(function(){ 
         var employee_id = $(this).attr("id");
         $.ajax({
            url:"select.php",
            method:"post",
            data:{employee_id:employee_id},
            success:function(data){
               $('#employee_detail').html(data);
               $('#dataModal').modal(show);
           }
       })
         $('#dataModal').modal("show");
     });  
  });  
</script>


</body>
</html>
