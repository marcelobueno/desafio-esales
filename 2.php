<?php

/* 
    Desafio 2: Rastreamento de Inventário
    Descrição Geral: Desenvolva uma função para gerenciar o inventário de um armazém. A função deve processar uma lista de operações de entrada e saída de produtos e retornar o inventário atualizado.
    Requisitos Específicos:
    •	A função deve receber uma lista de operações, onde cada operação é uma tupla contendo o tipo de operação ("entrada" ou "saida"), o nome do produto e a quantidade.
    •	A função deve retornar um dicionário com o inventário atualizado.
*/

$operacoes = [
    ["entrada", "item1", 50],
    ["saida", "item1", 20],
    ["entrada", "item2", 70]
];

/**
 * Função que gerencia o inventário de um armazém
 * 
 * @param array $operações
 * @return array $inventario
 */

function rastreamentoInventario(array $inventario) {

    $armazem = []; // Array que controlará os produtos e suas quantidades

    for ($i = 0; $i < count($inventario); $i++) { // Realiza o loop nas operações

        $operacao = $inventario[$i][0]; // Obtém o tipo de operação
        $item = strval($inventario[$i][1]); // Obtém o nome do produto
        $valor = $inventario[$i][2];  // Obtém a quantidade movimentada

        !isset($armazem[$item]) ? $armazem[$item] = 0 : null; // Caso não exista registro do produto no armazém cria o registro

        if ($operacao == "entrada") { // Se a operação for entrada

            $armazem[$item] += $valor; // Soma o valor ao item no armazém
        } else { // Se for saída

            $armazem[$item] = $armazem[$item] - $valor; // Subtrai o valor do produto do armazém
        }
    }

    return $armazem; // Retorna o inventário com os valores atuais
}

print_r(rastreamentoInventario($operacoes));