<?php

/* 
    Descrição Geral: Implemente uma função que determine a melhor forma de carregar um veículo com uma capacidade máxima, otimizando a quantidade de produtos carregados.
    Requisitos Específicos:
    •	A função deve receber uma lista de produtos, onde cada produto é uma tupla contendo o nome do produto e o seu peso.
    •	A função deve receber a capacidade máxima do veículo.
    •	A função deve retornar uma lista de produtos que maximizam o peso carregado sem exceder a capacidade do veículo.
*/

$produtos = [
    ["produto1", 10],
    ["produto2", 20],
    ["produto3", 30],
    ["produto4", 40]
];

/**
 * Função que realiza o planejamento de carga
 * @param array $produtos
 * @param int $capacidade
 * @return array
 */
function planejamentoCarga($produtos, $capacidade = 50) {

    $maiorProduto = []; // Armazena a informação da maior carga
    $produtosParaSoma = []; // Armazena os produtos que somados a maior carga são viáveis para o carregamento
    $cargaAtual = 0; // Armazena a informação do total da carga
    $carga = []; // Armazena o resultado com os produtos e seus pesos
        
    for ($i = 0; $i < count($produtos); $i++) { // Loop para localizar o produto viável com maior peso

        if ($produtos[$i][1] > $capacidade) { // Caso o produto não seja suportado pelo veículo atual, remove do array
            
            unset($produtos[$i]);

            $produtos = array_values($produtos);

            continue;
        }

        if ($produtos[$i][1] == $capacidade) { // Caso o produto tenha o peso exato da capacidade retorna este único produto

            return array([$produtos[$i][0], $produtos[$i][1]]);
        } else {

            if (empty($maiorProduto)) {
                
                $maiorProduto = [$produtos[$i][0], $produtos[$i][1]];
            } else {

                if ($produtos[$i][1] > $maiorProduto[1]) {

                    $maiorProduto = [$produtos[$i][0], $produtos[$i][1]];
                }
            }
        }
    }

    for ($i = 0; $i < count($produtos); $i++) { // Loop que verifica os produtos restantes viáveis para o carregamento
  
        if ($maiorProduto[0] == $produtos[$i][0]) { // Caso seja o produto encontrado na etapa anterior, pula para o próximo ciclo
            continue;
        }

        $somaValores = $produtos[$i][1] + $maiorProduto[1];

        if ($somaValores > $capacidade) { // Verifica se o produto somado a carga atual ultrapassa a capacidade
            continue;
        } else {

            $cargaAtual = $somaValores;

            $produtosParaSoma[] = [$produtos[$i][0], $produtos[$i][1]]; // Adiciona o produto a um array de produtos viáveis
        }
    }

    $carga[] = [$maiorProduto[0], $maiorProduto[1]];
    $cargaAtual = $carga[0][1];

    foreach ($produtosParaSoma as $prod) { // Loop para definir os produtos que irão na carga juntamente ao produto de maior peso

        if ($cargaAtual + $prod[1] <= $capacidade) {

            $carga[] = [$prod[0], $prod[1]];
            $cargaAtual += $prod[1];
        } 

        if ($cargaAtual == $capacidade) {

            break;
        }
    }

    return $carga;

}

print_r(planejamentoCarga($produtos));