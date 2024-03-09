


<header class="header">

   <div class="flex">

      <a href="#" class="logo">foods</a>

      <nav class="navbar">
         <a href="admin.php">add products</a>
         <a href="dairy_product.php">view products</a>
      </nav>

      <?php
      
      $select_rows = pg_query($conn, "SELECT * FROM cart") or die('query failed');
      $row_count = pg_num_rows($select_rows);

      ?>

      <a href="cart.php" class="cart">cart <span><?php echo $row_count; ?></span> </a>

      <div id="menu-btn" class="fas fa-bars"></div>

   </div>

</header>