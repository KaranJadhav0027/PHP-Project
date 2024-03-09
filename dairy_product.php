<?php
include"con_pg.php";
//include "auth.php";
if(isset($_POST['add_to_cart']))
{
    $p_name=$_POST['p_name'];
    $p_price=$_POST['p_price'];
    $p_img=$_POST['p_img'];
    $p_quantity=1;
    $select_cart= pg_query($con,"SELECT * FROM cart WHERE p_name='$p_name'");
    if(pg_num_rows($select_cart)>0)
    {
        $message[]='Product already added to cart';
        
    }
    else
    {
        $insert_product= pg_query($con,"INSERT INTO cart (p_name, p_price, p_img, p_quantity) VALUES ('$p_name',$p_price, '$p_img',$p_quantity)");
        $message[]='Product added to cart succesfully.....';
    }
}

?>
<!doctype html>
<html>
<head>
<link style="text/css" rel="stylesheet" href="Style.css"/>
<link style="text/css" rel="stylesheet" href="style2.css"/>
<link style="text/css" rel="stylesheet" href="style_new.css"/>
</head>
<body>
    <?php
if(isset($message))
{
  foreach($message as $message)
  {
      echo'<div class="message"><span>'.$message.'</span><i class="fas fa-times" onclick="this.parentElement.style.display=none;"</i></div>';
  };
};
    ?>
    <?php //include 'header_new.php'?>
<ul>
<li><a >Home</a></li>
<li><a href="dairy_product.php">Dairy Products</a></li>
<li><a href="logout.php" >Profile Logout </a></li>
<?php
$select_rows= pg_query($con,"SELECT * FROM cart") or die("query faild");
$row_count= pg_num_rows($select_rows);
?>
<a href="cart.php" >cart <span><?php echo $row_count;?></span></a>
<!-- <h2><?php //echo $_SESSION['u_name'];?></h2> -->
</ul>
   <div class="box7">
       <?php
       $select_products= pg_query($con,"SELECT * FROM products");
       if(pg_num_rows($select_products)>0)
       {
           while ($fetch_product=pg_fetch_assoc($select_products))
           {
       ?>
       <form action="" method="POST">
           <div class="itembox1">
               <img src="image/<?php echo $fetch_product['p_img'];?>" alt="">
               <div class="p_name"><?php echo $fetch_product['p_name'];?></div>
               <div class="p_price">$<?php echo $fetch_product['p_price'];?></div>
               <input type="hidden" name="p_name" value="<?php echo $fetch_product['p_name'];?>">
               <input type="hidden" name="p_price" valve="<?php echo $fetch_product['p_price'];?>">
               <input type="hidden" name="p_img" value="<?php echo $fetch_product['p_img'];?>">
               <input type="submit" value="Add to Cart" name="add_to_cart">
           </div>  
       </form>
       <?php
           };
       };
//pg_close($con);
?>
       </div>
    <script src="script.js"></script>
<div class="footer"> About Us </div> 
</body>
</html>
      