<?php
require_once('../../includes/initialize.php');

if(!$session->is_logged_in())
redirect_to('login.php');


include_layout_template('header.php');
//================================End PHP=============================================================
?>
<div class="container" style="margin-bottom: 131px;">
  <h2>Items Manager</h2>
  <div id="accordion">
            <!--===========================Add Category==========================================================-->
        <div class="card">
            <div class="card-header bg-dark">
                <a class="card-link text-white" data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                Categories
                </a>
            </div>
            <div id="collapseOne" class="collapse">
                <div class="card-body">
                    <div class="row">
                    <div class="col-md-4">
                        <form id="category_add" class="form-group" action="item_admin.php" method="POST">
                            <label for="category_name">Category Name</label>
                            <input type="text" class="form-control" name="category_name">
                            <button type="submit" class="btn btn-primary mt-1" name="category_add">Add</button>
                        </form>
                    </div>
                    <div class="col-md-5 mx-auto">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Categories</th>
                                </tr>
                            </thead>
                            <tbody id="category_table">
                                <form id="category_delete">
                                    <?php
                                        $category_list = Category::find_all();
                                        while($x = mysqli_fetch_array($category_list))
                                        { 
                                        ?>
                                        <tr>
                                            <td><?php echo $x['category_name']; ?></td>
                                            <td><input type="hidden" name="category_delete" value="<?php echo $x['category_id']; ?>"></td>
                                            <td><input type="submit" value="Delete" class="btn btn-danger"></td>
                                        </tr>
                                    <?php } ?>
                                </form>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div> 
        </div>
            <!--===========================Add Brand==========================================================-->
        <div class="card">
            <div class="card-header bg-dark">
                <a class="card-link text-white" data-toggle="collapse" data-parent="#accordion" href="#collapseBrand">
                Brands
                </a>
            </div>
                <div id="collapseBrand" class="collapse">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <form class="form-group" id="brand_add">
                                    <label for="brand_name">Brand Name</label>
                                    <input type="text" class="form-control" name="brand_name" id="brand_name">
                                    <button type="submit" class="btn btn-primary mt-1" name="brand_add">Add</button>
                                </form>
                            </div>
                            <div class="col-md-5 mx-auto">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Brands</th>
                                        </tr>
                                    </thead>
                                    <tbody id="brand_table">
                                        <form id="brand_delete">
                                            <?php
                                                $brand_list = Brand::find_all();
                                                while($x = mysqli_fetch_array($brand_list))
                                                { 
                                                ?>
                                                <tr>
                                                    <td><?php echo $x['brand_name']; ?></td>
                                                    <td><input type="hidden" name="brand_delete" value="<?php echo $x['brand_id']; ?>"></td>
                                                    <td><input type="submit" value="Delete" class="btn btn-danger"></td>
                                                </tr>
                                            <?php } ?>  
                                        </form>   
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div> 
        </div>
            <!--===========================Add Item=======================================================-->
        <div class="card">
            <div class="card-header bg-dark">
                <a class="collapsed card-link text-white" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
                Add Item
            </a>
            </div>
            <div id="collapseTwo" class="collapse">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <form class="item_add_form">
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" class="form-control" id="name" name="name">
                                </div>
                                <div class="form-group">
                                    <label for="quantity">Quantity</label>
                                    <input type="text" class="form-control" id="quantity" name="quantity">
                                </div>
                                <div class="form-group">
                                    <label for="price">Price</label>
                                    <input type="text" class="form-control" id="price" name="price">
                                </div>
                                <div class="form-group">
                                    <label for="select_brand">Brand</label>
                                        <select class="form-control" name="brand" id="select_brand">
                                            <?php
                                            $brand_list = Brand::find_all();
                                            while($x = mysqli_fetch_array($brand_list))
                                            echo '<option value="'.$x['brand_name'].'">'.$x['brand_name'].'</option>';
                                            ?>
                                        </select>
                                </div>
                                <div class="form-group">
                                    <label for="select_category">Category</label>
                                        <select class="form-control" name="category" id="select_category">
                                            <?php
                                            $category_list = Category::find_all();
                                            while($x = mysqli_fetch_array($category_list))
                                            echo '<option value="'.$x['category_name'].'">'.$x['category_name'].'</option>';
                                            ?>
                                        </select>
                                </div>
                                </div>
                                <div class="col-md-6">
                        
                                <div class="form-group">
                                    <label for="file">Upload Image</label>
                                    <input type="file" class="form-control" id="file" name="file_upload"/>
                                </div>
                                <div class="form-group">
                                    <label for="desc">Description</label>
                                    <textarea class="form-control" name="description" rows="8" id="desc"></textarea>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <input type="hidden" name="MAX_FILE_SIZE" value="100000000"/>
                                        <input type="submit" class="btn btn-primary" name="item_add" value="Add Item"/>
                                    </div>
                                    <div id="item_add_msg" class="col-md-9"></div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--===============================Items List=======================-->
        <div class="card">
            <div class="card-header bg-dark">
                <a class="collapsed card-link text-white" data-toggle="collapse" data-parent="#accordion" href="#collapseThree">
                Items List (Update/Delete)
                </a>
            </div>
            <div id="collapseThree" class="collapse">
                <div class="card-body">
                    <div class="table-responsive-md">
                        <?php $count=0; $items_list = Item::find_all(); while($row=mysqli_fetch_array($items_list)){?>
                        <table class="table">
                            
                                <thead>
                                    <tr>
                                        <th>Image</th>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th <?php if($row['quantity'] < 1){ echo "style='color:red'"; } ?>>Quantity</th>
                                        <th>Price</th>
                                        <th>Category</th>
                                        <th>Description</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <form class="form-group item_list_form" method="POST">
                                        <tr>
                                            <td><img src="../images<?php echo DS.$row['filename']; ?>" style="width:70px; height:100px" /></td>
                                            <td> <?php echo $row['item_id'];?> </td>
                                            <td><input type="text" class="form-control" style="width:210px;" name="name" value="<?php echo $row['name'];?>"></td>
                                            <td><input type="text" class="form-control" name="quantity" value="<?php echo $row['quantity'];?>"></td>
                                            <td><input type="text" class="form-control" name="price" value="<?php echo $row['price'];?>"></td>
                                            <td>
                                                <select class="form-control" style="width:110px;" name="category"> 
                                                <option selected hidden><?php echo $row['category'];?></option>
                                                <?php         
                                                $category_list = Category::find_all();
                                                $areaId = 'index'.$count;
                                                while($x = mysqli_fetch_array($category_list))
                                                echo '<option value="'.$x['category_name'].'">'.$x['category_name'].'</option>';
                                                ?>
                                                </select>
                                            </td>
                                            <td><textarea class="form-control" id="<?php echo $areaId;?>" name="description" cols="110" rows="5"></textarea></td>
                                            <script> document.getElementById("<?php echo $areaId; ++$count;?>").value = "<?php echo $row['description'];?>"</script>
                                            <td><input type="hidden" name="filename" value="<?php echo $row['filename'];?>"></td> 
                                            <td><input type="hidden" name="size" value="<?php echo $row['size'];?>"></td> 
                                            <td><input type="hidden" name="type" value="<?php echo $row['type'];?>"></td> 
                                            <td><input type="hidden" name="id" value="<?php echo $row['item_id'];?>"></td>
                                            <td><input type="hidden" name="brand" value="<?php echo $row['brand_name'];?>"></td>
                                            <td>
                                                <ul class="list-group p-0">
                                                    <li class="list-group-item "><button class="btn btn-success updateBtn" name="item_update">Update</button></li>
                                                    <li class="list-group-item "><button class="btn btn-danger deleteBtn">Delete</button></li>
                                                </ul>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td id="item_msg"></td>
                                        </tr>
                                    </form>
                                </tbody> 
                        </table>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<?php include_layout_template('footer.php');?>