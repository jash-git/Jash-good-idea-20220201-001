
<?php

class AES
{
    /**
     * var string $method 加解密方法，可通過openssl_get_cipher_methods()獲得
     */
    protected $method;

    /**
     * var string $secret_key 加解密的密鑰
     */
    protected $secret_key;

    /**
     * var string $iv 加解密的向量，有些方法需要設置比如CBC
     */
    protected $iv;

    /**
     * var string $options （不知道怎麼解釋，目前設置爲0沒什麼問題）
     */
    protected $options;

    /**
     * 構造函數
     *
     * @param string $key 密鑰
     * @param string $method 加密方式
     * @param string $iv iv向量
     * @param mixed $options 還不是很清楚
     *
     */
    public function __construct($key, $method = 'AES-128-CBC', $iv = '', $options = 0)
    {
        // key是必須要設置的
        $this->secret_key = isset($key) ? $key : exit('key爲必須項');

        $this->method = $method;

        $this->iv = $iv;

        $this->options = $options;
    }

    /**
     * 加密方法，對數據進行加密，返回加密後的數據
     *
     * @param string $data 要加密的數據
     *
     * @return string
     *
     */
    public function encrypt($data)
    {
        $en = openssl_encrypt($data, $this->method, $this->secret_key, $this->options, $this->iv);
        $en = $this->String2Hex($en);
        return $en;
    }

    /**
     * 解密方法，對數據進行解密，返回解密後的數據
     *
     * @param string $data 要解密的數據
     *
     * @return string
     *
     */
    public function decrypt($data)
    {
        $data = $this->Hex2String($data);
        $de = openssl_decrypt($data, $this->method, $this->secret_key, $this->options, $this->iv);
        return $de;
    }


    public function String2Hex($string){


        $hex='';
//        for ($i=0; $i < strlen($string); $i++){
//            $hex .= dechex(ord($string[$i]));
//        }
        $hex = bin2hex($string);
        return $hex;
    }

    public function Hex2String($hex){
        $string='';
        for ($i=0; $i < strlen($hex)-1; $i+=2){
            $string .= chr(hexdec($hex[$i].$hex[$i+1]));
        }
        return $string;
    }
}


$data = '{"messageid":15645624658187,"timestamp":1564562465,"deviceid":"AD13L1907310001","cmd":"CMD-01","desired":{"allget":1}}';
$key = 'FW2VN#N8DAL147L*';
//$aes = new Aes($key, 'AES-128-CBC', '2398DHY433UGFKL1X',  1);
$aes = new Aes($key, 'AES-128-CBC', '2398DHY433UGFKL1X',  1);
$encode = $aes->encrypt($data);
echo "#####encode#####" . $encode . PHP_EOL;
$decode = $aes->decrypt($encode);
echo "#####decode#####" . $decode . PHP_EOL;