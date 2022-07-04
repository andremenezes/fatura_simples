<?php

class ManipulaArquivo
{
    public $contentquivo;

    public function validaArquivo(){

        $content = $this->fileRead($this->arquivo);
        if(!$content){
            echo "Arquivo inválido! \n";
            return false;
        }
        if($content == 'format_error'){
            echo "Formato inválido! \n";
            return false;
        }

        $ct = 0;
        $fields = ['seq','status','from','','timestamp','text'];
        $contentResult = [];
            while (!feof($content)) {
                $linha = fgets($content, 1024);

                    if (explode('=', $linha)[0] != 'AT+CMGL') {

                        if (!empty($linha) && !str_contains($linha, 'OK')) {
                            if (explode(':', $linha)[0] == '+CMGL') {
                                foreach (explode(',', $linha) as $key => $item) {
                                    if($key != 3) {
                                        if ($key == 0) {
                                            $contentResult[$ct][$fields[$key]] = intval(explode(':', preg_replace("/\r|\n/", "", str_replace('"', '', ltrim($item))))[1]);
                                        } else {
                                            if ($key == 5) {
                                                $contentResult[$ct]['timestamp'] .= " " . explode('+', preg_replace("/\r|\n/", "", str_replace('"', '', ltrim($item))))[0];
                                                $contentResult[$ct]['timestamp'] = DateTime::createFromFormat('y/m/d H:i:s', $contentResult[$ct]['timestamp'])->format('Y-m-d H:m:s');
                                            } else {
                                                $contentResult[$ct][$fields[$key]] = preg_replace("/\r|\n/", "", str_replace('"', '', ltrim($item)));
                                            }
                                        }
                                    }
                                }
                            } else {
                                $contentResult[$ct][$fields[$key]] = preg_replace("/\r|\n/", "", str_replace('"', '', ltrim($linha)));
                                $ct++;
                            }
                        }
                    }

            }

            print_r(json_encode($contentResult));
    }

    private function fileRead($fileName) {
        $fc = @file_get_contents($fileName);

        if(($http_response_header[0] == "HTTP/1.1 200 OK") && (strlen($fc) > 0)) {

                $temp = fopen("php://memory", "rw");
                fwrite($temp, $fc);
                fseek($temp, 0);

                if (preg_replace("/\r|\n/", "", str_replace('"', '', ltrim(fgets($temp)))) != "AT+CMGL=ALL"){
                    return 'format_error';
                }
                return $temp;

        }else{
            return false;
        }
    }
}


