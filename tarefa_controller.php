<?php
    //os models sao acessados pelo tarefa controller publico
    require('../tarefa.model.php');//requisicao para o arquivo que cria a classe
    require('../tarefa.service.php');//requisicao para o arquivo de manipulacao dos dados do BD
    require('../conexao.php');//requisicao para o arquivo que acessa o BD

    //se acao da super global get existe, $acao recebe get acao da super global, senao, recebe a variavel $acao
    $acao = isset($_GET['acao']) ? $_GET['acao'] : $acao;

    if($acao == 'inserir'){
        $tarefa = new Tarefa();//intancia da classe
        $tarefa->__set('tarefa', $_POST['tarefa']);//pega o nome da tarefa digitada pelo usuario e atribui a tarefa da classe
    
        $conexao = new Conexao();//estabelecendo conexao com BD
    
        $tarefa_service = new TarefaService($conexao, $tarefa);
        $tarefa_service->inserir();
    
        header('Location: nova_tarefa.php?inclusao=1');
    }
    else if($acao == 'recuperar'){
        $tarefa = new Tarefa();//intancia da classe
        $conexao = new Conexao();//estabelecendo conexao com BD
        $tarefa_service = new TarefaService($conexao, $tarefa);
        $tarefas = $tarefa_service->recuperar();
    }
    else if($acao == 'atualizar'){
        $tarefa = new Tarefa();//intancia da classe
        $tarefa->__set('id', $_POST['id']);//pega o id da tarefa digitada pelo usuario e atribui a tarefa da classe
        $tarefa->__set('tarefa', $_POST['tarefa']);//pega o nome da tarefa digitada pelo usuario e atribui a tarefa da classe

        $conexao = new Conexao();//estabelecendo conexao com BD
        $tarefa_service = new TarefaService($conexao, $tarefa);
        //se o retorno da atualização foi true
        if($tarefa_service->atualizar()){
            if(isset($_GET['pag']) && $_GET['pag']=='index'){//se o metodo atualizar vem de index
                header('Location: index.php');//carrega a pagina index
            }else{
                header('Location: todas_tarefas.php');//carrega a pagina todas tarefas
            }
        }
    }
    else if($acao == 'remover'){
        $tarefa = new Tarefa();//intancia da classe
        $tarefa->__set('id', $_GET['id']);//seta o id da tarefa a ser removida como o id recebido ao clicar no icone de remover

        $conexao = new Conexao();//estabelecendo conexao com BD
        $tarefa_service = new TarefaService($conexao, $tarefa);
        $tarefa_service->remover();
        if(isset($_GET['pag']) && $_GET['pag']=='index'){//se o metodo remover vem de index
            header('Location: index.php');//carrega a pagina index
        }else{
            header('Location: todas_tarefas.php');//carrega a pagina todas tarefas
        }
    }
    else if($acao == 'marcarRealizada'){
        $tarefa = new Tarefa();//intancia da classe
        $tarefa->__set('id', $_GET['id']);//seta o id da tarefa a ser marcada como o id recebido ao clicar no icone de marcar
        $tarefa->__set('id_status', 2);//como a tarefa virou realizada, seta o id_status da tarefa como 2

        $conexao = new Conexao();//estabelecendo conexao com BD
        $tarefa_service = new TarefaService($conexao, $tarefa);
        $tarefa_service->marcarRealizada();
        if(isset($_GET['pag']) && $_GET['pag']=='index'){//se o metodo marcarRealizada vem de index
            header('Location: index.php');//carrega a pagina index
        }else{
            header('Location: todas_tarefas.php');//carrega a pagina todas tarefas
        }
    }
    else if($acao == 'recuperarTarefasPendentes'){
        $tarefa = new Tarefa();//intancia da classe 
        $tarefa->__set('id_status', 1);//como a tarefa ainda é pendente, seta o id_status da tarefa como 1

        $conexao = new Conexao();//estabelecendo conexao com BD
        $tarefa_service = new TarefaService($conexao, $tarefa);
        //variavel que recebe todas as tarefas pendentes
        $tarefas = $tarefa_service->recuperarTarefasPendentes();
    }

?>