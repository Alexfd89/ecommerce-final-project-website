<?php 
require_once('../../includes/initialize.php');
include_layout_template('header.php');

$res = Item::find_by_sql("SELECT max(price) as max_price, min(price) as min_price from items");
$row = mysqli_fetch_array($res);
$max_price = $row['max_price'];
$min_price = $row['min_price'];
?>

  <div class="row">
      <div class="col-lg-2" style="border-right: 1px solid grey; background-color: #D3DCE3;">
              <form id="filter" class="p-3">
                  <div class="form-group mb-5">
                      <input class="form-control" type="text" name="search_text" id="search_text" placeholder="Search">
                  </div>          
                  <div class="form-group">
                      <select class="form-control" name="category_filter" id="category_filter">
                          <option value="">All Categories</option>
                          <?php
                          $category_list = Category::find_all();
                          while($x = mysqli_fetch_array($category_list))
                          echo '<option value="'.$x['category_name'].'">'.$x['category_name'].'</option>';
                          ?>
                      </select>
                  </div>
                  <div class="form-group">
                      <select class="form-control" name="brand_filter" id="brand_filter">
                          <option value="">All Brands</option>
                          <?php
                          $brand_list = Brand::find_all();
                          while($x = mysqli_fetch_array($brand_list))
                          echo '<option value="'.$x['brand_name'].'">'.$x['brand_name'].'</option>';
                          ?>
                      </select>
                  </div>
                  <div class="form-group range-slider">
                      <input type="range" class="range-slider__range" min="<?php echo $min_price; ?>" max="<?php echo $max_price; ?>" step="1" value="<?php echo $max_price; ?>" id="m_price" name="m_price">
                      <span class="range-slider__value"></span>
                      
                  </div>
              </form>
          
      </div>

      <div class="col-lg-10 search-content">
          <div class="mb-5">
              <div class="d-flex flex-wrap ml-3" id="result"></div>
          </div>
      </div>
  </div>





<?php include_layout_template('footer.php'); ?>


<style>

  input[type=range] {
      -webkit-appearance: none; /* Hides the slider so that custom slider can be made */
      width: 100%; /* Specific width is required for Firefox. */
      background: transparent; /* Otherwise white in Chrome */
    }
    
  input[type=range]::-webkit-slider-thumb {
      -webkit-appearance: none;
    }
    
    input[type=range]:focus {
      outline: none; /* Removes the blue border. You should probably do some kind of focus styling for accessibility reasons though. */
    }
    
    input[type=range]::-ms-track {
      width: 100%;
      cursor: pointer;
    
      /* Hides the slider so custom styles can be added */
      background: transparent; 
      border-color: transparent;
      color: transparent;
    }
    
    input[type=range] {
      -webkit-appearance: none;
      margin: 18px 0;
      width: 100%;
    }
    input[type=range]:focus {
      outline: none;
    }
    input[type=range]::-webkit-slider-runnable-track {
      width: 100%;
      height: 5px;
      cursor: pointer;
      animate: 0.2s;
      box-shadow: 1px 1px 1px #000000, 0px 0px 1px #0d0d0d;
      background: #3071a9;
      border-radius: 5px;
      border: 0.2px solid #010101;
    }
    input[type=range]::-webkit-slider-thumb {
      box-shadow: 1px 1px 1px #000000, 0px 0px 1px #0d0d0d;
      border: 1px solid #000000;
      height: 30px;
      width: 11px;
      border-radius: 100px;
      background: #ffffff;
      cursor: pointer;
      -webkit-appearance: none;
      margin-top: -14px;
    }
    input[type=range]:focus::-webkit-slider-runnable-track {
      background: #367ebd;
    }
    input[type=range]::-moz-range-track {
      width: 100%;
      height: 8.4px;
      cursor: pointer;
      animate: 0.2s;
      box-shadow: 1px 1px 1px #000000, 0px 0px 1px #0d0d0d;
      background: #3071a9;
      border-radius: 1.3px;
      border: 0.2px solid #010101;
    }
    input[type=range]::-moz-range-thumb {
      box-shadow: 1px 1px 1px #000000, 0px 0px 1px #0d0d0d;
      border: 1px solid #000000;
      height: 36px;
      width: 16px;
      border-radius: 3px;
      background: #ffffff;
      cursor: pointer;
    }
    input[type=range]::-ms-track {
      width: 100%;
      height: 8.4px;
      cursor: pointer;
      animate: 0.2s;
      background: transparent;
      border-color: transparent;
      border-width: 16px 0;
      color: transparent;
    }
    input[type=range]::-ms-fill-lower {
      background: #2a6495;
      border: 0.2px solid #010101;
      border-radius: 2.6px;
      box-shadow: 1px 1px 1px #000000, 0px 0px 1px #0d0d0d;
    }
    input[type=range]::-ms-fill-upper {
      background: #3071a9;
      border: 0.2px solid #010101;
      border-radius: 2.6px;
      box-shadow: 1px 1px 1px #000000, 0px 0px 1px #0d0d0d;
    }
    input[type=range]::-ms-thumb {
      box-shadow: 1px 1px 1px #000000, 0px 0px 1px #0d0d0d;
      border: 1px solid #000000;
      height: 36px;
      width: 16px;
      border-radius: 3px;
      background: #ffffff;
      cursor: pointer;
    }
    input[type=range]:focus::-ms-fill-lower {
      background: #3071a9;
    }
    input[type=range]:focus::-ms-fill-upper {
      background: #367ebd;
    }

</style>