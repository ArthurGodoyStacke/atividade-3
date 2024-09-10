<?php
    require_once './models/PedidosModel.php';
    require_once './models/ItemPedidosModel.php';

    class PedidosController {
        public function getPedidos() {
            $pedidosModel = new PedidosModel();

            
            $pedidos = $pedidosModel->getPedidos();

           
            return json_encode([
                'error' => null,
                'result' => $pedidos
            ]);
        }

        public function BuscarPedidoPorId() {
          
            $dados = json_decode(file_get_contents('php://input'), true);
    
           
            if (empty($dados['idPedido'])) {
                return json_encode([
                    'error' => 'Você deve informar o idPedido!',
                    'result' => null
                ]);
            }
  
            $pedidosModel = new PedidosModel();
            $pedido = $pedidosModel->BuscarPedidoPorId($dados['idPedido']);
    
      
            if ($pedido) {
                return json_encode([
                    'error' => null,
                    'result' => [
                        'idPedido' => $pedido->idPedido,
                        'idUsuario' => $pedido->idUsuario,
                        'idStatus' => $pedido->idStatus
                    ]
                ]);
            } else {
                return json_encode([
                    'error' => 'Pedido não encontrado!',
                    'result' => null
                ]);
            }
        }

        public function BuscarTodosPedidosDeUmaPessoa() {
        
            $dados = json_decode(file_get_contents('php://input'), true);
    
          
            if (empty($dados['idUsuario'])) {
                return json_encode([
                    'error' => 'Você deve informar o idUsuario!',
                    'result' => null
                ]);
            }
    
            $pedidosModel = new PedidosModel();
            $pedidos = $pedidosModel->BuscarTodosPedidosDeUmaPessoa($dados['idUsuario']);
    

            $resultados = [];
            foreach ($pedidos as $pedido) {
                $resultados[] = [
                    'idPedido' => $pedido->idPedido,
                    'idUsuario' => $pedido->idUsuario,
                    'idStatus' => $pedido->idStatus
                ];
            }
    
            return json_encode([
                'error' => null,
                'result' => $resultados
            ]);
        }

        public function CadastrarPedidos() {
         
            $dados = json_decode(file_get_contents('php://input'), true);
    
     
            if (empty($dados['idUsuario']))
                return json_encode([
                    'error' => 'Você deve informar o idUsuario!',
                    'result' => null
                ]);
    
            
            if (empty($dados['idStatus']))
                return json_encode([
                    'error' => 'Você deve informar o idStatus!',
                    'result' => null
                ]);
    
  
            $pedido = new PedidosModel(
                null, 
                $dados['idUsuario'],
                $dados['idStatus']
            );
    

            $response = $pedido->CadastrarPedidos();
    
            return json_encode([
                'error' => null,
                'result' => $response
            ]);
        }

        public function getValorTotalFromPedidoById()
    {
        $dados = json_decode(file_get_contents("php://input"), true);

        if (empty($dados['idPedido'])) {
            return $this->mostrarErro('Você deve informar o idPedido');
        }
        $itemPedidosModel = new itemPedidosModel();

        $result = $itemPedidosModel->getValorTotalPedido($dados['idPedido']);

        return json_encode([
            'error' => null,
            'result' => $result
        ]);
    }


    public function atualizarPedido() {
        $dados = json_decode(file_get_contents('php://input'), true);

        if (empty($dados['idPedido']))
            return $this->mostrarErro('Você deve informar o idPedido!');

        if (empty($dados['idUsuario']))
            return $this->mostrarErro('Você deve informar o idUsuario!');

        if (empty($dados['idStatus']))
            return $this->mostrarErro('Você deve informar o idStatus!');

        $pedido = new PedidosModel(
            $dados['idPedido'],
            $dados['idUsuario'],
            $dados['idStatus']
        );

        $pedidoModel = new PedidosModel();
        $retorno = $pedidoModel->atualizarPedido($pedido);

        if ($retorno) {
            return json_encode([
                'error' => null,
                'result' => 'Pedido atualizado com sucesso!'
            ]);
        } else {
            return $this->mostrarErro('Falha ao atualizar o pedido!');
        }
    }

    public function deletePedido() {
        $dados = json_decode(file_get_contents('php://input'), true);

        if (empty($dados['idPedido'])) {
            return $this->mostrarErro('Você deve informar o idPedido!');
        }

        $pedido = new PedidosModel();
        $pedido->idPedido = $dados['idPedido'];

        $retorno = $pedido->deletePedido();

        if ($retorno) {
            return json_encode([
                'error' => null,
                'result' => 'Pedido excluído com sucesso!'
            ]);
        } else {
            return $this->mostrarErro('Falha ao excluir o pedido!');
        }
    }


    public function updateStatusPedido() {
        $dados = json_decode(file_get_contents('php://input'),true);

        if(empty($dados['idPedido'])) {
            return $this->mostrarErro('Você deve informar o idPedido');
        }
        if(empty($dados['idStatus'])){
            return $this->mostrarErro('Você deve mostar o idStatus');
        }

        $usuario = new PedidosModel (
            $dados['idPedido'],
            null,
            $dados['idStatus']
        );

        $usuario->updateStatus();

        return json_encode([
            'error' => null,
            'result' => true
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
