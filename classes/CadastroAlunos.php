<?php

class CadastroAlunos {
    private string $arquivo;

    public function __construct(string $file = "../cadastroAluno/alunos.json") {
        $this->arquivo = $file;
    }

    public function cadastrarAluno(Aluno $aluno): void {
        $dados = $this->lerArquivo();

        $matriculaNova = $aluno->getMatricula();
        $existe = false;

        foreach ($dados as $item) {
            if ($item["matricula"] === $matriculaNova) {
                $existe = true;
                break; 
            }
        }

        if (!$existe) {
            $dados[] = [
                "nome" => $aluno->getNome(),
                "matricula" => $matriculaNova,
                "curso" => $aluno->getCurso()
            ];
            file_put_contents($this->arquivo, json_encode($dados, JSON_PRETTY_PRINT));
            echo "Aluno cadastrado com sucesso!\n";
        } else {
            echo "Matrícula já cadastrada!";
        }
    }

    public function listarAlunos(): void {
        $dados = $this->lerArquivo();

        if (empty($dados)) {
            echo "Nenhum aluno cadastrado.\n";
            return;
        }

        foreach ($dados as $aluno) {
            echo "Nome: " . $aluno['nome'] . "; ";
            echo "Matrícula: " . $aluno['matricula'] . "; ";
            echo "Curso: " . $aluno['curso'] . "; ";
            echo "<br>";
        }
    }

    private function lerArquivo(): array {
        if (!file_exists($this->arquivo)) {
            return [];
        }

        $conteudo = file_get_contents($this->arquivo);
        return json_decode($conteudo, true) ?? [];
    }
}
?>
