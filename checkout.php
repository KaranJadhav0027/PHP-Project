<?php
include 'con_pg.php';
if(isset($_POST['order_btn'])){
    $name=$_POST['name'];
    $number=$_POST['number'];
    $email=$_POST['email'];
    $method=$_POST['omethod'];
    $flat=$_POST['flat'];
    $street=$_POST['street'];
    $city=$_POST['city'];
    $state=$_POST['state'];
    $country=$_POST['country'];
    $pin_code=$_POST['pin_code'];
    $cart_query= pg_query($con,"SELECT * FORM cart");
    $price_total=0;
    if(pg_num_rows($cart_query)>0){
        while($product_item= pg_fetch_assoc($cart_query)){
            $product_name[]=$product_item['name'].'('.$product_item['quantity'].')';
            $product_price= number_format($product_item['price'] * $product_item['quantity']);
            $price_total+=$product_price;
        };
    };
    $total_product= implode(', ', $product_name);
    $detail_query= pg_query($con,"INSERT INTO order(name,email,omethod,flat,street,city,state,country,pin_code,total_product_total_price)VALUES('$name','$number','$email','$method','$flat','$street','$city','$state','$country','$pin_code','$total_product','$total_price')");
    
    if($cart_query && $detail_query){
        echo"
            <p>your name:<span>".$name."</span></p>
                <p> your number:<span>".$number."</span></p>
                    <p> email:<span>".$email."</span></p>
                        <p>add:<span>".$flat.".".$street.".".$city.".".$state.".".$country.".".$pin_code."</span></p>
                            <p>Payment:<span>".$method."</span></p>
                                
                ";
    }
}
