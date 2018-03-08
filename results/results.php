<?php 

function connect(){
  $db = new PDO("mysql:host=localhost;dbname=voting","root","");
  return $db;
}

  $db = connect();

  $eng = $db->prepare("SELECT COUNT(*) 'num' FROM `students` WHERE vote = 'yes' AND 
    course IN ('BSCPE','BSGE','BSECE')");
  $eng->execute();
  $engg = $eng->fetch(PDO::FETCH_OBJ);

  $it = $db->prepare("SELECT COUNT(*) 'num' FROM `students` WHERE vote = 'yes' 
    AND course IN ('BSIT', 'BSCS')");
  $it->execute();
  $itt = $it->fetch(PDO::FETCH_OBJ);

  $nurse = $db->prepare("SELECT COUNT(*) 'num' FROM `students` WHERE vote = 'yes' 
    AND course IN ('BSN')");
  $nurse->execute();
  $nursee = $nurse->fetch(PDO::FETCH_OBJ);

  $educ = $db->prepare("SELECT COUNT(*) 'num' FROM `students` WHERE vote = 'yes' 
    AND course IN ('BEED','BEEDSPED','BSEDE', 'BSEDM', 'BSEDMAPH')");
  $educ->execute();
  $educc = $educ->fetch(PDO::FETCH_OBJ);

  $hrm = $db->prepare("SELECT COUNT(*) 'num' FROM `students` WHERE vote = 'yes' 
    AND course IN ('BSHRM','BSTM')");
  $hrm->execute();
  $hrmm = $hrm->fetch(PDO::FETCH_OBJ);

  $crim = $db->prepare("SELECT COUNT(*) 'num' FROM `students` WHERE vote = 'yes' 
    AND course IN ('BSCR')");
  $crim->execute();
  $crimm = $crim->fetch(PDO::FETCH_OBJ);

  $ba = $db->prepare("SELECT COUNT(*) 'num' FROM `students` WHERE vote = 'yes' 
    AND course IN ('BSBAFM', 'BSBAHRDM', 'BSBAMA', 'BSBAMM')");
  $ba->execute();
  $baa = $ba->fetch(PDO::FETCH_OBJ);

  $population = [
    "eng" => 138,
    "it" => 96,
    "nurse" => 68,
    "educ" => 211,
    "hrm" => 112,
    "crim" => 190,
    "ba" => 241,
    "all" => 1056
  ];

  $voted = $baa->num+$crimm->num+$hrmm->num+$nursee->num+$itt->num+$engg->num+$educc->num;

?>

<!DOCTYPE html>
<html>
<head>
    <title>Vote tally per department</title>
    <script type="text/javascript" src="../plugins/jquery.js"></script>
    <link rel="stylesheet" href="../plugins/bootstrap.min.css">
    <script type="text/javascript" src="../plugins/bootstrap.min.js"></script>
</head>
<body>
<div id="app">
    <div class="container">
        <div class="row padtop">
          <div class="col-md-12"><h1 class="text-center title">SSC ELECTION 2018</h1></div>
        </div>
        <div class="row">
            <div class="col-md-12"><h1>Votes per department</h1></div>
            <div class="col-md-6">
              
              <h4><span>ICT:</span> Population: 96 | Already Voted: <?php echo $itt->num; ?>|Students left: <?php echo 96-$itt->num ?></h4> 
                <div class="progress">
                  <div class="progress-bar" role="progressbar" aria-valuenow="70"
                  aria-valuemin="0" aria-valuemax="100" style="width: <?php echo ($itt->num / 96 * 100).'%'; ?> ">
                    <p><?php echo floor($itt->num / 96 * 100).'%' ?></p>
                  </div>
                </div>
              <h4><span>CBA: </span>Population: 241 | Already Voted: <?php echo $baa->num ?> |Students left:  <?php echo 241-$baa->num ?></h4> 
                <div class="progress">
                  <div class="progress-bar" role="progressbar" aria-valuenow="70"
                  aria-valuemin="0" aria-valuemax="100" style="width: <?php echo ($baa->num / 241 * 100).'%'; ?>">
                    <p><?php echo floor($baa->num / 241 * 100).'%' ?></p>
                  </div>
                </div>
              <h4><span>EDUC: </span>Population: 211 | Already Voted: <?php echo $educc->num ?> |Students left:  <?php echo 211-$educc->num ?></h4> 
                <div class="progress">
                  <div class="progress-bar" role="progressbar" aria-valuenow="70"
                  aria-valuemin="0" aria-valuemax="100" style="width: <?php echo ($educc->num / 211 * 100).'%'; ?>">
                    <p><?php echo floor($baa->num / 211 * 100).'%' ?></p>
                  </div>
                </div>
              <h4><span>CHM: </span>Population: 112 | Already Voted: <?php echo $hrmm->num ?> |Students left:  <?php echo 112-$hrmm->num ?></h4> 
                <div class="progress">
                  <div class="progress-bar" role="progressbar"
                  aria-valuemin="0" aria-valuemax="100" style="width: <?php echo ($hrmm->num / 112 * 100).'%'; ?>">
                    <p><?php echo floor($hrmm->num / 112 * 100).'%' ?></p>
                  </div>
                </div>
              <h4><span>CRIM: </span>Population: 190 | Already Voted: <?php echo $crimm->num ?> |Students left:  <?php echo 190-$crimm->num ?></h4> 
                <div class="progress">
                  <div class="progress-bar" role="progressbar" aria-valuenow="70"
                  aria-valuemin="0" aria-valuemax="100" style="width: <?php echo ($crimm->num / 190 * 100).'%'; ?>">
                    <p><?php echo floor($crimm->num / 190 * 100).'%' ?></p>
                  </div>
                </div>
              <h4><span>ENG'G: </span>Population: 138 | Already Voted: <?php echo $engg->num ?>|Students left: <?php echo 138-$engg->num ?></h4> 
                <div class="progress">
                  <div class="progress-bar" role="progressbar" aria-valuenow="70"
                  aria-valuemin="0" aria-valuemax="100" style="width: <?php echo ($engg->num / 138 * 100).'%'; ?>">
                    <p><?php echo floor($engg->num / 138 * 100).'%' ?></p>

                  </div>
                </div>
              <h4><span>NURSING: </span>Population: 68 | Already Voted: <?php echo $nursee->num ?>|Students left: <?php echo 68-$nursee->num ?></h4> 
                <div class="progress">
                  <div class="progress-bar" role="progressbar" aria-valuenow="70"
                  aria-valuemin="0" aria-valuemax="100" style="width: <?php echo ($nursee->num / 68 * 100).'%'; ?>">
                    <p><?php echo floor($nursee->num / 68 * 100).'%' ?></p>
                  </div>
                </div>


            </div>        
            <div class="col-md-6">
                <table border="5">
                  <tr>
                    <th><h2>Total Number of <br> voter attendance: </h2></th>
                    <th><h2>&nbsp&nbsp 1056 </h2></th>
                  </tr>
                  <tr>
                    <th><h2>Total number <br> who voted: </h2></th>
                    <th><h2>&nbsp&nbsp <?php echo $voted ?></h2></th>
                  </tr>
                  <tr>
                    <th><h2>Total number <br> who abstained: </h2></th>
                    <th><h2>&nbsp&nbsp <?php echo 1056-$voted ?></h2></th>
                  </tr>
                </table>
            </div>        
        </div>
    </div>


</div>
<script src="master.js"></script>
</body>
</html>

<style type="text/css">
    body{
        font-family: sans-serif;
    }

    h1{
      font-family: impact;
    }

    h2{
      font-family: impact;
      font-size: 40px;
    }

    span{
      font-family: impact;
      font-size: 20px;
    }

    h4{
      font-family: calibri;
    }

    table{
      border: 5px solid black;
    }

    table th{
      padding: 5px 30px;
    }

    .padtop{
      padding-top: 40px;
    }
    .title{
      font-size: 50px;
    }

</style>