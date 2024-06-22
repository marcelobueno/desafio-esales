<?php

/*
    Desafio 4: Alocação de Veículos
    Descrição Geral: Desenvolva uma função para alocar veículos de entrega para diferentes pedidos de entrega, otimizando o uso dos veículos disponíveis.
    Requisitos Específicos:
    •    A função deve receber uma lista de pedidos, onde cada pedido é uma tupla contendo o ID do pedido e o peso do pedido.
    •    A função deve receber uma lista de veículos, onde cada veículo é uma tupla contendo o ID do veículo e a sua capacidade máxima.
    •    A função deve retornar uma lista de alocações, onde cada alocação é uma tupla contendo o ID do veículo e uma lista de IDs dos pedidos alocados.
*/

$pedidos = [
    ["pedido1", 10],
    ["pedido2", 20],
    ["pedido3", 30],
    ["pedido4", 40]
];

$veiculos = [
    ["veiculo1", 50],
    ["veiculo2", 60]
];

/**
 * Função que realiza a alocação de pedidos nos veículos
 * @param array $pedidos
 * @param array $veiculos
 * @return array $alocacoes
 */
function alocacaoPedidos($pedidos, $veiculos) {
    // Ordena os pedidos por peso em ordem decrescente
    usort($pedidos, function($a, $b) {
        return $b[1] - $a[1];
    });

    // Ordena os veículos por capacidade em ordem decrescente
    usort($veiculos, function($a, $b) {
        return $b[1] - $a[1];
    });

    $alocacoes = [];

    foreach ($veiculos as $veiculo) {
        $veiculoId = $veiculo[0]; // ID do veículo
        $capacidadeMaxima = $veiculo[1]; // Capacidade máxima do veículo
        $alocacoes[$veiculoId] = []; // Inicializa a lista de alocações para o veículo
        $capacidadeUsada = 0; // Capacidade usada do veículo

        foreach ($pedidos as $key => $pedido) {
            $pedidoId = $pedido[0]; // ID do pedido
            $pesoPedido = $pedido[1]; // Peso do pedido

            // Verifica se o pedido pode ser alocado no veículo atual
            if ($capacidadeUsada + $pesoPedido <= $capacidadeMaxima) {
                $alocacoes[$veiculoId][] = $pedidoId;
                $capacidadeUsada += $pesoPedido;
                // Remove o pedido da lista de pedidos pendentes
                unset($pedidos[$key]);
            }
        }
    }

    // Formatar a lista de alocações como uma lista de tuplas
    $result = [];
    foreach ($alocacoes as $veiculoId => $pedidoIds) {
        if (!empty($pedidoIds)) {
            $result[$veiculoId] = $pedidoIds;
        }
    }

    return $result;
}

var_dump(alocacaoPedidos($pedidos, $veiculos));