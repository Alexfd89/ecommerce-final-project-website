<?php
require_once('../../includes/initialize.php');


//==================================Add/Delete Brand=================================================
if(isset($_POST['brand_name']))
{
    $brand = new Brand();
    $brand->brand_name = $_POST['brand_name'];
    $brand->create();

    $data = "<tr><td>".$brand->brand_name."</td></tr>";
    echo $data;
}

if(isset($_POST['brand_delete']))
{
    $rows = Brand::find_by_id($_POST['brand_delete']);
    $row = mysqli_fetch_array($rows);
    $brand_delete=Brand::instantiate($row);
    $brand_delete->delete();
}

?>