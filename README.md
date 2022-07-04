# Teste Fatura Simples

## Teste de importação de arquivo txt e convertendo dados para retorno json

Para utilizar o teste, é preciso seguir os seguintes passos:
- Executar: composer install
- Ter o php 7 ou superior instalado nativamente
- Executar o comando: php formata.php --file="https://faturasimples.s3.amazonaws.com/sms-example.txt" 
- Para executar o teste unitario: php vendor/bin/phpunit --colors ManipulaArquivoText.php

