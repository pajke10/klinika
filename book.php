<?php
include 'db.php';

if(isset($_POST['delete'])){
    $bookingid = $_POST['bookingid'];
    $stmt = $mysqli->prepare("delete from zakazivanje where id=?");
    $stmt->bind_param('i', $bookingid);
    $stmt->execute();
    $msg = "<div class='alert alert-success'>Pregled uspesno otkazan</div>";
    $stmt->close();
}

if(isset($_GET['date']) && isset($_GET['resource'])){
    $date = $_GET['date'];
    $resource = $_GET['resource'];
    
    $stmt = $mysqli->prepare("select * from doktori where id = ?");
    $stmt->bind_param('i', $resource);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $resourcename = $row['name'];
    $slotduration = $row['slot_duration'];
    
    
    $stmt = $mysqli->prepare("select * from zakazivanje where date = ? AND resource_id = ?");
    $stmt->bind_param('si', $date, $resource);
    $bookings = array();
    if($stmt->execute()){
        $result = $stmt->get_result();
        if($result->num_rows>0){
            while($row = $result->fetch_assoc()){
                $bookings[] = $row['timeslot'];
            }
            $stmt->close();
        }
    }
}


if(isset($_POST['submit'])){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $timeslot = $_POST['timeslot'];
    $phone = $_POST['phone'];
    $ordinacija = $_POST['ordinacija'];
    $stmt = $mysqli->prepare("select * from zakazivanje where date = ? AND timeslot = ? AND resource_id = ?");
    $stmt->bind_param('ssi', $date, $timeslot, $resource);
    if($stmt->execute()){
        $result = $stmt->get_result();
        if($result->num_rows>0){
            $msg = "<div class='alert alert-danger'>Zauzeto</div>";
        }else{
            $stmt = $mysqli->prepare("INSERT INTO zakazivanje (name_p, email, phone, date, timeslot, resource_id,id_ord) VALUES (?,?,?,?,?,?,?)");
            $stmt->bind_param('sssssii', $name, $email, $phone, $date, $timeslot, $resource,$ordinacija);
            $stmt->execute();
            $msg = "<div class='alert alert-success'>Uspesno ste zakazali pregled</div>";
            $bookings[]=$timeslot;
            $stmt->close();
            $mysqli->close();
        }
    }
}

if(isset($_POST['delete'])){
    $bookingid = $_POST['bookingid'];
    $stmt = $mysqli->prepare("delete from zakazivanje where id=?");
    $stmt->bind_param('i', $bookingid);
    $stmt->execute();
    $msg = "<div class='alert alert-success'>Pregled uspesno otkazan</div>";
    $stmt->close();
    $mysqli->close();
}


if(isset($_POST['update'])){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $newdate = $_POST['date'];
    $bookingid = $_POST['bookingid'];
    $ordinacija = $_POST['ordinacija'];
    $timeslot = $_POST['timeslot'];
    $stmt = $mysqli->prepare("select * from zakazivanje where date = ? AND timeslot = ? AND resource_id = ?");
    $stmt->bind_param('ssi', $newdate, $timeslot, $resource);
    if($stmt->execute()){
        $result = $stmt->get_result();
        if($result->num_rows>0){
            $msg = "<div class='alert alert-danger'>Izabrani termin je popunjen.</div>";
        }else{
            $stmt = $mysqli->prepare("Update zakazivanje set timeslot=?, date=?, name_p=?, email=?, phone=?, id_ord=? where id=?");
            $stmt->bind_param('ssssssi', $timeslot, $newdate, $name, $email, $phone,$ordinacija, $bookingid);
            $stmt->execute();
            $msg = "<div class='alert alert-success'>Uspesno ste promenili podatke</div>";
            $stmt->close();
            
            $stmt = $mysqli->prepare("select * from zakazivanje where date = ? AND resource_id = ?");
            $stmt->bind_param('si', $date, $resource);
            $bookings = array();
            if($stmt->execute()){
                $result = $stmt->get_result();
                if($result->num_rows>0){
                    while($row = $result->fetch_assoc()){
                        $bookings[] = $row['timeslot'];
                    }
                    $stmt->close();
                }
            }
        }
    }
}

