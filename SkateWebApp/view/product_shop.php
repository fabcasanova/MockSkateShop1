<?php include('header.php'); ?>

<main>

<div class="container">
<div class="row">

    <div class="col">
    
        <div class="sidebar">
            
            <h1>Categories</h1>
            <br />
                <ul class="navbar-nav d-lg-block">
                    <?php foreach($categories as $category) : ?>
                    <li class="nav-item">
                        <a href="?category_id=<?php echo $category['category_ID']; ?>">
                            <?php echo $category['category_Name']; ?>
                        </a>
                    </li>
                    <?php endforeach; ?>
                </ul>
            
        </div>
    </div>
    
    
    
    
    <div class="col col-lg-8">
    
    <nav>
        
        <ul>
            <table>
            <br />
            <h1><?php echo $categoryName; ?></h1>
            <br />
            <tr>
                <td>Company</td>
                <td>Product Name</td>
                <td>
                <a href="?pageNum=<?php echo $pageNum ?>&amp;category_id=<?php echo $category_id; ?>&amp;sort=<?php echo $sort; ?>">Price</a>
                </td>
            </tr>
              
            <?php foreach($products as $product) : ?>    
            <form action="." method="post">
                <input type="hidden" name="addProduct" value="<?php echo $product['product_ID']; ?>">
                <input type="hidden" name="action" value="cart_View"> 
                <input type="hidden" name="quantity" value='1'>
            <tr> 
                <td><a href="?action=view_product&amp;product_id=<?php 
                echo $product['product_ID']; ?>">
                <?php echo $product['company_Name']; ?></td>
                <td><a href="?action=view_product&amp;product_id=<?php 
                echo $product['product_ID']; ?>">
                <?php echo $product['product_Name']; ?></td>
                <td><a href="?action=view_product&amp;product_id=<?php 
                echo $product['product_ID']; ?>">
                <?php echo "$" . $product['product_Price']; ?></td>
                
                <td><input type="submit" value="Add Item"></td>
            </tr>
            </form>
            <?php endforeach; ?>
              
            </table>                    
        </ul>
    </nav>    
    <div class="row">
            <div class="col">
            
            </div>
            
            <div class="col">
            <nav aria-label="PageNumbers">
            <?php if ($totalPages > 0) :?>
            <ul class="pagination">
                <?php if ($pageNum > 1) : ?>
                    <li id="currentpage"><a class="previous" href="?pageNum=<?php echo $pageNum - 1; ?>&amp;category_id=<?php echo $category_id ?>">Prev</a></li>
                <?php endif; ?>
                

                <?php if ($pageNum - 2 > 0) : ?>
                    <li><a class="previous" href="?pageNum=<?php echo $pageNum - 2; ?>&amp;category_id=<?php echo $category_id ?>"><?php echo $pageNum - 2; ?></a></li>
                <?php endif; ?>
                
                <?php if ($pageNum - 1 > 0) : ?>
                    <li><a class="previous" href="?pageNum=<?php echo $pageNum - 1; ?>&amp;category_id=<?php echo $category_id ?>"><?php echo $pageNum - 1; ?></a></li>
                <?php endif; ?>

                <li class="currentpage"><href="?pageNum=<?php echo $pageNum ?>">
                <?php echo $pageNum ?></href></li>

                <?php if ($pageNum + 1 < $totalPages + 1) : ?>
                    <li><a class="previous" href="?pageNum=<?php echo $pageNum + 1; ?>&amp;category_id=<?php echo $category_id ?>"><?php echo $pageNum + 1; ?></a></li>
                <?php endif; ?>

                <?php if ($pageNum + 2 < $totalPages + 1) : ?>
                    <li><a class="previous" href="?pageNum=<?php echo $pageNum + 2; ?>&amp;category_id=<?php echo $category_id ?>"><?php echo $pageNum + 2; ?></a></li>
                <?php endif; ?>

                <?php if ($pageNum < $totalPages) : ?>
                <li><a class="next" href="?pageNum=<?php echo $pageNum + 1; ?>&amp;category_id=<?php echo $category_id ?>">Next</a></li>
                <?php endif; ?>
            </ul>
            <?php endif; ?>
            </nav>  
            <p><a href=".?action=cart_View">View Cart</a></p>
            </div>    
        
    </div>
    </div>
</div>
</div>
</div>
</main>


<? include('footer.php'); ?>