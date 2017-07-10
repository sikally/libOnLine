<?php
class LangueDTO {

    private $id;
private $codeLangue;
private $libelleLangue;

    public function setId($id){
            $this->id = $id;
        }
public function getId(){
            return $this->id;
        }
public function setCodeLangue($codeLangue){
            $this->codeLangue = $codeLangue;
        }
public function getCodeLangue(){
            return $this->codeLangue;
        }
public function setLibelleLangue($libelleLangue){
            $this->libelleLangue = $libelleLangue;
        }
public function getLibelleLangue(){
            return $this->libelleLangue;
        }

}