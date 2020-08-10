<?php
@include("functions.php");

class check extends systemData{

}
$check = new check;

// Save new user
if(isset($_POST['checkMail'])){
  // Filter input
  $arr = $check->xss_clean_arr(array('email'),'post');
  if(!filter_var($arr['email'], FILTER_VALIDATE_EMAIL)){
    // Invalid email format
    @header("Location: /registration&error=invalid_email");
    exit();
  }else{
    // Create Code
    $code = rand(10000,99999);
    // Values
    $subject = 'Please confirm your email';
    $url = '<a href="'.$check->siteURL.'registration-data&code='.$code.'">'.$check->siteURL.'registration-data&code='.$code.'</a>';
    $body = 'Hello, <br> Please confirm your email <br> To continue registering, please click on the following link '.$url.'<br> Thank you';
    $emails = array($arr['email']);

    // Send Email
    $check->PHPMailer($check->siteName,$subject,$body,$emails);
    // Save email & code in SESSION
    $_SESSION['email'] = $arr['email'];
    $_SESSION['code'] = '123123123'; // Demo $code

    // Redirection success
    @header("Location: /?success=send");
    exit();
  }
}





if(isset($_POST['newUser'])){
  // Filter input
  $arr = $check->xss_clean_arr(array('form_code','frist_name','last_name','password','confirm_password','phone','type'),'post');
  // Password matches the confirmation password & Bigger than or equal 5 & Not contain email & Contains signs
  if($arr['password'] == $arr['confirm_password'] && strlen($arr['password']) >= 8 && !strpos( $arr['password'], $_SESSION['email'] ) !== false && !ctype_alnum($arr['password'])){
    // Phone Number equal 11
    if(strlen($arr['phone']) == 11){
      // Frist name & Last name is not empty
      if($arr['frist_name'] != NULL && $arr['last_name'] != NULL){
        // Password encryption
        $password = md5($arr['password']);
        $email = $_SESSION['email'];

        // Insert
        $userData = $check->preparedQuery("INSERT INTO users (first_name,last_name,email,password,phone,account_type,type,created_at)
                        VALUES (?,?,?,?,?,?,?,?)",array($arr['frist_name'],$arr['last_name'],$email,$password,$arr['phone'],'user',$arr['type'],date("Y-m-d H:i:s")),'insert');

        // Save user data in SESSION
        $_SESSION['login'] = $_SESSION['email'];
        $_SESSION['UserID'] = $userData;

        // Redirection
        @header("Location: /interesting&success=registration");
        exit();

      }else{
        // Redirection
        @header("Location: /registration-data&code=".$arr['form_code']."&error=name");
        exit();
      }
    }else{
      // Redirection
      @header("Location: /registration-data&code=".$arr['form_code']."&error=phone");
      exit();
    }
  }else{
    // Redirection
    @header("Location: /registration-data&code=".$arr['form_code']."&error=password");
    exit();
  }
}





// Interesting
if(isset($_POST['interesting'])){
  // Filter input
  $input = array();
  for($i=1;$i<=11;$i++){
    $input[] = $check->xss_clean_arr(array('checkbox'.$i),'post');
  }
  $input = json_encode($input);
  //print_r($input);
  $check->preparedQuery("UPDATE users SET interesting=? WHERE email=?",array($input,$_SESSION['login']));

  // Redirection
  @header("Location: /interesting&success=update");
  exit();
}





// Login
if (isset($_POST['submit'])) {
  // connect to the database
  $db = mysqli_connect('localhost', 'root', 'root', 'heba');

  $email = mysqli_real_escape_string($db, $_POST['email']);
  $password = mysqli_real_escape_string($db, $_POST['password']);

  if (empty($email)) {
  	array_push($errors, "Email is required");
  }
  if (empty($password)) {
  	array_push($errors, "Password is required");
  }

  if (count($errors) == 0) {
  	$password = md5($password);
  	$query = "SELECT * FROM users WHERE email='$email' AND password='$password'";
  	$results = mysqli_query($db, $query);
  	if (mysqli_num_rows($results) == 1) {
      $row = mysqli_fetch_array($results);
      $_SESSION['login'] = $email;
      $_SESSION['UserID'] = $row['id'];
      // Redirection
      @header("Location: /?success=login");
      exit();
  	}else {
  		array_push($errors, "Wrong Email/password combination");
      // Redirection
      @header("Location: /login&error=login");
      exit();
  	}
  }
}





// City
if (isset($_POST['new-city'])) {
  // Filter input
  $arr = $check->xss_clean_arr(array('name'),'post');

  if($arr['name'] == NULL){

    // Redirection
    @header("Location: /admincp/cities?error=add");
    exit();

  }else{

    // Insert
    $check->preparedQuery("INSERT INTO cities (name) VALUES (?)",array($arr['name']));

    // Redirection
    @header("Location: /admincp/cities?success=add");
    exit();

  }
}



// Edit City
if (isset($_POST['edit-city'])) {
  // Filter input
  $arr = $check->xss_clean_arr(array('id','name'),'post');

  if($arr['name'] == NULL){

    // Redirection
    @header("Location: /admincp/cities?error=update");
    exit();

  }else{

    // ID
    $id = $arr['id'];

    // Update
    $check->preparedQuery("UPDATE cities SET name=? WHERE id=?", array($arr['name'],$id));

    // Redirection
    @header("Location: /admincp/cities?success=update");
    exit();

  }
}



// Delete City
if (isset($_GET['city'])) {
  // ID
  $id = intval($_GET['city']);

  // Update
  $check->preparedQuery("DELETE FROM cities WHERE cities.id=?",array($id));

  // Redirection
  @header("Location: /admincp/cities?success=delete");
  exit();
}



// Area
if (isset($_POST['new-area'])) {
  // Filter input
  $arr = $check->xss_clean_arr(array('city','shipping_fee','name'),'post');

  if($arr['city'] == NULL || $arr['shipping_fee'] == NULL || $arr['name'] == NULL){

    // Redirection
    @header("Location: /admincp/areas?error=add");
    exit();

  }else{

    // Insert
    $check->preparedQuery("INSERT INTO areas (city_id,shipping_fee,name)
      VALUES (?,?,?)", array($arr['city'],$arr['shipping_fee'],$arr['name']));

    // Redirection
    @header("Location: /admincp/areas?success=add");
    exit();

  }
}



// Edit Area
if (isset($_POST['edit-area'])) {
  // Filter input
  $arr = $check->xss_clean_arr(array('id','city','shipping_fee','name'),'post');

  if($arr['shipping_fee'] == NULL || $arr['name'] == NULL){

    // Redirection
    @header("Location: /admincp/areas?error=update");
    exit();

  }else{

    // ID
    $id = $arr['id'];

    // Update
    $check->preparedQuery("UPDATE areas SET city_id=?, shipping_fee=?, name=? WHERE id=?",
    array($arr['city'],$arr['shipping_fee'],$arr['name'],$id));

    // Redirection
    @header("Location: /admincp/areas?success=update");
    exit();

  }
}



// Delete Area
if (isset($_GET['area'])) {
  // ID
  $id = intval($_GET['area']);

  // Update
  $check->preparedQuery("DELETE FROM areas WHERE areas.id=?",array($id));

  // Redirection
  @header("Location: /admincp/areas?success=delete");
  exit();
}



// Author
if (isset($_POST['new-author'])) {
  // Filter input
  $arr = $check->xss_clean_arr(array('name'),'post');

  if($arr['name'] == NULL){

    // Redirection
    @header("Location: /admincp/authors?error=add");
    exit();

  }else{

    // Insert
    $check->preparedQuery("INSERT INTO authors (name) VALUES (?)", array($arr['name']));

    // Redirection
    @header("Location: /admincp/authors?success=add");
    exit();

  }
}



// Edit Author
if (isset($_POST['edit-author'])) {
  // Filter input
  $arr = $check->xss_clean_arr(array('id','name'),'post');

  if($arr['name'] == NULL){

    // Redirection
    @header("Location: /admincp/authors?error=update");
    exit();

  }else{

    // ID
    $id = $arr['id'];

    // Update
    $check->preparedQuery("UPDATE authors SET name=? WHERE id=?", array($arr['name'],$id));

    // Redirection
    @header("Location: /admincp/authors?success=update");
    exit();

  }
}



// Delete Author
if (isset($_GET['author'])) {
  // ID
  $id = intval($_GET['author']);

  // Update
  $check->preparedQuery("DELETE FROM authors WHERE authors.id=?",array($id));

  // Redirection
  @header("Location: /admincp/authors?success=delete");
  exit();
}



// Publisher
if (isset($_POST['new-publisher'])) {
  // Filter input
  $arr = $check->xss_clean_arr(array('name'),'post');

  if($arr['name'] == NULL){

    // Redirection
    @header("Location: /admincp/publishers?error=add");
    exit();

  }else{

    // Insert
    $check->preparedQuery("INSERT INTO publishers (name) VALUES (?)", array($arr['name']));

    // Redirection
    @header("Location: /admincp/publishers?success=add");
    exit();

  }
}



// Edit Publisher
if (isset($_POST['edit-publisher'])) {
  // Filter input
  $arr = $check->xss_clean_arr(array('id','name'),'post');

  if($arr['name'] == NULL){

    // Redirection
    @header("Location: /admincp/publishers?error=update");
    exit();

  }else{

    // ID
    $id = $arr['id'];

    // Update
    $check->preparedQuery("UPDATE publishers SET name=? WHERE id=?", array($arr['name'],$id));

    // Redirection
    @header("Location: /admincp/publishers?success=update");
    exit();

  }
}



// Delete Publisher
if (isset($_GET['publisher'])) {
  // ID
  $id = intval($_GET['publisher']);

  // Update
  $check->preparedQuery("DELETE FROM publishers WHERE publishers.id=?",array($id));

  // Redirection
  @header("Location: /admincp/publishers?success=delete");
  exit();
}



// Category
if (isset($_POST['new-category'])) {
  // Filter input
  $arr = $check->xss_clean_arr(array('title'),'post');

  if($arr['title'] == NULL){

    // Redirection
    @header("Location: /admincp/categories?error=add");
    exit();

  }else{

    // Insert
    $check->preparedQuery("INSERT INTO categories (title) VALUES (?)", array($arr['title']));

    // Redirection
    @header("Location: /admincp/categories?success=add");
    exit();

  }
}



// Edit Category
if (isset($_POST['edit-category'])) {
  // Filter input
  $arr = $check->xss_clean_arr(array('id','title'),'post');

  if($arr['title'] == NULL){

    // Redirection
    @header("Location: /admincp/categories?error=update");
    exit();

  }else{

    // ID
    $id = $arr['id'];

    // Update
    $check->preparedQuery("UPDATE categories SET title=? WHERE id=?", array($arr['title'],$id));

    // Redirection
    @header("Location: /admincp/categories?success=update");
    exit();

  }
}



// Delete Category
if (isset($_GET['category'])) {
  // ID
  $id = intval($_GET['category']);

  // Update
  $check->preparedQuery("DELETE FROM categories WHERE id=?",array($id));

  // Redirection
  @header("Location: /admincp/categories?success=delete");
  exit();
}



// Book
if (isset($_POST['add-new'])) {
  // Filter input
  $arr = $check->xss_clean_arr(array('isbn','title','pdf','cover','category','author','publisher','released','qty','price','description'),'post');

  if($arr['isbn'] == NULL || $arr['title'] == NULL || $arr['author'] == NULL || $arr['category'] == NULL || $arr['publisher'] == NULL || $arr['released'] == NULL || $arr['qty'] == NULL || $arr['price'] == NULL || $arr['description'] == NULL){

    // Redirection
    @header("Location: /admincp/books?error=add");
    exit();

  }else{

    // Check ISBN
    $book = $check->preparedQuery("SELECT id FROM books WHERE isbn=?",array($arr['isbn']),'num');
    if($book == 0){

      // Upload Cover
      $cover = $check->uploadPhoto('cover','../upload');

      // Insert
      $check->preparedQuery("INSERT INTO books (isbn,category_id,author_id,publisher_id,user_id,title,description,released,qty,price,url_pdf,cover_image,status,created_at)
        VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?)",
        array($arr['isbn'],$arr['category'],$arr['author'],$arr['publisher'],$_SESSION['UserID'],$arr['title'],$arr['description'],$arr['released'],$arr['qty'],$arr['price'],$arr['pdf'],$cover,'active',date("Y-m-d H:i:s")));

      // Redirection
      @header("Location: /admincp/books?success=add");
      exit();

    }else{

      // Redirection
      @header("Location: /admincp/books?error=duplicate");
      exit();

    }
  }
}




// Edit Book
if (isset($_POST['edit-book'])) {
  // Filter input
  $arr = $check->xss_clean_arr(array('id','title','pdf','cover','category','author','publisher','released','qty','price','description'),'post');

  if($arr['title'] == NULL || $arr['released'] == NULL || $arr['qty'] == NULL || $arr['price'] == NULL || $arr['description'] == NULL){

    // Redirection
    @header("Location: /admincp/books?error=update");
    exit();

  }else{

    // ID
    $id = $arr['id'];

    if(!empty($_FILES['cover']['name'])){
      // Upload Cover
      $cover = $check->uploadPhoto('cover','../upload');

      // Update Cover
      $check->preparedQuery("UPDATE books SET cover_image=? WHERE id=?",array($cover,$id));
    }


    // Update
    $check->preparedQuery("UPDATE books SET category_id=?, author_id=?, publisher_id=?, title=?, description=?, released=?, qty=?, price=?, url_pdf=? WHERE id=?",
    array($arr['category'],$arr['author'],$arr['publisher'],$arr['title'],$arr['description'],$arr['released'],$arr['qty'],$arr['price'],$arr['pdf'],$id));


    // Redirection
    @header("Location: /admincp/books?success=update");
    exit();

  }
}



// Delete Book
if (isset($_GET['book'])) {
  // ID
  $id = intval($_GET['book']);

  // Update
  $check->preparedQuery("DELETE FROM books WHERE books.id=?",array($id));

  // Redirection
  @header("Location: /admincp/books?success=delete");
  exit();
}



// Edit User
if (isset($_POST['edit-user'])) {
  // Filter input
  $arr = $check->xss_clean_arr(array('id','first_name','last_name','email','password','phone','type'),'post');

  if($arr['first_name'] == NULL || $arr['last_name'] == NULL || $arr['email'] == NULL || $arr['phone'] == NULL){

    // Redirection
    @header("Location: /admincp/users?error=update");
    exit();

  }else{

    // ID
    $id = $arr['id'];

    // Update Password
    if($arr['password'] !== NULL){
      // Password encryption
      $password = md5($arr['password']);

      // Update Password
      $check->preparedQuery("UPDATE users SET password=? WHERE id=?",array($password,$id));
    }

    // Update
    $check->preparedQuery("UPDATE users SET first_name=?, last_name=?, email=?, phone=?, type=? WHERE id=?",
    array($arr['first_name'],$arr['last_name'],$arr['email'],$arr['phone'],$arr['type'],$id));

    // Redirection
    @header("Location: /admincp/users?success=update");
    exit();

  }
}




// Edit Admin
if (isset($_POST['edit-admin'])) {
  // Filter input
  $arr = $check->xss_clean_arr(array('id','first_name','last_name','email','password','phone'),'post');

  if($arr['first_name'] == NULL || $arr['last_name'] == NULL || $arr['email'] == NULL || $arr['phone'] == NULL){

    // Redirection
    @header("Location: /admincp/managers?error=update");
    exit();

  }else{

    // ID
    $id = $arr['id'];

    // Update Password
    if($arr['password'] !== NULL){
      // Password encryption
      $password = md5($arr['password']);

      // Update Password
      $check->preparedQuery("UPDATE users SET password=? WHERE id=?",array($password,$id));
    }

    // Update
    $check->preparedQuery("UPDATE users SET first_name=?, last_name=?, email=?, phone=? WHERE id=?",
    array($arr['first_name'],$arr['last_name'],$arr['email'],$arr['phone'],$id));

    // Redirection
    @header("Location: /admincp/managers?success=update");
    exit();

  }
}



// checkout By New Address
if (isset($_POST['checkoutAddress'])) {
  // Filter input
  $arr = $check->xss_clean_arr(array('first_name','last_name','area','street','phone'),'post');

  if($arr['first_name'] == NULL || $arr['last_name'] == NULL || $arr['phone'] == NULL | $arr['area'] == NULL | $arr['street'] == NULL){

    // Redirection
    @header("Location: /shipping-info?error=add");
    exit();

  }else{

    // Insert
    $address = $check->preparedQuery("INSERT INTO addresses (user_id,first_name,last_name,phone,area_id,street_st,created_at)
      VALUES (?,?,?,?,?,?,?)",array($_SESSION['UserID'],$arr['first_name'],$arr['last_name'],$arr['phone'],$arr['area'],$arr['street'],date("Y-m-d H:i:s")), 'insert');

    // Details
    $area = $check->preparedQuery("SELECT * FROM areas WHERE id=?",array($arr['area']),'select_row');
    $city = $check->preparedQuery("SELECT name FROM cities WHERE id=?",array($area['city_id']),'select_row')['name'];
    $_SESSION['Area'] = $area['name'];
    $_SESSION['AreaID'] = $area['shipping_fee'];
    $_SESSION['City'] = $city;
    $_SESSION['AddressID'] = $address;
    $_SESSION['ShippingFee'] = $area['shipping_fee'];

    // Redirection
    @header("Location: /check-out");
    exit();

  }
}




// checkout By ID Address
if (isset($_POST['checkoutID'])) {
  // Filter input
  $arr = $check->xss_clean_arr(array('address'),'post');

  if($arr['address'] == NULL){

    // Redirection
    @header("Location: /shipping-info?error=add");
    exit();

  }else{

    // Get Address
    $address = $check->preparedQuery("SELECT * FROM addresses WHERE id=?",array($arr['address']),'select_row');

    // Details
    $area = $check->preparedQuery("SELECT * FROM areas WHERE id=?",array($address['area_id']),'select_row');
    $city = $check->preparedQuery("SELECT name FROM cities WHERE id=?",array($area['city_id']),'select_row')['name'];
    $_SESSION['Area'] = $area['name'];
    $_SESSION['AreaID'] = $area['shipping_fee'];
    $_SESSION['City'] = $city;
    $_SESSION['AddressID'] = $address['id'];
    $_SESSION['ShippingFee'] = $area['shipping_fee'];

    // Redirection
    @header("Location: /check-out");
    exit();

  }
}



// Delete Address
if (isset($_POST['deleteAddress'])) {
  // ID
  $id = intval($_POST['id']);

  // Delete
  $check->preparedQuery("DELETE FROM addresses WHERE addresses.id=?",array($id));

  // Redirection
  @header("Location: /addresses?success=delete");
  exit();
}




// Order Now
if (isset($_POST['order-now'])) {
  // Filter input
  $arr = $check->xss_clean_arr(array('total_price'),'post');

  if($_SESSION["shopping_cart"] == 'resale'){

    // Insert in orders
    $orderID = $check->preparedQuery("INSERT INTO orders (user_id,resale_book,address_id,qty,products,total_price,status,created_at)
                  VALUES (?,?,?,?,?,?,?,?)",array($_SESSION['UserID'],$_SESSION["bookID"],$_SESSION['AddressID'],1,'[]',$arr['total_price'],'pending',date("Y-m-d H:i:s")), 'insert');

   // Insert in shipment
   $check->preparedQuery("INSERT INTO shipment (order_id,address_id,status,created_at)
     VALUES (?,?,?,?)",array($orderID,$_SESSION['AddressID'],'pending',date("Y-m-d H:i:s")));

    // Page
    $page = "Location: /store?success=checked";
  }else{

    // Generate Payment Code
    $_SESSION['CodePayment'] = rand(1000000,9999999);

    // Save products in json
    $products = array();
    foreach ($_SESSION["shopping_cart"] as $key => $value)
      $products[] = $_SESSION["shopping_cart"][$key]['product_id'];


    // Insert in orders
    $orderID = $check->preparedQuery("INSERT INTO orders (user_id,resale_book,address_id,qty,products,total_price,status,created_at)
      VALUES (?,?,?,?,?,?,?,?)",array($_SESSION['UserID'],0,$_SESSION['AddressID'],count($products),json_encode($products),$arr['total_price'],'pending',date("Y-m-d H:i:s")), 'insert');

   // Insert in shipment
   $check->preparedQuery("INSERT INTO shipment (order_id,address_id,status,created_at)
      VALUES (?,?,?,?)",array($orderID,$_SESSION['AddressID'],'pending',date("Y-m-d H:i:s")));

  // Insert in payment
  $check->preparedQuery("INSERT INTO payment (order_id,user_id,code,status,created_at)
     VALUES (?,?,?,?,?)",array($orderID,$_SESSION['UserID'],$_SESSION['CodePayment'],'unpaid',date("Y-m-d H:i:s")));

  // Page
  $page = "Location: /payment-code?success=order";
 }

  // Make SESSION NULL
  $_SESSION['Area'] = NULL;
  $_SESSION['AreaID'] = NULL;
  $_SESSION['City'] = NULL;
  $_SESSION['AddressID'] = NULL;
  $_SESSION['ShippingFee'] = NULL;
  $_SESSION["bookID"] = NULL;
  $_SESSION["shopping_cart"] = NULL;

  // Redirection
  @header($page);
  exit();
}




// Resale new book
if (isset($_POST['resale-new'])) {
  // Filter input
  $arr = $check->xss_clean_arr(array('isbn','title','cover','category','author','publisher','released','status','price','description'),'post');

  if($arr['isbn'] == NULL || $arr['title'] == NULL || $arr['author'] == NULL || $arr['category'] == NULL || $arr['publisher'] == NULL || $arr['released'] == NULL || $arr['price'] == NULL || $arr['description'] == NULL){

    // Redirection
    @header("Location: /add-new?error=add");
    exit();

  }else{

    // Check ISBN
    $book = $check->preparedQuery("SELECT id FROM books WHERE isbn=?",array($arr['isbn']),'num');
    if($book == 0){

      // Upload Cover
      $cover = $check->uploadPhoto('cover','../upload');

      // Insert
      $_SESSION["bookID"] = $check->preparedQuery("INSERT INTO books (isbn,category_id,author_id,publisher_id,user_id,title,description,released,qty,price,book_type,cover_image,status,created_at)
                              VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?)",
                              array($arr['isbn'],$arr['category'],$arr['author'],$arr['publisher'],$_SESSION['UserID'],$arr['title'],$arr['description'],$arr['released'],1,$arr['price'],$arr['status'],$cover,'pending',date("Y-m-d H:i:s")), 'insert');

      // New SESSION
      $_SESSION["shopping_cart"] = 'resale';

      // Redirection
      @header("Location: /shipping-info");
      exit();

    }else{

      // Redirection
      @header("Location: /select-store?error=duplicate");
      exit();

    }

  }
}



// Resale old book
if (isset($_POST['resale-old'])) {
  // Filter input
  $arr = $check->xss_clean_arr(array('isbn','status','price'),'post');

  if($arr['isbn'] == NULL ){

    // Redirection
    @header("Location: /select-store?error=add");
    exit();

  }else{

    // Select book
    $book = $check->preparedQuery("SELECT * FROM books WHERE id=?",array($arr['isbn']),'select_row');

    // Insert book
    $_SESSION["bookID"] = $check->preparedQuery("INSERT INTO books (isbn,category_id,author_id,publisher_id,user_id,title,description,released,qty,book_type,price,cover_image,status,created_at)
                            VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?)",
                            array($book['isbn'],$book['category_id'],$book['author_id'],$book['publisher_id'],$_SESSION['UserID'],$book['title'],$book['description'],$book['released'],1,$arr['status'],$arr['price'],$book['cover_image'],'pending',date("Y-m-d H:i:s")), 'insert');

    // New SESSION
    $_SESSION["shopping_cart"] = 'resale';

    // Redirection
    @header("Location: /shipping-info");
    exit();

  }
}



// Change the order of the orders
if (isset($_GET['order'])) {
  // Filter input
  $arr = $check->xss_clean_arr(array('order','id'),'get');

  if($arr['order'] == NULL || $arr['id'] == NULL){

    // Redirection
    @header("Location: /admincp/orders?error=status");
    exit();

  }else{

    // Resale Book
    $order = $check->preparedQuery("SELECT * FROM orders WHERE id=?",array($arr['id']),'select_row');


    if($arr['order'] == 'approval'){
      $check->preparedQuery("UPDATE orders SET status='approved' WHERE id=?",array($arr['id']));

      if($order['resale_book'] > 0){
        $check->preparedQuery("UPDATE books SET status='receiving' WHERE id=?",array($order['resale_book']));
        $page = "Location: /admincp/resale?success=status";
      }else{
        $page = "Location: /admincp/orders?success=status";
      }

    }elseif($arr['order'] == 'charging'){
      $check->preparedQuery("UPDATE shipment SET status='charging' WHERE order_id=?",array($arr['id']));

      if($order['resale_book'] > 0){
        $page = "Location: /admincp/resale?success=status";
      }else{
        $page = "Location: /admincp/orders?success=status";
      }

    }elseif($arr['order'] == 'received'){
      $check->preparedQuery("UPDATE shipment SET status='received' WHERE order_id=?",array($arr['id']));

      if($order['resale_book'] > 0){
        $bookQTY = $check->preparedQuery("SELECT qty FROM books WHERE id=?",array($order['resale_book']),'select_row')['qty'];
        $qty = intval($bookQTY) - 1;
        $check->preparedQuery("UPDATE books SET status='enable',qty=? WHERE id=?",array($qty,$order['resale_book']));

        $bookQTY = $check->preparedQuery("SELECT qty FROM books WHERE id=?",array($order['resale_book']),'select_row')['qty'];
        if($bookQTY == 0)
          $check->preparedQuery("UPDATE books SET status='disabled' WHERE id=?",array($order['resale_book']));

        $page = "Location: /admincp/resale?success=status";

      }else{
        foreach (json_decode($order['products'], true) as $key => $value) {
          $bookQTY = $check->preparedQuery("SELECT qty FROM books WHERE id=?",array($value),'select_row')['qty'];
          $qty = intval($bookQTY) - 1;
          $check->preparedQuery("UPDATE books SET status='enable',qty=? WHERE id=?",array($qty,$value));

          $bookQTY = $check->preparedQuery("SELECT qty FROM books WHERE id=?",array($value),'select_row')['qty'];
          if($bookQTY == 0)
            $check->preparedQuery("UPDATE books SET status='disabled' WHERE id=?",array($value));
        }

        $page = "Location: /admincp/orders?success=status";

      }

    }elseif($arr['order'] == 'rejection'){
      $check->preparedQuery("UPDATE orders SET status='rejection' WHERE order_id=?",array($arr['id']));

      if($order['resale_book'] > 0){
        $check->preparedQuery("UPDATE books SET status='rejection' WHERE id=?",array($order['resale_book']));
        $page = "Location: /admincp/resale?success=status";
      }else{
        $page = "Location: /admincp/orders?success=status";
      }

    }

    // Redirection
    @header($page);
    exit();

  }
}
?>
