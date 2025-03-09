<?php

class CadastroAlunos {
    private string $arquivo = "alunos.json";

    // Método para cadastrar um aluno e salvar no arquivo JSON
    public function cadastrarAluno(Aluno $aluno): void {
        $dados = $this->lerArquivo();

        // Adiciona o novo aluno ao array
        $dados[] = [
            "nome" => $aluno->getNome(),
            "matricula" => $aluno->getMatricula(),
            "curso" => $aluno->getCurso()
        ];

        // Salva no arquivo JSON
        file_put_contents($this->arquivo, json_encode($dados, JSON_PRETTY_PRINT));
        echo "Aluno cadastrado com sucesso!\n";
    }

    // Método para listar os alunos do arquivo JSON
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

    // Método auxiliar para ler o arquivo JSON
    private function lerArquivo(): array {
        if (!file_exists($this->arquivo)) {
            return [];
        }

        $conteudo = file_get_contents($this->arquivo);
        return json_decode($conteudo, true) ?? [];
    }
}
?>
