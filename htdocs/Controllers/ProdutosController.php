<?php
    require_once './models/ProdutosModel.php';

    class ProdutosController {
        public function getProdutos() {
            $produtosModel = new ProdutosModel();

            $produtos = $produtosModel->getProdutos();

            return json_encode([
                'error' => null,
                'result' => $produtos
            ]);
        }


        public function buscarProdutosPorId() {
            $dados = json_decode(file_get_contents('php://input'), true);
    
            if (empty($dados['idProduto']))
                return $this->mostrarErro('Você deve informar o idProduto');
    
            $response = (new ProdutosModel())->buscarProdutosPorId($dados['idProduto']);
    
            return json_encode([
                'error' => null,
                'result' => $response
            ]);
        }

        public function cadastrarProduto() {
            $dados = json_decode(file_get_contents('php://input'), true);


            if (empty($dados['descricao']))
                return $this->mostrarErro('Você deve informar a descricaoProduto!');

            if (empty($dados['preco']))
                return $this->mostrarErro('Você deve informar o precoProduto!');

            $produto = new ProdutosModel(
                null,
               
                $dados['descricao'],
                $dados['preco']
            
            );

            $response = $produto->cadastrarProduto();

            return json_encode([
                'error' => null,
                'result' => $response
            ]);
        }

        public function updateProduto() {
            $dados = json_decode(file_get_contents('php://input'), true);
            
            if (empty($dados['idProduto']))
            return $this->mostrarErro('Você deve informar o idProduto!');

            if (empty($dados['descricao'])) 
                return $this->mostrarErro('Você deve informar a descricaoProduto!');

            if (empty($dados['preco']))
                return $this->mostrarErro('Você deve informar o precoProduto!');

                    
            $produto = new ProdutosModel(
                $dados['idProduto'],
                $dados['descricao'],
                $dados['preco'],
                
            );

            $response = $produto->updateProduto();

            return json_encode([
                'error' => null,
                'result' => $response
            ]);
        }

        public function deleteProduto() {
            $dados = json_decode(file_get_contents('php://input'), true);

            if (empty($dados['idProduto']))
                return $this->mostrarErro('Você deve informar o idProduto!');

            $noticia = new ProdutosModel($dados['idProduto']);

            $response = $noticia->deleteProduto();

            return json_encode([
                'error' => null,
                'result' => $response
            ]);
        }


        private function mostrarErro(string $mensagem) {
            return json_encode([
                'error' => $mensagem,
                'result' => null
            ]);
        }

    }
    ?>