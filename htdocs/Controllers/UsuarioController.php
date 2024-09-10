<?php
    require_once './models/UsuarioModel.php';

    class UsuarioController {
        public function getUsuarios() {
            $usuarioModel = new UsuarioModel();

            $usuarios = $usuarioModel->getUsuarios();

            return json_encode([
                'error' => null,
                'result' => $usuarios
            ]);
        }

        public function getUsuario() {
            $dados = json_decode(file_get_contents('php://input'), true);
    
            if (empty($dados['idUsuario']))
                return $this->mostrarErro('Você deve informar o idUsuario');
    
            $response = (new UsuarioModel())->getUsuario($dados['idUsuario']);
    
            return json_encode([
                'error' => null,
                'result' => $response
            ]);
        }

        public function createUsuario() {
            $dados = json_decode(file_get_contents('php://input'), true);

            if (empty($dados['nome']))
                return $this->mostrarErro('Você deve informar o nomeUsuario!');

            if (empty($dados['cpf']))
                return $this->mostrarErro('Você deve informar o emailUsuario!');

            if (empty($dados['senha']))
                return $this->mostrarErro('Você deve informar o senhaUsuario!');
        
            $usuario = new UsuarioModel(
                null,
                $dados['nome'],
                $dados['cpf'],
                md5($dados['senha'])
            );

            $usuario->create();

            return json_encode([
                'error' => null,
                'result' => true
            ]);
        }

        public function updateUsuario() {
            $dados = json_decode(file_get_contents('php://input'), true);

            if (empty($dados['idUsuario']))
                return $this->mostrarErro('Você deve informar o idUsuario!');

            if (empty($dados['nome']))
                return $this->mostrarErro('Você deve informar o nomeUsuario!');

            if (empty($dados['cpf']))
                return $this->mostrarErro('Você deve informar o cpfUsuario!');

            if (empty($dados['senha']))
                return $this->mostrarErro('Você deve informar o senhaUsuario!');

        
            $usuario = new UsuarioModel(
                $dados['idUsuario'],
                $dados['nome'],
                $dados['cpf'],
                md5($dados['senha'])


            );

            $usuario->updateUsuario($usuario);

            return json_encode([
                'error' => null,
                'result' => true
            ]);
        }

        public function deleteUsuario() {
            $dados = json_decode(file_get_contents('php://input'), true);

            if (empty($dados['idUsuario']))
                return $this->mostrarErro('Você deve informar o idUsuario');

            $usuario = new UsuarioModel($dados['idUsuario']);

            $usuario->delete();

            

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