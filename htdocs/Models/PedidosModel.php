<?php
require_once 'DAL/PedidosDAO.php';

class PedidosModel {
    public ?int $idPedido;
    public ?string $idUsuario;
    public ?int $idStatus;

    public function __construct(
        ?int $idPedido = null,
        ?string $idUsuario = null,
        ?int $idStatus = null
    )
    {
        $this->idPedido = $idPedido;
        $this->idUsuario = $idUsuario;
        $this->idStatus = $idStatus;
    }

    public function getPedidos() {
        $pedidosDAO = new PedidosDAO();
        $pedidos = $pedidosDAO->getPedidos();
        $pedidosModels = [];
        foreach ($pedidos as $pedido) {
            $pedidoModel = new PedidosModel(
                $pedido['idPedido'],
                $pedido['idUsuario'],
                $pedido['idStatus']
            );
            $pedidosModels[] = $pedidoModel;
        }

        return $pedidosModels;
    }

    public function buscarPedidoPorId($idPedido) {
        $pedidosDAO = new PedidosDAO();
        $pedidoData = $pedidosDAO->buscarPedidoPorId($idPedido);

        if ($pedidoData) {
            return new PedidosModel(
                $pedidoData['idPedido'],
                $pedidoData['idUsuario'],
                $pedidoData['idStatus']
            );
        } else {
            return null;
        }
    }

    public function BuscarTodosPedidosDeUmaPessoa($idUsuario) {
        $pedidosDAO = new PedidosDAO();
        $pedidosData = $pedidosDAO->BuscarTodosPedidosDeUmaPessoa($idUsuario);

        $pedidosModels = [];
        foreach ($pedidosData as $pedido) {
            $pedidosModels[] = new PedidosModel(
                $pedido['idPedido'],
                $pedido['idUsuario'],
                $pedido['idStatus']
            );
        }

        return $pedidosModels;
    }

    public function CadastrarPedidos() {
        $PedidosDAO = new  PedidosDAO();

        return $PedidosDAO->CadastrarPedidos($this);
    }
    
    public function atualizarPedido() {
        $pedidosDAO = new PedidosDAO();
        
        return $pedidosDAO->atualizarPedido($this);
    }

    public function deletePedido() {
        $PedidosDAO = new PedidosDAO();
    
    
        if ($this->idPedido === null) {
            throw new Exception('idPedido não informado.');
        }
        
        return $PedidosDAO->deletePedido($this->idPedido);
    }

    public function updateStatus() {
        $pedidosDAO = new PedidosDAO();

        return $pedidosDAO->updateStatusPedido($this);
    }
    


   

    


   





    
    
}
?>
