<?php include('header.php'); ?>

<main>

<?php if (empty($_SESSION['cart']) || count($_SESSION['cart']) == 0) : ?>
<div class="main-container">
<h1>There are no items in cart</h1>
<p><a href=".?action=empty_cart">Empty Cart</a></p>
<p><a href=".?action=list_products">Keep Shopping</a></p>
</div>

<?php else: ?>
<div class="main-container">
    <form action="." method="post">
    <input type="hidden" name="action" value="update">

    <table>
            <tr>
                <th>Company</th>
                <th>Product Name</th>
                <th>Cost</th>
                <th>Quantity</th>
                <th>Item Total</th>
            </tr>
              
            <?php foreach($_SESSION['cart'] as $key => $item) :   
                 $cost  = number_format($item['cost'], 2);
                 $total = number_format($item['total'], 2);?>  
            
            <tr> 
                <td><?php echo $item['company'];?></td>
                <td><?php echo $item['productName'];?></td>
                <td><?php echo $item['cost'];?></td>
                <td><input type="text" name="newquantity[<?php echo $key;?>]" 
                                value="<?php echo $item['qty'];?>"></td>
                
                
                <td><?php echo $item['total'];?></td>
            </tr>
            
            <?php endforeach; ?>

            <tr>
                <td colspan="4">SUBTOTAL</td>
                <td>$<?php echo subTotal();?></td>
            </tr>
            <tr>
                <td colspan="4"><input type="submit" value="Update Cart"></td>
            </tr>
              
            </table>               
    </form>
    <form action="." method="post">
        <input type="hidden" name="action" value="checkout"> 
        <input type="submit" value="Checkout">
        
    </form>
            
            <p><a href=".?action=empty_cart">Empty Cart</a></p>
            <p><a href=".?action=list_products">Keep Shopping</a></p>
            <?php endif;?>
</div>
</main>
<?php include('footer.php'); ?>