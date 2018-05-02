<!DOCTYPE html>
<meta charset="utf-8">
<html>
<head>
	<title>Livro de Visitas simples em PHP by J !</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">

	<link href="https://fonts.googleapis.com/css?family=Gugi" rel="stylesheet">

				<!--Estilo CSS do FORM-->
				<style>
				body {
				font-family: 'Gugi', serif;
				font-size: 10px;
				}
				form {
				margin: 0 auto;
				width: 400px;

				padding: 1em;
				border: 1px solid #CCC;
				border-radius: 1em;
				}

				div + div {
				margin-top: 1em;
				}

				label {
				display: inline-block;
				width: 90px;
				text-align: right;
				}

				input, textarea {

				font: 1em sans-serif;

				width: 300px;

				-moz-box-sizing: border-box;
				box-sizing: border-box;

				border: 1px solid #999;
				}

				input:focus, textarea:focus {
				border-color: #000;
				}

				textarea {
				vertical-align: top;

				height: 5em;

				resize: vertical;
				}

				.button {
				padding-left: 90px; 
				}

				button {
				margin-left: .5em;
				}
				</style>
								<!-- Fim do Estilo CSS do FORM-->


    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.10/css/all.css" integrity="sha384-+d0P83n9kaQMCwj8F4RJB66tzIwOKmrdb46+porD/OvrJ+37WqIM7UoBtwHO6Nlg" crossorigin="anonymous">
	<meta name="viewport" content="width=device-width, initial-scale=1">

</head>
<body>
	
	<center>	<h2>Livro de Visitas em PHP by J.</h2>

<!-- conexao ao BD mysql -->
					<?php
				try { 
				$pdo = new PDO("mysql:dbname=projeto_coment;host=projeto_coment.mysql.dbaas.com.br", "projeto_coment", "ledzep13@@##");
				} catch(PDOException $e) {
				echo "ERRO: ".$e->getMessage();
				exit;
				}

				if(isset($_POST['nome']) && empty($_POST['nome']) == false) {
				$nome = $_POST['nome'];
				$mensagem = $_POST['mensagem'];
				$email = $_POST['email'];

				$sql = $pdo->prepare("INSERT INTO mensagens SET nome = :nome, msg = :msg, data_msg = NOW(), email = :email");
				$sql->bindValue(":nome", $nome);
				$sql->bindValue(":msg", $mensagem);
				$sql->bindValue(":email", $email);


				$sql->execute();
				}
			?>
<!-- Fim da conexao ao BD mysql -->


<!-- Formulário Simples juntando com o resultado da postagem em tempo real -->

	<form method="POST" >
			nome:<br>
			<input type="text" name="nome" required><br>
			email:<br>
			<input type="email" name="email" required ><br>
			<i class="fa fa-pencil-square-o" aria-hidden="true"> </i> 
			Mensagem:<br>
			<textarea name="mensagem" required></textarea><br>
			<i class="fa fa-paper-plane" aria-hidden="true"> </i> 
			<input type="submit" name="Enviar"> 
			<br><br>
			<?php
			$sql = "SELECT * from mensagens order by data_msg desc";
			$sql = $pdo->query($sql);
			if($sql->rowCount() > 0) {
			foreach($sql->fetchAll() as $mensagem): ?>
			<hr>
			<strong> <i class="fas fa-user"> </i> <?php echo $mensagem['nome']; ?> </strong>
			<br><strong>Email: <?php echo $mensagem['email']; ?> </strong><br>
			Mensagem: <textarea rows="2" cols="50"> <?php echo $mensagem['msg']; ?></textarea><sub><?php echo $mensagem['data_msg'];?></sub>
		<hr>
		<?php
		endforeach;
		} else {
		echo "não há mensagens";
		}
		?>
	</form>
			<!-- Fim do Form -->

<center><iframe src="https://giphy.com/embed/DJLGN6NxlvTI4" width="30%" height="30%" frameBorder="0" class="giphy-embed" allowFullScreen></iframe></center>