<?php
require_once 'Conexao.php';

class PedidosDAO {
    public function getPedidos() {
        $conexao = (new Conexao())->getConexao();

        $sql = "SELECT * FROM pedidos;";

      
        $stmt = $conexao->prepare($sql);
        $stmt->execute();

        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function BuscarPedidoPorId($idPedido) {
        $conexao = (new Conexao())->getConexao();

        $sql = "SELECT * FROM pedidos WHERE idPedido = :idPedido;";

        $stmt = $conexao->prepare($sql);
        $stmt->bindValue(':idPedido', $idPedido);
        $stmt->execute();
        
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function BuscarTodosPedidosDeUmaPessoa($idUsuario) {
        $conexao = (new Conexao())->getConexao();

        $sql = "SELECT * FROM pedidos WHERE idUsuario = :idUsuario;";

        $stmt = $conexao->prepare($sql);
        $stmt->bindValue(':idUsuario', $idUsuario);
        $stmt->execute();
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    public function CadastrarPedidos(PedidosModel $pedido) {
        $conexao = (new Conexao())->getConexao();

        $sql = "INSERT INTO pedidos (idUsuario, idStatus) VALUES(:idUsuario, :idStatus);";

        $stmt = $conexao->prepare($sql);
        $stmt->bindValue(':idUsuario', $pedido->idUsuario);
        $stmt->bindValue(':idStatus', $pedido->idStatus);

        return $stmt->execute();
    }

    public function atualizarPedido(PedidosModel $pedido) {
        $conexao = (new Conexao())->getConexao();

        $sql = "UPDATE pedidos SET idUsuario = :idUsuario, idStatus = :idStatus WHERE idPedido = :idPedido;";

        $stmt = $conexao->prepare($sql);

        $stmt->bindValue(':idUsuario', $pedido->idUsuario);
        $stmt->bindValue(':idStatus', $pedido->idStatus);
        $stmt->bindValue(':idPedido', $pedido->idPedido);

        return $stmt->execute();
    }

    public function deletePedido(int $idPedido) {
        $conexao = (new Conexao())->getConexao();
    
        $sql = "DELETE FROM pedidos WHERE idPedido = :idPedido;";
    
        $stmt = $conexao->prepare($sql);
        $stmt->bindValue(':idPedido', $idPedido);
    
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
