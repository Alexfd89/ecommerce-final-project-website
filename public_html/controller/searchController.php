<?php
require_once('../../includes/initialize.php');
if(!empty($_POST['key']))
{
    $k = $_POST['key'];
    $result = Item::find_by_sql("SELECT * FROM items WHERE category LIKE '%".$k."%' 
    OR brand_name LIKE '%".$k."%'
    OR name LIKE '%".$k."%'
    OR price LIKE '%".$k."%'
    ");
}
else if((!empty($_POST['category']) || !empty($_POST['brand'])) && !empty($_POST['range']))
{
    $c = $_POST['category'];
    $b = $_POST['brand'];
    $r = $_POST['range'];

    $result = Item::find_by_sql("SELECT * FROM items WHERE (category LIKE '%".$c."%' 
    AND brand_name LIKE '%".$b."%') AND price <= ".$r);

}
else if(!empty($_POST['range']))
{
    $r = $_POST['range'];
    $result = Item::find_by_sql("SELECT * FROM items WHERE price <= ".$r);
}
else
{
    $result = Item::find_all();
}
 
    while($row = mysqli_fetch_array($result))
    {
        $text = "<div class=\"p-lg-4 p-xs-1 ml-auto mr-auto search-items\"><div class=\"card text-center border-info\" style=\"width:220px; height:100%;\">";
        $text .= "<a href=\"item_details.php?id= ".$row['item_id']." \">";
        $text .= "<img class=\"card-img-top mt-2\" src=\"../images/".$row['filename']." \" style=\"width:120px; height:175px;\" alt=\"Card image\"></a>";
        $text .= "<div class=\"card-body p-0\">";
        $text .= "<h6 class=\"card-title mt-1 mb-0\">".$row['name']."</h6>";
        $text .= "<h7 class=\"card-text\" style=\"color:grey; font-size:14px;\">".$row['brand_name']."</h7>";
        $text .= "<p class=\"card-text mb-1\">Price: $".$row['price']."</p>";
        $text .= "<a href=\"item_details.php?id=".$row['item_id']."\" class=\"btn btn-info btn-block p-1 m-0\">VIEW PRODUCT</a></div></div></div>";
        echo $text;
    }

?>

