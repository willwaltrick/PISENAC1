<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="ISO-8858-1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>SenaQuiz</title>
    <link href="../../dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="../../assets/css/ie10-viewport-bug-workaround.css" rel="stylesheet">
    <link href="sticky-footer-navbar.css" rel="stylesheet">
    <script src="../../assets/js/ie-emulation-modes-warning.js"></script>

      <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  <link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet' type='text/css'>
  <link rel="shottout icon" href="imagens/senaquiz1.png">
  <link href="css/bootstrap.min.css" rel="stylesheet">


<style type="text/css">

.header-image {
    display: block;
    width: 100%;
    text-align: center;
    background: url('http://placehold.it/1900x500') no-repeat center center scroll;
    -webkit-background-size: cover;
    -moz-background-size: cover;
    background-size: cover;
    -o-background-size: cover;
}

.headline {
    padding: 120px 0;
}

.headline h1 {
    font-size: 300px;
    background: #fff;
    background: rgba(255,255,255,0.9);
}

.headline h2 {
    font-size: 77px;
    background: #fff;

}

.featurette-divider {
    margin: 25px 0;
}

.featurette {
    overflow: hidden;
}

.featurette-image.pull-left {
    margin-right: 100px;
}

.featurette-image.pull-right {
    margin-left: 50px;
}

.featurette-heading {
    font-size: 50px;
}

.featurette-image2{
  margin-top: 50px;
}

.col-md-9{
    position: relative;
}

table {
    border-collapse: collapse;
    width: 100%;
}

th, td {
    text-align: left;
    padding: 8px;
}

tr:nth-child(even){background-color: #f2f2f2}

th {
    background-color: black;
    color: white;
}

.p{font-weight:900;
  color:#FFFFFF !important;
  font-family: roboto;
  }

h4{
  font-weight:900;
  color:#FFFFFF !important;
  font-family: roboto;
  }

/* Sticky footer styles
-------------------------------------------------- */
html {
  position: relative;
  min-height: 100%;
}
body {
  /* Margin bottom by footer height */
  margin-bottom: 60px;
}
.footer {
  position: absolute;
  bottom: 0;
  width: 100%;
  /* Set the fixed height of the footer here */
  height: 60px;
  background-color: #385965;
}


/* Custom page CSS
-------------------------------------------------- */
/* Not required for template or sticky footer method. */

body > .container {
  padding: 60px 15px 0;
}
.container .text-muted {
  margin: 20px 0;
}

.footer > .container {
  padding-right: 15px;
  padding-left: 15px;
  color: #000 ;
  font-size: 150%;
  padding: 10px;
}
}

code {
  font-size: 80%;
}

/*------------ */


.navbar-inverse {
    background-color: #385965 ;
    border-color: #000  ;
    color:#FFFFFF !important;
    font-family: roboto;
    font-size: 150%;
}

.navbar-fixed-top .nav {
    padding: 15px 0;
}

.navbar-fixed-top .navbar-brand {
    padding: 0 15px;
}

.p{font-weight:900;
  color:#FFFFFF !important;
  font-family: roboto;
  }

@media(min-width:768px) {
    body {
        padding-top: 0px; /* Required padding for .navbar-fixed-top. Change if height of navigation changes. */
    }

    .navbar-fixed-top .navbar-brand {
        padding: 15px 0;
    }
}

/*-----------------------------------*/

label,  input {
    display: block;
    float: left;
    font: 15px Times New Roman;
}

label { 
    text-align: right;
    width: 85px;
    padding-right: 20px;
    padding-bottom: 10px;
    font-size: 20px;
    font-weight: 20px;

}

br {
    clear: left;
}

</style>

  </head>

  <body>
     <?php
    if(@$_SESSION['showMenu']){
    ?>
     <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="../index.php">
                    <img src="senaquiz2.png" style="width:75px;height:50px;" alt="">
                </a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li><a href="../index.php" class="p">Área</a></li>
                    <li><a href="../assunto/index.php" class="p">Assunto</a></li>
                    <li><a href="../professor/index.php" class="p">Professor</a></li>
                    <li><a href="../questoes/index.php" class="p">Questão</a></li>
                    <li><a href="../ajuda/ajuda.php" class="p">Como Cadastrar</a></li>
                    <li><a href="../sair/index.php" class="p">Sair</a></li>
                </ul>                
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>
    <?php
      }
     ?>

    <!-- Begin page content -->
    <div class="container">
      <div class="page-header">
    <!-- Second Featurette -->
            <!-- Page Heading/Breadcrumbs -->
        <div class="row">
            <div class="col-md-12">
                <h1 class="page-header">Assunto</h1>
                <ol class="breadcrumb">
                    <li><a href="../index.php">Home</a>
                    </li>
                    <li class="active">Assunto</li>
                </ol>
            </div>
        </div>
        <!-- /.row -->



    <!-- Content Column -->
    <div class="col-md-12">
         <br><br>
  		<?php
			if(!empty($erro)){
				echo "	<font color='red'>$erro</font>
						<br><br>";
			}
			if(!empty($msg)){
				echo "	<font color='green'>$msg</font>
						<br><br>";
			}
			?>
			<table border="1">
				<tr>
					<th class="text-center">C&oacute;digo do Assunto</th>
					<th class="text-center">Descri&ccedil;&atilde;o Assunto</th>
          <th class="text-center">&Aacute;rea</th>
					<th class="text-center">Editar</th>
					<th class="text-center">Apagar</th>
				</tr>
				<?php
				
				foreach($assuntos as $cod => $descricoes){

					echo "	<tr>
								<td class='text-center'>$cod</td>
								<td class='text-center'>{$descricoes['assunto']}</td>
								<td class='text-center'>{$descricoes['area']}</td>
								<td class='text-center'><a href='?ecod=$cod'>Editar</a></td>
								<td align='center'>
									<center><a href='?dcod=$cod'>X</a></center>
								</td>
							</tr>";
				}
			?>
			</table><br><br>

		<form method="post">
				
					<label for="Escolha">Escolha:</label>
          <select name="selectarea">
						<?php
							foreach ($areas as $codArea => $descricao) {
								echo "<option value='$codArea'> $descricao </option>
									";
							}

						?>
					</select><br>
					<label for="Assunto">Assunto:</label> 
          <input type="text" name="assunto"><br>

					<input 	type="submit"
							name="inserir"
							value="Gravar">  
                      <input type="button" value="Voltar" onClick="history.go(-1)">
				
			</form>
			<br><br><br>
      </div>
    </div>
  </div>
    <footer class="footer">
      <div class="container">
       <center><h4><a class="p" href="http://sistemasparainter.net/" target="_blank" >Sistemas para internet</a> - 2016 - Centro Universitario Senac</h4></center>
      </div>
    </footer>


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>
    <script src="../../dist/js/bootstrap.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="../../assets/js/ie10-viewport-bug-workaround.js"></script>
  </body>
</html>
