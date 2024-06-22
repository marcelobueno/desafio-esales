<?php

/* Desafio 1: Otimização de Rota de Entrega
    Descrição Geral: Implemente uma função que calcule a rota de entrega mais curta para um veículo de entrega que deve passar por vários pontos de entrega e retornar ao ponto de origem. Use o algoritmo do caixeiro-viajante (Traveling Salesman Problem - TSP).
    Requisitos Específicos:
    •	A função deve receber uma matriz de distâncias onde dist[i][j] representa a distância entre os pontos i e j.
    •	A função deve retornar a rota mais curta e a distância total.
*/

/**
 * Otimização de rota de entrega
 * 
 * Para resolver este problema, precisei estudar o altorítmo do caixeiro viajante e entender como ele funciona.
 * Depois de alguns minutos estudando cheguei a este resultado.
 */

$entregas = [
    [0, 10, 15, 20],
    [10, 0, 35, 25],
    [15, 35, 0, 30],
    [20, 25, 30, 0]
];

/**
 * Função que otimiza a rota de entrega
 * 
 * @param array $dist
 * @return array $caminho, $distancia
 */
function otimizaRota($dist) {
    $n = count($dist); // Número de entregas
    $visitado = array_fill(0, $n, false); // Array que indica quais locais já foram visitadas
    $visitado[0] = true; // Seta o local 0 como true por se tratar do ponto inicial
    $caminho = [0]; // Array que indica a rota a ser percorrida, o primeiro local sempre inicia como 0
    $distancia = 0; // Distância total percorrida na rota

    for ($i = 0; $i < $n - 1; $i++) { // Realiza um loop em cada uma das entregas
        $minDist = PHP_INT_MAX; // Indicará qual a menor distância para um dos próximos pontos
        $prox = -1; 

        for ($j = 0; $j < $n; $j++) { // Realiza um segundo loop para verificar as distâncias
            if (!$visitado[$j] && $dist[$caminho[$i]][$j] < $minDist) { // Se ainda não tenha sido visitado e sua distância seja a menor
                $minDist = $dist[$caminho[$i]][$j]; // Atribui a distância da entrega
                $prox = $j; // Seta a próxima parada
            }
        }
        $visitado[$prox] = true; // Sinaliza que o local foi visitado
        $caminho[] = $prox; // Adiciona a parada ao roteiro
        $distancia += $minDist; // Soma a distância a distância total a ser percorrida
    }

    // Adiciona a distância de retorno ao ponto inicial para completar o ciclo
    $distancia += $dist[$prox][0];

    return [$caminho, $distancia];
}

print_r(otimizaRota($entregas));
