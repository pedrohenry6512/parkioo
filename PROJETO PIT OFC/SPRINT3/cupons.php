<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cupons Disponíveis</title>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            font-weight: 400;
            background: #fff;
            margin: 0;
            padding: 0;
            color: #333;
        }
        h1 {
            color: #fc6b0f;
            text-align: center;
            padding: 1rem;
            font-size: 1.5rem;
            margin-top: 0;
        }
        .search-container {
            text-align: center;
            margin: 1rem;
        }
        .search-input {
            font-size: 1rem;
            padding: 0.5rem;
            width: 80%;
            max-width: 400px;
            border-radius: 0.5rem;
            border: 1px solid #ccc;
            margin-bottom: 1rem;
        }
        .container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 1rem;
            padding: 1rem;
        }
        .cupom {
            box-sizing: border-box;
            width: calc(20% - 1rem);
            background: #fc6b0f;
            padding: 1rem;
            border-radius: 0.75rem;
            color: #fff;
            display: flex;
            flex-direction: column;
            align-items: center;
            font-size: 14px;
            margin: 0.5rem;
            transition: opacity 0.3s ease;
        }
        .cupom.hidden {
            opacity: 0;
            pointer-events: none;
        }
        .fotocupom img {
            max-width: 80%;
            height: auto;
            border-radius: 0.5rem;
        }
        .dadoscupom {
            text-align: center;
        }
        .vantagem {
            font-size: 1.25rem;
            font-weight: bold;
        }
        .descritivo {
            font-size: 0.875rem;
            margin: 0.5rem 0;
        }
        .nomecupom {
            font-size: 1rem;
            font-weight: bold;
            margin: 0.5rem 0;
        }
        .cta {
            display: inline-block;
            background: #fff;
            color: #fc6b0f;
            padding: 0.5rem 0.75rem;
            border-radius: 0.5rem;
            text-decoration: none;
            font-weight: bold;
            margin: 0.5rem 0;
            cursor: pointer;
        }
        .cta:hover {
            background: #fc6b0f;
            color: #fff;
        }
        .condicoes {
            color: #fff;
            text-decoration: underline;
            cursor: pointer;
            font-size: 0.875rem;
        }
        .uk-modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            align-items: center;
            justify-content: center;
            padding: 0.5rem;
        }
        .uk-modal .legal {
            color: #000;
            background: #fff;
            padding: 1rem;
            border-radius: 0.5rem;
            width: 80%;
            max-width: 400px;
            position: relative;
            text-align: center;
        }
        .uk-modal-close-default {
            position: absolute;
            top: 0.5rem;
            right: 0.5rem;
            border: none;
            background: none;
            cursor: pointer;
        }
        .uk-modal-close-default svg {
            fill: #000;
            width: 12px;
            height: 12px;
        }
        .uk-modal h2 {
            margin-top: 0;
            font-size: 1rem;
        }
        .uk-modal p {
            font-size: 1.1rem;
            margin: 0;
        }
    </style>
