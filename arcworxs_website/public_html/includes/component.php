<?php


//for Product to Cart remove fitmentname variable and change card to function above
function component($productname, $productprice, $productimg, $productid, $productdescription, $fitmentname){

    $productprice = number_format($productprice,2);
    
    $element = "
    
      <div class=\"col-lg-3 col-md-6\">
                <form action=\"products.php\" method=\"post\">
                    <div class=\"card shadow\" style=\"margin-bottom: 40px;\">
                        <div class=\"card-body\">
                            <h5 class=\"card-title\">$productname</h5>
                        </div>
                        <div>
                            <img src=\"../assets/img/products/$productimg\" class=\"img-fluid card-img-top\" style=\"height:150px; width:150px;\">
                        </div>
                        <div class=\"card-body\">
                            <b><p class=\"card-text\">Compatible Vehicle:</p></b>
                            <p class=\"card-text\">$fitmentname</p>

                            <p class=\"card-text\">
                                $productdescription
                            </p>
                            <h5>
                                <span class=\"price\">$$productprice</span>
                            </h5>

                            <button type=\"submit\" class=\"get-started-btn ml-auto\" name=\"add\">Add to Cart <i class=\"fas fa-shopping-cart\"></i></button>
                            <input type='hidden' name='product_id' value='$productid'>
                        </div>
                    </div>
                </form>
            </div>
    ";
    echo $element;
    
}

function cartElement($productimg, $productname, $productprice, $productid, $productdescription) {
    $productprice = number_format($productprice,2);
   
    
    $element = "
    
    <form action=\"cart.php?action=remove&ProductID=$productid\" method=\"post\" class=\"cart-items\">
                    <div class=\"border rounded\">
                        <div class=\"row bg-white\">
                            <div class=\"col-md-3 py-5\">
                                <img src=\"../assets/img/products/$productimg\" alt=\"Image\" style=\"height:150px; width:150px;\">
                            </div>
                            <div class=\"col-md-3 py-5\">
                                <h5> $productname</h5>
                                <h5> $$productprice</h5>
                                <br>
                                <button type=\"submit\" class=\"btn btn-danger mx-1\" name=\"remove\">Remove</button>
                            </div>
                            
                         
                            <div class=\"col-md-5 py-5\">
                                <div>
                                    <p class=\"pt-2\">$productdescription</p>
                                    <!-- <button type=\"button\" name=\"minus\" id=\"minus\" onclick=\"minus($qauntity)\" class=\"btn bg-light border rounded-circle\"><i class=\"fas fa-minus\"></i></button> -->
                                    <!-- <input type=\"text\" id=\"quantity\" value=\"1\" class=\"form-control w-25 d-inline\"> -->
                                    <!-- <button type=\"button\" name=\"plus\" id=\"plus\" onclick=\"plus()\" class=\"btn bg-light border rounded-circle\"><i class=\"fas fa-plus\"></i></button> -->
                                    <script>
                                    function plus(){
                                        var quantity = document.getElementById(\"quantity\").value = 5;
                                        quantity++;
                                        document.getElementById(\"quantity\").value = quantity;
                                        alert(\"just checking\");
                                    }
                                    function minus(elem){
                                        let targetElem =  document.getElementById(\"quantity\");
                                        let targetCount = parseInt(targetElem.value);
                                        if (targetCount > 1) {
                                            targetCount--;
                                            targetElem.value = targetCount;
                                        }
                                    }
                                    </script>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
    
    ";
    echo  $element;
}

function orderElement($productimg, $productname, $productprice, $productid, $productdescription) {
    $productprice = number_format($productprice,2);
   
    $element = "
    
      <div class=\"col-lg-3 col-md-6\">
                <form action=\"products.php\" method=\"post\">
                    <div class=\"card shadow\" style=\"margin-bottom: 25px;\">
                        <div class=\"card-body\">
                            <h5 class=\"card-title\">$productname</h5>
                        </div>
                        <div>
                            <img src=\"../assets/img/products/$productimg\" class=\"img-fluid card-img-top\" style=\"height:150px; width:150px;\">
                        </div>
                        <div class=\"card-body\">
                            <p class=\"card-text\">
                                $productdescription
                            </p>
                            <h5>
                                <span class=\"price\">$$productprice</span>
                            </h5>

                           
                        </div>
                    </div>
                </form>
            </div>
    ";
    echo $element;
}







