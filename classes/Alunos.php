<?php
class Aluno {
    private string $nome;
    private string $matricula;
    private string $curso;

    public function __construct(string $nome, string $matricula, string $curso) {
        $this->nome = $nome;
        $this->matricula = $matricula;
        $this->curso = $curso;
    }

    public function getNome(): string {
        return $this->nome;
    }

    public function getMatricula(): string {
        return $this->matricula;
    }

    public function getCurso(): string {
        return $this->curso;
    }
}
?>
