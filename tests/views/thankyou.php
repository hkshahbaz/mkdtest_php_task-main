<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Thank you</title>
  </head>
  <body>
    

    <div class="container">
    	<div class="row">
    		<div class="col-12">
    			<h1 class="mt-5 text-success">Thank you for purchasing!</h1>
	    		<a href="<?= $GLOBALS['baseurl'];?>" class="btn btn-info mt-4">All Products</a>
    		</div>
    	</div>	
		<div class="row mt-5">
    		

    			<?php $val = $GLOBALS["product"]; ?>
    			<div class="col-8">
    			<table class="table">
                  <thead class="thead-dark">
                    <tr>
                      
                      <th scope="col">Title</th>
                      <th scope="col">Price</th>
                      <th scope="col">Payment Method</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                     
                      <td><?= $val->title; ?></td>
                      <td><?= $val->price; ?></td>
                      <td>Credit Card</td>
                    </tr>
                  </tbody>
                </table>

				</div>
				
	    		
    		
    	</div>

    	
    </div>



    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>