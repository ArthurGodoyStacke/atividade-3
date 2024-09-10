<?php
    require_once 'Conexao.php';

    class StatusDAO {
        public function getStatus() {
            $conexao = (new Conexao())->getConexao();

            $sql = "SELECT * FROM status;";

            $stmt = $conexao->prepare($sql);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

     
        public function buscarStatusPorId($idStatus) {
            $conexao = (new Conexao())->getConexao();

            $sql = "SELECT * FROM status WHERE idStatus = :id;";

            $stmt = $conexao->prepare($sql);
            $stmt->bindValue(':id', $idStatus);
            $stmt->execute();
            
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }
    }
?>        