$duration = $slotduration;
$cleanup = 0;

$day = date('l', strtotime($date));
if($day=='Saturday'){
    $start = "09:00";
    $end = "14:00";
}else{
    $start = "09:00";
    $end = "21:00";
}



function timeslots($duration, $cleanup, $start, $end){
    $start = new DateTime($start);
    $end = new DateTime($end);
    $interval = new DateInterval("PT".$duration."M");
    $cleanupInterval = new DateInterval("PT".$cleanup."M");
    $slots = array();
    
    for($intStart = $start; $intStart<$end; $intStart->add($interval)->add($cleanupInterval)){
        $endPeriod = clone $intStart;
        $endPeriod->add($interval);
        if($endPeriod>$end){
            break;
        }
        
        $slots[] = $intStart->format("H:iA")." - ". $endPeriod->format("H:iA");
        
    }
    
    return $slots;
    
}


?>
<!doctype html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title></title>

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <link rel="stylesheet" href="/css/main.css">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
    </head>

    <body>
        <div class="container">
         <h3 class=""><b>Datum</b> <?php echo date('d-m-Y', strtotime($date)); ?><br>
            <b>Doktor </b> <?php echo $resourcename; ?>
        </h3>
        <a href="calendar.php" class="btn btn-primary btn-xs">Nazad na zakazivanje</a>
        <hr>
        <div class="row">
           <div class="col-md-12">
               <?php echo(isset($msg))?$msg:""; ?>
           </div>
           <?php $timeslots = timeslots($duration, $cleanup, $start, $end); 
           foreach($timeslots as $ts){
            ?>
            <div class="col-md-2">
                <div class="form-group">
                   <?php if(in_array($ts, $bookings)){ ?>
                       <button class="btn btn-danger edit" data-timeslot="<?php echo $ts; ?>"><?php echo $ts; ?></button>
                   <?php }else{ ?>
                       <button class="btn btn-success book" data-timeslot="<?php echo $ts; ?>"><?php echo $ts; ?></button>
                   <?php }  ?>

               </div>
           </div>
       <?php } ?>
   </div>
