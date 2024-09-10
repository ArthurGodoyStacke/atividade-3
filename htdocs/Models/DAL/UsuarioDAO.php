<?php
    require_once 'Conexao.php';

    class UsuarioDAO {
        public function getUsuarios() {
            $conexao = (new Conexao())->getConexao();

            $sql = "SELECT * FROM usuario;";

            $stmt = $conexao->prepare($sql);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        public function createUsuario(UsuarioModel $usuario) {
            $conexao = (new Conexao())->getConexao();

            $sql = "INSERT INTO usuario VALUES (:id, :nome, :cpf, :senha);";

            $stmt = $conexao->prepare($sql);
            $stmt->bindValue(':id', null);
            $stmt->bindValue(':nome', $usuario->nomeUsuario);
            $stmt->bindValue(':cpf', $usuario->cpfUsuario);
            $stmt->bindValue(':senha', $usuario->senhaUsuario);

            return $stmt->execute();
        }

        public function updateUsuario(UsuarioModel $usuario) {
            $conexao = (new Conexao())->getConexao();

            $sql = "UPDATE usuario SET nome = :nome, cpf = :cpf, senha = :senha WHERE idUsuario = :id;";

            $stmt = $conexao->prepare($sql);
            $stmt->bindValue(':id', $usuario->idUsuario);
            $stmt->bindValue(':nome', $usuario->nomeUsuario);
            $stmt->bindValue(':cpf', $usuario->cpfUsuario);
            $stmt->bindValue(':senha', $usuario->senhaUsuario);

            return $stmt->execute();
        }

        public function deleteUsuario(UsuarioModel $usuario) {
            $conexao = (new Conexao())->getConexao();

            $sql = "DELETE FROM usuario WHERE idUsuario = :id";

            $stmt = $conexao->prepare($sql);
            $stmt->bindValue(':id', $usuario->idUsuario);

            return $stmt->execute();
        }




        public function getUsuario($idUsuario) {
            $conexao = (new Conexao())->getConexao();

            $sql = "SELECT * FROM usuario WHERE idUsuario = :id;";

            $stmt = $conexao->prepare($sql);
            $stmt->bindParam(':id', $idUsuario);
            $stmt->execute();

            return $stmt->fetch(PDO::FETCH_ASSOC);
        }
        
    }