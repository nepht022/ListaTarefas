<?php
	$acao = 'recuperarTarefasPendentes';//recupera todas as tarefas pendentes pelo metodo do controller
	require 'tarefa_controller.php';//requisicao para o controlador publico da classe
?>

<html>
	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>App Lista Tarefas</title>

		<link rel="stylesheet" href="css/estilo.css">
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
		<link rel="stylesheet" href="fontawesome/css/all.css">

		<script>
			function editar(id, txtTarefa){
				//criando um form
				let form = document.createElement('form');
				form.action = 'index.php?pag=index&acao=atualizar';
				form.method = 'post';
				form.className = 'row';

				//criando um input pra texto e o preenche com o nome da tarefa
				let inputTarefa = document.createElement('input');
				inputTarefa.type='text';
				inputTarefa.name='tarefa';
				inputTarefa.value= txtTarefa;
				inputTarefa.className='col-8 form-control';

				//criando um input hidden para guardar o ID da tarefa
				let inputID = document.createElement('input');
				inputID.type='hidden';
				inputID.name = 'id';
				inputID.value = id;

				//criando o botao pra enviar
				let button = document.createElement('button');
				button.type='submit';
				button.className='col-3 btn btn-info';
				button.innerHTML='Atualizar';

				//criando hierarquia, colocando cada "elemento" dentro de outro
				form.appendChild(inputTarefa);
				form.appendChild(inputID);
				form.appendChild(button);

				//recupera a tarefa a ser atualizada pelo id
				let tarefa = document.getElementById('tarefa_'+id);

				//limpa o texto para incluir o form
				tarefa.innerHTML='';

				//insere o form
				tarefa.insertBefore(form, tarefa[0]);
			}

			function remover(id){
				location.href="index.php?pag=index&acao=remover&id="+id;
			}

			function marcarRealizada(id){
				location.href="index.php?pag=index&acao=marcarRealizada&id="+id;
			}
		</script>
	</head>

	<body>
		<nav class="navbar navbar-light bg-light">
			<div class="container">
				<a class="navbar-brand" href="#">
					<img src="img/logo.png" width="30" height="30" class="d-inline-block align-top" alt="">
					App Lista Tarefas
				</a>
			</div>
		</nav>

		<div class="container app">
			<div class="row">
				<div class="col-md-3 menu">
					<ul class="list-group">
						<li class="list-group-item active"><a href="#">Tarefas pendentes</a></li>
						<li class="list-group-item"><a href="nova_tarefa.php">Nova tarefa</a></li>
						<li class="list-group-item"><a href="todas_tarefas.php">Todas tarefas</a></li>
					</ul>
				</div>

				<div class="col-md-9">
					<div class="container pagina">
						<div class="row">
							<div class="col">
								<h4>Tarefas pendentes</h4>
								<hr />

								<?php foreach($tarefas as $indice => $tarefa){ ?>
									<div class="row mb-3 d-flex align-items-center tarefa">
										<!--exibe o valor do id e nome das tarefas recuperadas pelo metodo recuperarTarefasPendentes-->
										<div class="col-sm-9" id="tarefa_<?= $tarefa->id ?>">
											<?= $tarefa->tarefa ?>
										</div>
										<div class="col-sm-3 mt-2 d-flex justify-content-between">
											<!--remove a tarefa do id atual no foreach-->
											<i class="fas fa-trash-alt fa-lg text-danger" onclick="remover(<?=$tarefa->id?>)"></i>
											<!--edita a tarefa do id atual no foreach passando seu nome tambem como parametro-->
											<i class="fas fa-edit fa-lg text-info" onclick="editar(<?=$tarefa->id?>, '<?=$tarefa->tarefa?>')"></i>
											<!--marca como realizada a tarefa do id atual no foreach-->
											<i class="fas fa-check-square fa-lg text-success" onclick="marcarRealizada(<?=$tarefa->id?>)"></i>
										</div>
									</div>
								<?php } ?>	
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>