</head>
<body>

    <h1>Cupons Disponíveis</h1>

    <div class="search-container">
        <input type="text" id="search-input" class="search-input" placeholder="Buscar cupons..." onkeyup="searchCupons()">
    </div>

    <div class="container">
        <?php
        // Definindo cupons em um array
        $cupons = [
            [
                "img" => "../assets/cupom-desconto-icone.png",
                "vantagem" => "5% OFF",
                "descritivo" => "para quem é Prime Ninja aproveitar a seleção de Desconto",
                "nome" => "PRIMEOFF",
                "condicoes" => "Válido para um cupom por veículo, nas reservas realizadas no site, enquanto houver disponibilidade de cupons, para clientes cadastrados. Exceto para estacionamentos em áreas premium e coberta"
            ],
            [
                "img" => "../assets/cupom-desconto-icone.png",
                "vantagem" => "10% OFF",
                "descritivo" => "Desconto em produtos selecionados para novos clientes",
                "nome" => "NOVO10",
                "condicoes" => "Válido para novos clientes. Exceto em produtos em promoção e categorias específicas."
            ],
            [
                "img" => "../assets/cupom-desconto-icone.png",
                "vantagem" => "15% OFF",
                "descritivo" => "100 R$ em vagas para Usar",
                "nome" => "APROVEITAE100",
                "condicoes" => "Desconto válido. Não cumulativo com outras ofertas."
            ],
            [
                "img" => "../assets/cupom-desconto-icone.png",
                "vantagem" => "20% OFF",
                "descritivo" => "Desconto para compras no primeiro pedido",
                "nome" => "FIRST20",
                "condicoes" => "Válido para o primeiro pedido em produtos selecionados."
            ]
        ];

        // Loop para exibir cada cupom
        foreach ($cupons as $cupom) {
            echo '
            <div class="cupom" data-nome="' . $cupom['nome'] . '">
                <div class="separacupom flex between">
                    <div class="fotocupom">
                        <img src="' . $cupom['img'] . '" alt="Cupom de Desconto">
                    </div>
                    <div class="dadoscupom">
                        <p class="vantagem">' . $cupom['vantagem'] . '</p>
                        <p class="descritivo">' . $cupom['descritivo'] . '</p>
                        <p class="nomecupom">' . $cupom['nome'] . '</p>
                        <a class="cta" onclick="openCupomModal(\'' . $cupom['nome'] . '\')">» Usar</a>
                        <div class="flex between">
                            <a class="condicoes" href="#modal-' . $cupom['nome'] . '" onclick="document.querySelector(\'#modal-' . $cupom['nome'] . '\').style.display=\'flex\';">Condições</a>
                        </div>
                        <div id="modal-' . $cupom['nome'] . '" class="uk-modal" role="dialog" aria-modal="true">
                            <div class="legal">
                                <button class="uk-modal-close-default" type="button" onclick="document.querySelector(\'#modal-' . $cupom['nome'] . '\').style.display=\'none\';" aria-label="Close">
                                    <svg width="12" height="12" viewBox="0 0 14 14">
                                        <line fill="none" stroke="#000" stroke-width="1" x1="1" y1="1" x2="13" y2="13"></line>
                                        <line fill="none" stroke="#000" stroke-width="1" x1="13" y1="1" x2="1" y2="13"></line>
                                    </svg>
                                </button>
                                <h2>Condições - ' . $cupom['nome'] . '</h2>
                                <p>' . $cupom['condicoes'] . '</p>
                            </div>
                        </div>
                        <div id="cupom-modal-' . $cupom['nome'] . '" class="uk-modal" role="dialog" aria-modal="true">
                            <div class="legal">
                                <button class="uk-modal-close-default" type="button" onclick="document.querySelector(\'#cupom-modal-' . $cupom['nome'] . '\').style.display=\'none\';" aria-label="Close">
                                    <svg width="12" height="12" viewBox="0 0 14 14">
                                        <line fill="none" stroke="#000" stroke-width="1" x1="1" y1="1" x2="13" y2="13"></line>
                                        <line fill="none" stroke="#000" stroke-width="1" x1="13" y1="1" x2="1" y2="13"></line>
                                    </svg>
                                </button>
                                <h2>Usar Cupom - ' . $cupom['nome'] . '</h2>
                                <p>Este cupom está indisponível no momento.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>';
        }
        ?>
    </div>

    <script>
        function searchCupons() {
            var input, filter, container, cupom, i, nomecupom;
            input = document.getElementById('search-input');
            filter = input.value.toUpperCase();
            container = document.getElementsByClassName('container')[0];
            cupom = container.getElementsByClassName('cupom');

            for (i = 0; i < cupom.length; i++) {
                nomecupom = cupom[i].getAttribute('data-nome');
                if (nomecupom.toUpperCase().indexOf(filter) > -1) {
                    cupom[i].classList.remove('hidden');
                } else {
                    cupom[i].classList.add('hidden');
                }
            }
        }

        function openCupomModal(nome) {
            document.querySelector('#cupom-modal-' + nome).style.display = 'flex';
        }
    </script>

</body>
</html>
