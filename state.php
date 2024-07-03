<?php
$conn = mysqli_connect("localhost", "root", "", "dependent-selects") or die("Error Ocurred");

$country_id = $_POST['country_id'];
$output = "";

$sql = "SELECT * FROM state WHERE country_id = {$country_id}";
$sql_result = mysqli_query($conn, $sql);

$output .= '<select class="form-select" name="state" id="state">';
$output .= '<option selected disabled>Select</option>';
          
if($sql_result){
  while($row = mysqli_fetch_assoc($sql_result)){
    $output .= '<option value="'.$row['state_id'].'">'.$row['state_name'].'</option>';
  }
}

$output .= '</select>';

echo $output;

?>