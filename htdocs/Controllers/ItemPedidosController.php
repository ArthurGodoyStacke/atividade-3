<?php
    require_once './models/ItemPedidosModel.php'; 

    class ItemPedidosController {
        public function buscarItensPedidos() {
            $itemPedidoDAO = new ItemPedidoDAO();
            $itensPedidos = $itemPedidoDAO->buscarItensPedidos();
            if (empty($itensPedidos)) {
                return json_encode([
                    'error' => 'Nenhum item de pedido encontrado.',
                    'result' => []
                ]);
            }

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
            return json_encode([
                'error' => null,
                'result' => $itensPedidosModels
            ]);
        }
        public function cadastrarItemPedido() {
            $dados = json_decode(file_get_contents('php://input'), true);
        
            if (empty($dados['idPedido']))
                return $this->mostrarErro('Você deve informar o idPedido!');
        
            if (empty($dados['idProduto']))
                return $this->mostrarErro('Você deve informar o idProduto!');
        
            if (empty($dados['quantidade']))
                return $this->mostrarErro('Você deve informar a quantidade!');
        
            $itemPedido = new ItemPedidosModel(
                null, 
                $dados['idPedido'],
                $dados['idProduto'],
                $dados['quantidade']
            );
        
           
            $response = $itemPedido->cadastrarItemPedido();
        
            return json_encode([
                'error' => null,
                'result' => $response
            ]);
        }


        public function UpdateItemPedido() {
            $dados = json_decode(file_get_contents('php://input'), true);
        
           
            if (empty($dados['id']))
                return $this->mostrarErro('Você deve informar o id do ItemPedido!');
        
            if (empty($dados['idProduto']))
                return $this->mostrarErro('Você deve informar o idProduto!');
        
            if (empty($dados['idPedido']))
                return $this->mostrarErro('Você deve informar o idPedido!');
        
            if (empty($dados['quantidade']))
                return $this->mostrarErro('Você deve informar a quantidade!');
        
            
            $itemPedido = new ItemPedidosModel(
                $dados['id'],            
                $dados['idPedido'],      
                $dados['idProduto'],     
                $dados['quantidade']     
            );
        
           
            $response = $itemPedido->UpdateItemPedido();
        
            
            return json_encode([
                'error' => null,
                'result' => $response
            ]);
        }


        public function DeleteItemPedido() {
            $dados = json_decode(file_get_contents('php://input'), true);
        
            
            if (empty($dados['id']))
                return $this->mostrarErro('Você deve informar o id do ItemPedido!');
        
      
            $itemPedido = new ItemPedidosModel($dados['id']);
        
       
            $response = $itemPedido->DeleteItemPedido();
        
      
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
