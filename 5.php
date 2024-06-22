<?php

/* 
    Desafio 5: Previsão de Demanda
    Descrição Geral: Implemente uma função para prever a demanda futura de produtos com base em dados históricos de vendas.
    Requisitos Específicos:
    •	A função deve receber uma lista de dados históricos de vendas, onde cada item é uma tupla contendo a data e a quantidade vendida.
    •	A função deve retornar a previsão de demanda para o próximo período.
*/

$historicoVendas = [
    ["2024-01-01", 100],
    ["2024-02-01", 150],
    ["2024-03-01", 200]
];

/**
 * Função que prevê a demanda futura de produtos
 * 
 * @param array $historicoVendas
 * @return int $previsao
 */

function previsaoDemanda($historicoVendas) {
    
    $totalVendas = 0; // Armazena o total de vendas
    $mediaVendas = 0; // Armazena a média de vendas
    $previsao = 0; // Armazena a previsão de vendas
    
    for ($i = 0; $i < count($historicoVendas); $i++) { // Loop para somar o total de vendas
        
        $totalVendas += $historicoVendas[$i][1];
    }
    
    $mediaVendas = $totalVendas / count($historicoVendas); // Calcula a média de vendas
    
    $previsao = $mediaVendas; // A previsão é igual à média de vendas
    
    return $previsao; // Retorna a previsão de vendas
}

echo previsaoDemanda($historicoVendas);