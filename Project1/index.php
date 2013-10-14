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
								$arg = $_REQUEST['arg'];
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
						$menu = '<div class="nbar"><ul class="nav nav-pills">
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
								    <li>
								        <a href="./index.php?page=logout">Logout</a>
								    </li>
								</ul></div>';
					
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
								
							$arg = $_REQUEST['arg'];
							$this->content .= $this->menu();
							$this->content .= $this->emess($arg);
						
						
					
					}

					function emess($arg) {
						
						if($arg == 1){
							return '<p>Sorry, Your Login Info Was Incorrect!</p>';
						}
						
						
						
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
						if($_POST['username']=='steve' && $_POST['password']=='password') {
							/* session_start();
							$_SESSION['usersname'] = 'Steve'; */
							
							$sess = new session_user;
							$sess->set('Steven Birkner');
							
							header("Location: http://192.168.56.101/index.php?page=transact"); //tables
						}
						else if($_POST['username']=='gob' && $_POST['password']=='pass') {
							session_start();
							$_SESSION['usersname'] = 'Gob';
							header("Location: http://192.168.56.101/index.php?page=transact");
							
						}
						else if($_POST['username']=='dbz' && $_POST['password']=='pass') {
							session_start();
							$_SESSION['usersname'] = 'Gotenks';
							header("Location: http://192.168.56.101/index.php?page=transact");
							
						}
						else {
							header("Location: http://192.168.56.101/index.php?page=homepage&arg=1"); //homepage
						}
						
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
						session_start();
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
						/* if(isset($_SESSION['usersname'])) {
							$user = $_SESSION['usersname'];
						}else {
							$user = NULL;
						} */
						
						$sess = new session_user;
						$user = $sess->getName();
						$transTable = 'Hello! ' . $user . '<table border="1">' . $transRows . '</table><br>
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
				
				class logout extends page {
					
					function __construct() {
					
						$sess = new session_user;
						$sess->resetName();
						$sess->logout();
						
						header("Location: http://192.168.56.101/index.php");
						
					}
					
					
				}
				
				class session {
		
					public function __construct() {
						session_start();
					}
					
					public function logout() {
						session_destroy();
							
					}
					
					
				}
				
				class session_user extends session {
					
					
					public function set($name){
						
						$_SESSION['username'] = $name;
						
					}

					public function getName() {
						
						if(isset($_SESSION['usersname'])) {
							$user = $_SESSION['usersname'];
						}else {
							$user = NULL;
						}
						
						return $user;
						
					}

					public function resetName(){
						
						unset($_SESSION['usersname']);
					}
					
					
				
					
				}
				
				
				
				
				
				?>
		  
		</div>
		
		<script src="//netdna.bootstrapcdn.com/bootstrap/3.0.0/js/bootstrap.min.js"></script>
  
    </body>
</html>


