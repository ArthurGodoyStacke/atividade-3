<?php
require_once 'Conexao.php';
require_once 'StatusPedidoModel.php';

class StatusPedidoDAO {
    public function AtualizarStatusPedido(StatusPedidoModel $statusPedido): bool {
        $conexao = (new Conexao())->getConexao();
        
        $sql = "UPDATE pedidos SET idStatus = :idStatus WHERE idPedido = :idPedido;";
        
        $stmt = $conexao->prepare($sql);
        $stmt->bindValue(':idStatus', $statusPedido->idStatus);
        $stmt->bindValue(':idPedido', $statusPedido->idPedido);
        
        return $stmt->execute();
    }
}
?>
