<?php
require_once 'DAL/ItemPedidoDAO.php';

class ItemPedidosModel {
    public ?int $id;
    public ?int $idPedido;
    public ?int $idProduto;
    public ?int $quantidade;

    public function __construct(
        ?int $id = null,
        ?int $idPedido = null,
        ?int $idProduto = null,
        ?int $quantidade = null
    ) {
        $this->id = $id;
        $this->idPedido = $idPedido;
        $this->idProduto = $idProduto;
        $this->quantidade = $quantidade;
    }

    public function buscarItensPedidos() {
        $itemPedidoDAO = new ItemPedidoDAO();
    
        $itensPedidos = $itemPedidoDAO->buscarItensPedidos();
    
        $itensPedidosModels = [];
        foreach ($itensPedidos as $itemPedido) {
            $itemPedidoModel = new ItemPedidosModel(
                $itemPedido['id'],
                $itemPedido['idPedido'],
                $itemPedido['idProduto'],
                $itemPedido['quantidade']
            );
            $itensPedidosModels[] = $itemPedidoModel;
        }

        return $itensPedidosModels;
    }

    public function cadastrarItemPedido() {
        $itemPedidoDAO = new ItemPedidoDAO();

        return $itemPedidoDAO->cadastrarItemPedido($this);
    }


    public function UpdateItemPedido() {
        $itemPedidoDAO = new ItemPedidoDAO();

        return $itemPedidoDAO->UpdateItemPedido($this);
    }

    public function DeleteItemPedido() {
        $itemPedidoDAO = new ItemPedidoDAO();

        return $itemPedidoDAO->DeleteItemPedido($this);
    }

    public function AddProductQuantity()
    {
        $orderItemDAO = new ItemPedidoDAO();

        return $orderItemDAO->AddProductQuantity($this);
    }

    public function getValorTotalPedido($idPedido)
    {
        $ItemPedidoDAO = new ItemPedidoDAO;

        return $ItemPedidoDAO->getValorTotalFromPedidoById($idPedido);


        foreach ($itens as &$item) {
            $item = new itemPedidosModel(
                $item['id_item_pedido'],
                $item['idProduto'],
                $item['idPedido'],
                $item['quantidade'],
                $item['valorTotal']
            );
        }
        return $itens;
    }

}
?>
