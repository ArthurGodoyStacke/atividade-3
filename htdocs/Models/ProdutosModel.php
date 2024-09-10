<?php
require_once 'DAL/ProdutosDAO.php';

class ProdutosModel {
    public ?int $idProduto;
    public ?string $descricao;
    public ?float $preco;
    
    public function __construct(
        ?int $idProduto = null,
        ?string $descricao = null,
        ?float $preco = null,
    )
    {
        $this->idProduto= $idProduto;
        $this->descricao = $descricao;
        $this->preco = $preco;
    }

    public function getProdutos() {
        $produtosDAO = new ProdutosDAO();

      
        $produtos = $produtosDAO->getProdutos();

        $produtosModels = [];
        foreach ($produtos as $produto) { 
            $produtosModel = new ProdutosModel(
                $produto['idProduto'],
                $produto['descricao'],
                $produto['preco']
            );
            $produtosModels[] = $produtosModel;
        }

        return $produtosModels;
    }

    public function buscarProdutosPorId($idProdutos) {
        $produtosDAO = new ProdutosDAO();

        $produtos = $produtosDAO->buscarProdutosPorId($idProdutos);
        $produtos = new ProdutosModel($produtos['idProduto'], $produtos['idProduto']);

        return $produtos;
    }

    public function cadastrarProduto() {
        $ProdutosDAO = new  ProdutosDAO();

        return $ProdutosDAO->cadastrarProduto($this);
    }

    public function updateProduto() {
        $produtoDAO = new ProdutosDAO();

        return $produtoDAO->updateProduto($this);
    }

    public function deleteProduto() {
        $produtosDAO = new ProdutosDAO();

        return $produtosDAO->deleteProduto($this);
    }

    



}

?>    