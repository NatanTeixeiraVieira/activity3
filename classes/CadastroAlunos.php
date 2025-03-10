<?php

class CadastroAlunos {
    private string $arquivo = "alunos.json";

    public function cadastrarAluno(Aluno $aluno): void {
        $dados = $this->lerArquivo();

        $dados[] = [
            "nome" => $aluno->getNome(),
            "matricula" => $aluno->getMatricula(),
            "curso" => $aluno->getCurso()
        ];

        file_put_contents($this->arquivo, json_encode($dados, JSON_PRETTY_PRINT));
        echo "Aluno cadastrado com sucesso!\n";
    }

    public function listarAlunos(): void {
        $dados = $this->lerArquivo();

        if (empty($dados)) {
            echo "Nenhum aluno cadastrado.\n";
            return;
        }

        foreach ($dados as $aluno) {
            echo "Nome: " . $aluno['nome'] . "\n";
            echo "Matrícula: " . $aluno['matricula'] . "\n";
            echo "Curso: " . $aluno['curso'] . "\n";
            echo "-------------------------\n";
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
