<?php
    require_once("connectvars.php");

    if(@$_POST['addProduct'] && $currentUser3 != 1)
    {
        $productId = $_POST['addProduct'];
        $sql = "SELECT * FROM orders WHERE userId = :userId AND productId = :productId";
        $res = $dbh->prepare($sql);
        $res -> execute(
            array(
                'userId'=>$currentUser3,
                'productId'=>$productId
            )
        );
        $count = $res->rowCount();

        if($count == 0)
        {
            $sql = "INSERT INTO orders (productId, userId, quantity) VALUES (:productId, :userId, '1');";
            $stmt = $dbh -> prepare($sql);
            $stmt -> execute(
                array(
                    'productId'=>$productId,
                    'userId'=>$currentUser3
                )
            );
        }
        header("Location: cart.php");
    }

    else if (@$_POST['addProduct'] && $currentUser3 == 1)
        header("Location: cart.php");
?>
<html>
  <head>
    <title> City Share </title>
  <link rel="stylesheet" href="Assets/BootStrap/css/bootstrap.min.css">
  <meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  </head>
    <body style="padding-top:70px;">
      <div class="container">
        <div class = "row">
          <nav class="navbar navbar-inverse navbar-fixed-top">
              <div class="container">
                <div class="navbar-header">
                  <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                  </button>
                  <a class="navbar-brand" href="home.html">City Share</a>
                </div>
                <div id="navbar" class="collapse navbar-collapse">
                  <ul class="nav navbar-nav">
                    <li class="active"><a href="home.html">Resources</a></li>

                    <li><a data-toggle="modal" data-target="#myModal">Login</a></li>

                  </ul>
                  <ul class="nav navbar-nav navbar-right">
                      <li class="active" > <a align="right" href="edit.html#" >Edit Items</a></li>
                  </ul>
                </div>
              </div>
            </nav>
      </div>
      <p>
    <h1 align="center"> Add Items</h1>
    </p>

      <div class="container">
    <div class="row clearfix">
		<div class="col-md-12 column">
			<table class="table table-bordered table-hover" id="tab_logic">
				<thead>
					<tr >
						<th class="text-center">
							#
						</th>
						<th class="text-center">
							Item
						</th>
						<th class="text-center">
						Quanity
						</th>
            <th class="text-center">
              Description
            </th>
            <th class="text-center">
              Photo
            </th>
					</tr>
				</thead>
				<tbody>
					<tr id='addr0'>
						<td>
						1
						</td>
						<td>
						<input type="text" name='name0'  placeholder='Item' class="form-control"/>
						</td>
						<td>
						<input type="text" name='mail0' placeholder='Quanity' class="form-control"/>
						</td>
						<td>
						<input type="text" name='mobile0' placeholder='Description' class="form-control"/>
						</td>
            <td>
            <input type="file" name='mobile0' placeholder='Photo' class="form-control"/>
            </td>

					</tr>
                    <tr id='addr1'></tr>
				</tbody>
			</table>
		</div>
	</div>
		<a id="add_row" class="btn btn-default btn-add">Add Row</a><a id='delete_row' class="pull-right btn btn-default">Delete Row</a>
</div>
      </div>




    </body>
</html>
