<?php
use \PHPUnit\Framework\TestCase;
require_once 'ManipulaArquivo.php';
class ManipulaArquivoText extends TestCase
{
    private $esperado;

    public function __construct(?string $name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
        $this->esperado = [
        0 => [
                "seq" => 1,
                "status" => "REC READ",
                "from" => "+5511388382882",
                "timestamp" => "2022-05-05 16:05:23",
                "text" => "00480065006C006C006F00200077006F0072006C0064002000C1"
        ],
        1 => [
                "seq" => 2,
                "status" => "REC UNREAD",
                "from" => "+5511388382882",
                "timestamp" => "2022-05-10 13:05:14",
                "text" => "Essa eh a segunda mensagem"

            ],
        2 => [
                "seq" => 3,
                "status" => "REC UNREAD",
                "from" => "+551130872258",
                "timestamp" => "2022-05-30 19:05:01",
                "text" => "Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam..."
            ]
        ];
    }

    public function testValidaArquivo(){
        $manipulaArquivo = new ManipulaArquivo();
        $manipulaArquivo->arquivo = "https://faturasimples.s3.amazonaws.com/sms-example.txt";


        $this->assertEquals($this->esperado, $manipulaArquivo->validaArquivo());
    }
}
