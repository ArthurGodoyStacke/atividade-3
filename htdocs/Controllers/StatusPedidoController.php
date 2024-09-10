<?php
    require_once './StatusPedidoModel.php';
    require_once './StatusPedidoDAO.php';

class StatusPedidoController {
    
    public function AtualizarStatusPedido() {
        $dados = json_decode(file_get_contents('php://input'), true);

        if (empty($dados['idPedido'])) {
            return $this->mostrarErro('Você deve informar o idPedido!');
        }

        if (empty($dados['idStatus'])) {
            return $this->mostrarErro('Você deve informar o idStatus!');
        }

        $statusPedido = new StatusPedidoModel(
            $dados['idPedido'],
            $dados['idStatus']
        );

        $statusPedidoDAO = new StatusPedidoDAO();
        $resultado = $statusPedidoDAO->AtualizarStatusPedido($statusPedido);

        if ($resultado) {
            return json_encode([
                'error' => null,
                'result' => 'Status do pedido atualizado com sucesso!'
            ]);
        } else {
            return $this->mostrarErro('Falha ao atualizar o status do pedido!');
        }
    }

    private function mostrarErro(string $mensagem) {
        return json_encode([
            'error' => $mensagem,
            'result' => null
        ]);
    }

    
}
?>
