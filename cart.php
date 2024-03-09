<?php
 include "con_pg.php";
 if(isset($_POST['update_update_btn']))
 {
     $update_value=$_POST['update_quantity'];
     $update_id=$_POST['update_quantity_id'];
     $update_quantity_query= pg_query($con,"UPDATE cart SET p_quantity='$update_value' WHERE c_id='$update_id'");
     if($update_quantity_query)
     {
         header('location:cart.php');
     };
 };
 if(isset($_GET['remove']))
 {
     $remove_id=$_GET['remove'];
     pg_query($con,"DELETE FROM cart WHERE c_id='$remove_id'");
     header('location:cart.php');
 };
 if(isset($_GET['delete_all']))
 {
     pg_query($con,"DELETE FROM cart");
     header('location:cart.php');
 }
?>
<html>
<head>
    <link style="text/css" rel="stylesheet" href="Style.css"/>
<link style="text/css" rel="stylesheet" href="style2.css"/>

</head>
<body>
<ul>
<li><a >Home</a></li>
<li><a href="dairy_product.php">Dairy Products</a></li>
<li><a>Profile</a></li>

</ul>
<div class="box7">
    <table border="2">
        <thead>
            <th>image</th>
            <th>name</th>
            <th>price</th>
            <th>quantity</th>
            <th>total price</th>
            <th>action</th>
        </thead>
        <tbody>
        <?php
        $select_cart= pg_query($con,'SELECT * FROM cart');
        $grand_total=0;
        if(pg_num_rows($select_cart)>0)
        {
            while($fetch_cart= pg_fetch_assoc($select_cart))
            {
        ?>
        <tr>
            <td><img src="<?php echo $fetch_cart['p_img'];?>" height="100" alt=""></td>
             <td><?php echo $fetch_cart['p_name'];?> </td>
             <td>$ <?php echo number_format($fetch_cart['p_price']);?></td>
             <td>
        <from action="" method="POST">
            <input type="hidden" name="update_quantity_id" value="<?php echo $fetch_cart['c_id'];?>">
            <input type="number" name="update_quantity" min="1" value="<?php echo $fetch_cart['p_quantity'];?>">
            <input type="submit" value="update" name="update_update_btn">
        </from>
             </td>
             <td>$<?php echo $sub_total= number_format($fetch_cart['p_price'] * $fetch_cart['p_quantity']);?></td>
             <td><a href="cart.php?remove=<?php echo $fetch_cart['c_id'];?>" onclick="return confirm('remove item form cart?')" class="delete-btn">remove</a></td>
        </tr>
        <?php
        $grand_total += $sub_total;
            };
        };
        ?>
        <tr><td>Continue Shopping</td>
            <td>Rs.<?php echo $grand_total;?>/-</td></tr>
    </tbody>
    </table>
     <div><a href="checkout.php" <?=($grand_total >1)?'':'disable';?>"> proceced to checkout</a>
                    </div>
</div>
    <script src="script.js"></script>
<div class="footer"> About Us </div> 
</body>
</html>
      