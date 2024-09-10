<?php
    require_once 'Conexao.php';

    class ItemPedidoDAO {
        public function buscarItensPedidos() {
            $conexao = (new Conexao())->getConexao();

            $sql = "SELECT * FROM itempedido;";

            $stmt = $conexao->prepare($sql);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        public function cadastrarItemPedido(ItemPedidosModel $itemPedido) {
            $conexao = (new Conexao())->getConexao();
        
            $sql = "INSERT INTO itempedido (idPedido, idProduto, quantidade) 
                    VALUES (:idPedido, :idProduto, :quantidade);";
        
            $stmt = $conexao->prepare($sql);
            $stmt->bindValue(':idPedido', $itemPedido->idPedido);
            $stmt->bindValue(':idProduto', $itemPedido->idProduto);
            $stmt->bindValue(':quantidade', $itemPedido->quantidade);
        
            return $stmt->execute();
        }


        public function UpdateItemPedido(ItemPedidosModel $itemPedido) {
            $conexao = (new Conexao())->getConexao();
        
       
            $sql = "UPDATE itempedido 
                    SET idProduto = :idProduto, idPedido = :idPedido, quantidade = :quantidade 
                    WHERE id = :id;";
        
            $stmt = $conexao->prepare($sql);
            $stmt->bindValue(':id', $itemPedido->id); 
            $stmt->bindValue(':idProduto', $itemPedido->idProduto);
            $stmt->bindValue(':idPedido', $itemPedido->idPedido);
            $stmt->bindValue(':quantidade', $itemPedido->quantidade);
        
            return $stmt->execute();
        }

        public function DeleteItemPedido(ItemPedidosModel $itemPedido) {
            $conexao = (new Conexao())->getConexao();
        

            $sql = "DELETE FROM itempedido WHERE id = :id;";
        
            $stmt = $conexao->prepare($sql);
            $stmt->bindValue(':id', $itemPedido->id); 
        
            return $stmt->execute();
        }
        
        public function AddProductQuantity(ItemPedidosModel $orderItemId)
    {
        $connection = (new Conexao)->getConexao();

        $sql = "UPDATE itempedido
                    SET quantidade = quantidade + :quantidade
                    WHERE idPedido = :id AND idProduto    = :idProduto;";

        $stmt = $connection->prepare($sql);
        $stmt->bindValue(':id', $orderItemId->idPedido);
        $stmt->bindValue(':idProduto', $orderItemId->idProduto);
        $stmt->bindValue(':quantidade', $orderItemId->quantidade);

        return $stmt->execute();
    }

    public function getValorTotalFromPedidoById($idPedido)
    {
        $conexao = (new conexao)->getConexao();

        $sql = "SELECT SUM(i.quantidade * p.preco) AS valor_total_pedido
        FROM itempedido i
        JOIN produtos p ON i.idProduto = p.idProduto
        WHERE i.idPedido = :orderId;";

        $stmt = $conexao->prepare($sql);
        $stmt->bindParam(":orderId", $idPedido);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    }
        
?>