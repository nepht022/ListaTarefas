<?php
    //classe para os comandos de manipulacao de dados do BD
    class TarefaService{

        private $conexao;
        private $tarefa;

        public function __construct(Conexao $conexao, Tarefa $tarefa){
            //inicia a conexao e cria uma tarefa ao instancia a class service
            $this->conexao = $conexao->conectar();
            $this->tarefa = $tarefa;
        }

        public function inserir(){
            $query = 'insert into tb_tarefas(tarefa)VALUES(:tarefa)';
            $statement = $this->conexao->prepare($query);//verifica se a consulta esta correta
            //pega a tarefa da classe, atribuida na linha 12 de tarefa controller e atribui a uma variavel usada na consulta
            $statement->bindValue(':tarefa', $this->tarefa->__get('tarefa'));
            $statement->execute();//executa a insercao
        }
        public function recuperar(){
            $query = 'select t.id, s.status, t.tarefa FROM tb_tarefas AS t LEFT JOIN tb_status AS s ON(t.id_status = s.id)';
            $statement = $this->conexao->prepare($query);//verifica se a consulta esta correta
            $statement->execute();//executa a recuperacao
            return $statement->fetchAll(PDO::FETCH_OBJ);//retorna todas as linhas da recuperacao como um array
        }
        public function atualizar(){
            $query = 'update tb_tarefas set tarefa= ? where id= ?';
            $statement = $this->conexao->prepare($query);//verifica se a consulta esta correta
            $statement->bindValue(1, $this->tarefa->__get('tarefa'));//substitui o ? pelo nome da tarefa vindo do controller
            $statement->bindValue(2, $this->tarefa->__get('id'));//substitui o ? pelo id da tarefa vindo do controller
            return $statement->execute();//executa a atualizacao e retorna se foi true ou false
        }
        public function remover(){
            $query = 'delete from tb_tarefas where id= ?';
            $statement = $this->conexao->prepare($query);//verifica se a consulta esta correta
            $statement->bindValue(1, $this->tarefa->__get('id'));//substitui o ? pelo id da tarefa vindo do controller
            $statement->execute();//executa a remocao
        }
        public function marcarRealizada(){
            $query = 'update tb_tarefas set id_status= ? where id= ?';
            $statement = $this->conexao->prepare($query);//verifica se a consulta esta correta
            $statement->bindValue(1, $this->tarefa->__get('id_status'));//substitui o ? pelo id_status da tarefa vindo do controller
            $statement->bindValue(2, $this->tarefa->__get('id'));//substitui o ? pelo id da tarefa vindo do controller
            return $statement->execute();//executa o update e retorna se foi true ou false
        }
        public function recuperarTarefasPendentes(){
            $query = 'select t.id, s.status, t.tarefa FROM tb_tarefas AS t LEFT JOIN tb_status AS s ON(t.id_status = s.id) where t.id_status = :id_status';
            $statement = $this->conexao->prepare($query);//verifica se a consulta esta correta
            //pega o id_status da tarefa da classe e atribui a uma variavel usada na consulta
            $statement->bindValue(':id_status', $this->tarefa->__get('id_status'));
            $statement->execute();//executa a recuperacao
            return $statement->fetchAll(PDO::FETCH_OBJ);//retorna todas as linhas da recuperacao como um array
        }
    }
?>