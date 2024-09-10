<?php
    require_once './models/StatusModel.php';

    class StatusController {
        public function getStatus() {
            $statusModel = new StatusModel();

            $status = $statusModel->getStatus();

            return json_encode([
                'error' => null,
                'result' => $status
            ]);
        }

        public function buscarStatusPorId() {
            $dados = json_decode(file_get_contents('php://input'), true);
    
            if (empty($dados['idStatus']))
                return $this->mostrarErro('Você deve informar o idStatus');
    
            $response = (new StatusModel())->buscarStatusPorId($dados['idStatus']);
    
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