</div>
<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Vreme <span id="slot"></span></h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <form action="" method="post">
                           <div class="form-group">
                            <label for="">Vreme</label>
                            <input readonly type="text" class="form-control" id="slotinput" name="timeslot">
                        </div>
                        <div class="form-group">
                            <label for="">Izaberi pacijenta</label>
                            <select required name="" class="form-control" id="patient_select">
                                <option value=""></option>
                                <?php 
                                $stmt = $mysqli->prepare("select * from pacijent");
                                $stmt->execute();
                                $result = $stmt->get_result();
                                while($row = $result->fetch_assoc()){
                                    $prikazDatuma=$row['datumRodjenja'];
                                   $prikazDatuma= date('d-m-Y',strtotime($prikazDatuma))
                                    ?>
                                    <option data-phone="<?php echo $row['brojTelefona']; ?>" data-test="<?php echo $row['datumRodjenja']; ?>" data-name="<?php echo $row['ime'].' '.$row['prezime']; ?>" value="<?php echo $row['id_p']; ?>"><?php echo $row['ime'].' '.$row['prezime'].' '.$row['brojTelefona'].' '. $prikazDatuma; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Ime i prezime</label>
                            <input id="name" required type="text" class="form-control" name="name">
                        </div>
                        <div class="form-group">
                         <label for="">Napomena</label>
                         <input required type="text" class="form-control" name="email">
                     </div>
                     <div class="form-group">
                        <label for="">Ordinacija</label>
                        <select name="ordinacija" required class="form-control">
                            <option value="">Izaberi ordinaciju</option>
                            <?php
                            $sql= "SELECT * FROM ordinacija";                
                            $result = mysqli_query($mysqli,$sql) or die('error');
                            if (mysqli_num_rows($result)>0) {
                                while ($row=mysqli_fetch_assoc($result)) { ?>                                   
                                    <option  value="<?php echo $row['id'] ?>"><?php echo $row['name_o'] ?></option>
                                <?php }
                            }   
                            ?>                          
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Telefon</label>
                        <input id="phone" required type="phone" class="form-control" name="phone">
                    </div>
                    <div class="form-group">
                        <label for="">Datum rodjenja</label>
                        <input id="test" required type="test" class="form-control" name="test">
                    </div>
                    <div class="form-group pull-right">
                        <button name="submit" type="submit" class="btn btn-primary">Zakazi</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>

</div>
</div>

<div id="editModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Izmena podataka: <span id="slot_edit"></span></h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <form action="" method="post">
                          <div class="form-group">
                            <label for="">Datum</label>
                            <input name="date" required type="date" class="form-control" value="<?php echo $date; ?>">
                        </div>
                        <div class="form-group">
                            <label for="">Vreme</label>
                            <select required name="timeslot" class="form-control" id="timeslot_select">
                                <?php $timeslots = timeslots($duration, $cleanup, $start, $end); 
                                foreach($timeslots as $ts){
                                    ?>
                                    <option value="<?php echo $ts; ?>"><?php echo $ts; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="">Ime i prezime</label>
                            <input required type="text" class="form-control" name="name" id="name_edit">
                        </div>
                        <div class="form-group">
                            <label for="">Napomena</label>
                            <input required type="text" class="form-control" name="email" id="email_edit">
                        </div>
                        <div class="form-group">
                            <label for="">Ordinacija</label>
                            <select name="ordinacija" required class="form-control" id="ordinacija_edit">
                               <!--  <option value="">Izaberi ordinaciju</option> -->
                               <?php
                               $sql= "SELECT * FROM ordinacija";                
                               $result = mysqli_query($mysqli,$sql) or die('error');
                               if (mysqli_num_rows($result)>0) {
                                while ($row=mysqli_fetch_assoc($result)) { ?>                                   
                                    <option  value="<?php echo $row['id'] ?>"><?php echo $row['name_o'] ?></option>
                                <?php }
                            }   
                            ?>                          
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Telefon</label>
                        <input required type="phone" class="form-control" name="phone" id="phone_edit">
                    </div>
                    <div class="form-group">
                        <input type="hidden" id="booking_edit_id" name="bookingid">
                        <button name="update" type="submit" class="btn btn-block btn-primary">Izmeni podatke</button>
                    </div>
                </form>
                <form action="" method="post" onsubmit="return confirm('Da li ste sigurni da zelite da otkazete pregled?')">
                    <input type="hidden" id="booking_delete_id" name="bookingid">
                    <button name="delete" type="submit" class="btn btn-block btn-danger">Otkazi</button>
                </form>
            </div>
        </div>
    </div>

</div>

</div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
<script>
    $(".book").click(function(){
        var timeslot = $(this).attr('data-timeslot');
        $("#slot").html(timeslot);
        $("#slotinput").val(timeslot);
        $("#myModal").modal("show");
    });
</script>
<script>
    $(".edit").click(function(){
        var timeslot = $(this).attr('data-timeslot');
        $("#slotinput_edit").val(timeslot);
        $("#timeslot_select").val(timeslot).change();
        $("#slot_edit").html(timeslot);
        $.ajax({
            url : 'getBookingDetails.php',
            type : 'POST',
            data : { 
                'timeslot' : timeslot,
                'resource' : '<?php echo $resource; ?>',
                'date' : '<?php echo $date; ?>',
            },
            success : function(data) {              
                var data = JSON.parse(data);
                $("#name_edit").val(data.name_p);
                $("#phone_edit").val(data.phone);
                $("#email_edit").val(data.email);
                $("#ordinacija_edit").val(data.id_ord);
                $("#booking_edit_id").val(data.id);
                $("#booking_delete_id").val(data.id);
                $("#editModal").modal("show");
            }
        });
    });

    $(document).ready(function() {
        $('#timeslot_select').select2({
            placeholder:'Select',
            width:'100%'
        });
        
        $('#patient_select').select2({
            placeholder:'Select',
            width:'100%'
        });
    });
    
    $("#patient_select").change(function(){
     var phone = $(this).find(':selected').data('phone');
     var name = $(this).find(':selected').data('name');
     var test = $(this).find(':selected').data('test');

     $("#name").val(name);
     $("#phone").val(phone);
     $("#test").val(test);

 })

</script>
</body>

</html>
