<?php
require_once 'DAL/StatusDAO.php';

class StatusModel {
    public ?int $idStatus;
    public ?string $descricaoStatus;


    public function __construct(
        ?int $idStatus = null,
        ?string $descricaoStatus = null,
        
    ) 
    {
        $this->idStatus= $idStatus;
        $this->descricaoStatus = $descricaoStatus;
    }

    public function getStatus() {
        $statusDAO = new StatusDAO();

      
        $status = $statusDAO->getStatus();

        $statusModels = [];
        foreach ($status as $statu) { 
            $statusModel = new StatusModel(
                $statu['idStatus'],
                $statu['descricaoStatus']
            );
            $statusModels[] = $statusModel;
        }

        return $statusModels;
    }

    public function buscarStatusPorId($idStatus) {
        $statusDAO = new StatusDAO();

        $status = $statusDAO->buscarStatusPorId($idStatus);
        $status = new StatusModel($status['idStatus'], $status['idStatus']);

        return $status;
    }



}
