<?php 
$conn = mysqli_connect("localhost", "root", "", "dependent-selects") or die("Error Ocurred");

?>
<html lang="en">
  <head>
    <title>Dependent Selects</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, shrink-to-fit=no"
    />

    <!-- Bootstrap CSS v5.2.1 -->
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
      crossorigin="anonymous"
    />

    <style>
      *{
        margin: 0;
        padding: 0;
      }
      main{
        height: 100vh;
      }
      #select-form{
        color: black;
        width: 50%;
        min-height: 40vh;
        /* margin-left: 25%; */
        position: relative;
        top: 10%;
        left: 25%;
        border: 2px solid black;
        border-radius: 5px;
        padding: 10px;
      }
      #select-form select{
        width: 100%;
        font-size: 20px;
        border-radius: 4px;
        padding: 8px 5px;
        margin-bottom: 10px;
      }
      #select-form label{
        font-family: sans-serif;
        font-size: 20px;
        padding: 10px 0;
      }
    </style>
  </head>

  <body>
    
    <main>

      <form action="#" id="select-form">

        <label for="country">Country</label>
        <select class="form-select" name="country" id="country">
          <option selected disabled>Select</option>
          <?php 
            $sql = "SELECT * FROM country";
            $sql1_result = mysqli_query($conn, $sql);
            if($sql1_result){
              while($sql1_row = mysqli_fetch_assoc($sql1_result)){
                echo '<option value="'.$sql1_row['country_id'].'">'.$sql1_row['country_name'].'</option>';
              }
            }
          ?>
        </select>
        
        <label for="state">State</label>
        <div id="change-state">
          <select class="form-select" name="state" id="state">
            <option selected disabled>Select</option>
          </select>
        </div>

        <label for="city">City</label>
        <div id="change-city">
          <select class="form-select" name="city" id="city">
            <option selected disabled>Select</option>
          </select>
        </div>

      </form>


    </main>
    <!-- Bootstrap JavaScript Libraries -->
    <script
      src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
      integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
      crossorigin="anonymous"
    ></script>

    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
      integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
      crossorigin="anonymous"
    ></script>
    <!-- JQUERY CDN -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
      $(document).ready(function(){
        
        // changing state through AJAX
        $('#country').change(()=>{
          
          var country_id = $('#country').val();
          // console.log(country_id);
          $.ajax({
            url: "state.php",
            type: "POST",
            data: {country_id: country_id},
            success: (data)=>{
              // console.log(data);
              $('#change-state').html(data);
            }
          });

        });
        
        // changing city through AJAX
        $('#change-state').change(()=>{

          var state_id = $('#state').val();
          $.ajax({
            url: "city.php",
            type: "POST",
            data: {state_id: state_id},
            success: (data)=>{
              // console.log(data);
              $('#change-city').html(data);
            }
          });

        });







      });
    </script>

  </body>
</html>
