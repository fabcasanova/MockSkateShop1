<?php include('header.php'); ?>
<main>
<div class="container">
<div class="row">
<div class="col">

    <div class="sidebar">
        <h1>Categories</h1>
            <ul class="navbar-nav d-lg-block">
                <!-- display links for all categories -->
                <?php foreach($categories as $category) : ?>
                <li class="nav-item">
                    <a href="?category_id=<?php 
                            echo $category['category_ID']; ?>">
                        <?php echo $category['category_Name']; ?>
                    </a>
                </li>
                <?php endforeach; ?>
            </ul>
    </div>        
      
    <div class="main-container">
    <form action="." method="post">
        <input type="hidden" name="addProduct" value="<?php echo $product['product_ID']; ?>">
        <input type="hidden" name="action" value="cart_View"> 
        <input type="hidden" name="quantity" value='1'>
        <div class="row">
        <h1><?php echo $companyName; ?></h1>
        </div>
        <div class="row">
        <h1><?php echo $name; ?></h1>
        </div>
        <div class="row">
        <h1>$<?php echo $price; ?></h1>
        </div>
        <?php echo $imageResize;?>
        <div id="left_column">
            
        </div>
        <td><input type="submit" value="Add Item"></td>           

        <div id="right_column">
            
            
        </div>
    </form>
    </div>
</div>  
</div>  
</div>  
</main>
<?php include('footer.php'); ?>