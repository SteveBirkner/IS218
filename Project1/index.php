<!DOCTYPE html>
    <head>
        <meta charset="utf-8">
     
        <title>PHP Bank Site</title>
        <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet" />
        <link rel="stylesheet" href="main.css" type="text/css"/>
      
    <body>
    	
    	<div class="container">
    		<?php 

				
				
				$program = new program;
				
				class program {
				
					    public function __construct() {
				
				                $page = 'homepage';
								$arg = NULL;
								if (isset($_REQUEST['page'])){
									$page = $_REQUEST['page'];
								}
				                if (isset($_REQUEST['arg'])){
									$arg = $_REQUEST['arg'];
								}
								//$arg = $_REQUEST['arg'];
								$page = new $page($arg);
				
				        }
				
					
				
				        public function __destruct() {
				
				                //echo 'goodbye';
				
				        }
				
				
				
				}
				
				abstract class page {
						
						
					public $menu;
					public $content;
					
					function menu() {
						$menu = '<ul class="nav nav-pills">
								    <li>
								        <a href="./index.php">Homepage</a>
								    </li>
								    <li>
								        <a href="./index.php?page=login">Login</a>
								    </li>
								    <li>
								        <a href="./index.php?page=register">Register</a>
								    </li>
								    <li>
								        <a href="./index.php?page=transact">Transactions</a>
								    </li>
								    <li>
								        <a href="./index.php?page=newTran">New Transaction</a>
								    </li>
								</ul>';
					
					return $menu;
					}
						
					function __construct($arg = NULL) {
						
						if ($_SERVER['REQUEST_METHOD'] == 'GET') {
							$this->get();
						} else {
							$this->post();
						}
						
					}
					
					function get() {
						
						
						
						
					}
					
					function post() {
						echo "post";
						
					}
					
					function __destruct() {
						
						echo $this->content;
					}
					
					
				}
				
				class homepage extends page {
					
					function get($arg) {
							$this->content .= $this->menu();
						
					
					}
				
					
				}
				
				class login extends page {
					
					function get($arg) {
						
						$this->content .= $this->menu();
						
						$this->content .= $this->loginForm();
					
					}
					function loginForm() {
						
						$form = '<form action="index.php?page=login" method="post">
									<p>
										<label for="username">Username: </label>
										<input type="text" name="username" id="username"><br>
										<label for="password">Password: </label>
										<input type="password" name="password" id="password"><br>
										<input type="submit" value="Send"><input type="reset">
									</p>
									<p>
										<a href="./index.php?page=register">Register</a><br>
										<a href="./index.php?page=forgot">Forgot Password?</a>
									</p>
								</form>';
						return $form;
						
					}
					
					function post() {
						print_r($_POST);
						
					}
					
				}
				
				class register extends page {
					
					function get($arg){
						$this->content .= $this->menu();
						
						$this->content .= $this->regForm();
					}
					
					function regForm(){
						
						$regf ='<form action="index.php?page=register" method="post">
									<p>
										<label for="username">Username: </label>
										<input type="text" name="username" id="username"><br>
										<label for="password">Password: </label>
										<input type="password" name="password" id="password"><br>
										<label for="email">E-Mail: </label>
										<input type="text" name="email" id="email"><br>
										<input type="submit" value="Send"><input type="reset">
									</p>
								</form>';
						
						return $regf;
					}
				
					function post(){
						print_r($_POST);
					}
					
					
					
				}
				
				class forgot extends page {
					
					function get($arg){
						$this->content .= $this->menu();
						$this->content .= $this->forgotForm();
					}
					
					function forgotForm(){
						
						$forgot ='<form action="index.php?page=forgot" method="post">
									<p>Please enter your username below. An email will be sent to the address associated with the account with information on password recovery.  </p>
									<p>
										<label for="username">Username: </label>
										<input type="text" name="Username" id="username"><br>
									</p>
								</form>';
						
						return $forgot;
					}
				
					function post(){
						print_r($_POST);
					}
				}
				
				class transact extends page {
					function get($arg){
						$this->content .= $this->menu();
						$this->content .= $this->transTable($arg);
					}
					
					function transTable($new) {
							
						$transRows = '<tr>
											<th>Date</th>
											<th>Type</th>
											<th>Source</th>
											<th>Amount</th>
										</tr>
										<tr>
											<td>10/1/13</td>
											<td>Credit</td>
											<td>NJIT</td>
											<td>$4,500.00</td>
										</tr>';
						
						$transRows .= $new;
						
						$transTable = '<table border="1">' . $transRows . '</table><br>
						<a href="./index.php?page=newTran"> New Transaction </a>';
						
						return $transTable;
						
					}
					
					function post(){
						
						$date = '<td>' . $_POST['date'] . '</td>';
						$type = '<td>' . $_POST['type'] . '</td>';
						$source = '<td>' . $_POST['source'] . '</td>';
						$amount = '<td>' . $_POST['amount'] . '</td>';
						
						$new = '<tr>' . $date . $type . $source . $amount . '</tr>';
						//print_r($new);
						$this->get($new);
					}
					
				}
				
				class newTran extends page {
					function get($arg){
						$this->content .= $this->menu();
						$this->content .= $this->transEnt();
					}
					
					
					function transEnt(){
						
						$newForm = '<form action="index.php?page=transact" method="post">
									<p>
										<label for="date">Date: </label>
										<input type="text" name="date" id="date"><br>
										<label for="type">Type: </label><br>
										<input type="radio" name="type" value="credit">Credit<br>
										<input type="radio" name="type" value="debit">Debit<br>
										<label for="source">Source: </label>
										<input type="text" name="source" id="source"><br>
										<label for="amount">Amount: </label>
										<input type="text" name="amount" id="amount"><br>
										<input type="submit" value="Send"><input type="reset">
									</p>
									
								</form>';
						
						
						return $newForm;
						
					}
				}
				
				
				
				
				?>
		  
		</div>
		
		<script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
  
    </body>
</html>


