<?php

@include("functions.php");

class check extends systemData{

}
$check = new check;

$output = '<div class="row">';
$result = $check->preparedQuery("SELECT * FROM books WHERE status='enable' ORDER BY id DESC");
while ($row = $result->fetch_array()){
  ($row['id'] == 30) ? $tableOfContents = '#bkcontent' : $tableOfContents = '';

  $output .= '
        <div class="col-md-3" style="margin-top:12px;">
          <div style="border:1px solid #333; background-color:#f1f1f1; border-radius:5px; padding:16px; height:350px;" align="center">
             <a href="#" data-toggle="modal" data-target="'.$tableOfContents.'">
              <img src="upload/'.$row["cover_image"].'" class="img-responsive" style="width: 60%;border-radius: 15px;" />
             </a><br><br>
             <h6 class="text-info"><a href="book&bookid='.$row["id"].'">'.$row["title"].'</a></h6>
             <h6 class="text-danger">Price: '.$row["price"] .' EGP</h6>';
    @$user = $check->preparedQuery("SELECT * FROM users WHERE email=?",array($_SESSION['login']),'select_row');
      if(isset($_SESSION['login']) && $user['type'] == 'buyer'){
        $output .= '<div class="row">
              <div class="col-md-4">
                <input type="text" name="quantity" id="quantity' . $row["id"] .'" class="form-control" value="1" />
              </div>
              <div class="col-md-8">
                <button type="button" name="add_to_cart" idproduct="'.$row["id"].'" id="add_to_cart'.$row["id"].'" class="btn btn-success form-control add_to_cart">Add to Cart</button>
              </div>
             </div>
             <input type="hidden" name="hidden_name" id="name'.$row["id"].'" value="'.$row["title"].'" />
             <input type="hidden" name="hidden_price" id="price'.$row["id"].'" value="'.$row["price"].'" />';
        }
  $output .= '</div>
        </div>
  ';
 }
 $output .= '</div>';
 echo $output;
