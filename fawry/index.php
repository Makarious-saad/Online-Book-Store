<!DOCTYPE html>
<html>
<head>
  <title>Fawry</title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
  <div class="header">
  	<h2>Pay by Fawry</h2>
  </div>

  <form method="post" action="server.php">
  	<div class="input-group">
  		<label>Price</label>
  		<input type="number" name="price">
  	</div>
  	<div class="input-group">
  		<label>Code</label>
  		<input type="number" name="code">
  	</div>
  	<div class="input-group">
      <input type="hidden" name="user" value="12345">
  		<button type="submit" class="btn" name="payment_user">submit</button>
  	</div>

  </form>
</body>
</html>
