<?php
require_once('../../includes/initialize.php');

//==================================Add/Delete Category=================================================

if(isset($_POST['category_name']))
{
    $category = new Category();
    $category->category_name = strtoupper($_POST['category_name']);
    $category->create();

    $data = "<tr><td>".$category->category_name."</td></tr>";
    echo $data;
}

if(isset($_POST['category_delete']))
{
    $rows = Category::find_by_id($_POST['category_delete']);
    $row = mysqli_fetch_array($rows);
    $category_delete=Category::instantiate($row);
    $category_delete->delete();
}


?>