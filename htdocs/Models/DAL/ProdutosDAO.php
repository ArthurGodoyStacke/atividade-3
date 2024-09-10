<?php
    require_once 'Conexao.php';

    class ProdutosDAO {
        public function getProdutos() {
            $conexao = (new Conexao())->getConexao();

            $sql = "SELECT * FROM produtos;";

            $stmt = $conexao->prepare($sql);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }



        public function buscarProdutosPorId($idProdutos) {
            $conexao = (new Conexao())->getConexao();

            $sql = "SELECT * FROM produtos WHERE idProduto = :id;";

            $stmt = $conexao->prepare($sql);
            $stmt->bindValue(':id', $idProdutos);
            $stmt->execute();
            
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }

        public function cadastrarProduto(ProdutosModel $produto) {
            $conexao = (new Conexao())->getConexao();
        
            $sql = "INSERT INTO produtos (descricao, preco) VALUES(:descricao, :preco);";
        
            $stmt = $conexao->prepare($sql);
            $stmt->bindValue(':descricao', $produto->descricao);
            $stmt->bindValue(':preco', $produto->preco);
        
            return $stmt->execute();
        }
        
        public function updateProduto(ProdutosModel $produto) {
            $conexao = (new Conexao())->getConexao();
        
   
            $sql = "UPDATE produtos SET descricao = :descricao, preco = :preco WHERE idProduto = :idProduto;";
        
            $stmt = $conexao->prepare($sql);
            $stmt->bindValue(':idProduto', $produto->idProduto); 
            $stmt->bindValue(':descricao', $produto->descricao);
            $stmt->bindValue(':preco', $produto->preco);
          
        
            return $stmt->execute();
        }
        
        public function deleteProduto(ProdutosModel $produto) {
            $conexao = (new Conexao())->getConexao();

            $sql = "DELETE FROM produtos WHERE idProduto = :id;";

            $stmt = $conexao->prepare($sql);
            $stmt->bindValue(':id', $produto->idProduto);

            return $stmt->execute();
        }

        
        public function updateStatusPedido(PedidosModel $pedido) {
            $conexao = (new conexao())->getConexao();

            $sql = "UPDATE pedidos SET idStatus = :idStatus WHERE idPedido = :id";

            $stmt = $conexao->prepare($sql);
            $stmt->bindValue(":id",$pedido->idPedido);
            $stmt->bindValue(":idStatus",$pedido->idStatus);

            return $stmt->execute();
        }

        
    }
?>