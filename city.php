<?php
$conn = mysqli_connect("localhost", "root", "", "dependent-selects") or die("Error Ocurred");

$state_id = $_POST['state_id'];
$output = "";

$sql = "SELECT * FROM city WHERE state_id = {$state_id}";
$sql_result = mysqli_query($conn, $sql);

$output .= '<select class="form-select" name="city" id="city">';
$output .= '<option selected disabled>Select</option>';
          
if($sql_result){
  while($row = mysqli_fetch_assoc($sql_result)){
    $output .= '<option value="'.$row['city_id'].'">'.$row['city_name'].'</option>';
  }
}

$output .= '</select>';

echo $output;

?>