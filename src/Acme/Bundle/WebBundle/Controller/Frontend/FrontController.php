<?php

namespace Acme\Bundle\WebBundle\Controller\Frontend;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Acme\Component\Product\Model\Product;

/**
 * Frontend controller.
 *
 */
class FrontController extends Controller
{
  /**
   * Web front page.
   *
   * @return Response
   */
  public function indexAction(Request $request)
  {
    $aes = new \Legierski\AES\AES;

    $appKey = "JLDJTEST";
    $appSecret = "KIW37G33A4V4Q60W";

    // echo $encrypted = $aes->encrypt($appKey, $appSecret);
    echo $encrypted = "D0ABB1419338E9CD297ED1EF3573393D";

    echo '</br>';

    echo $encryptedForOpenSSL = $aes->wrapForOpenSSL($encrypted);
    echo '</br>';

    $decrypted = $aes->decrypt($encrypted, $appSecret);
    $response = $this->getAixuetangToken($appKey, $encrypted);

    var_dump($response);
    echo '</br>';

    $aixuetangToken = $response;

    echo 'Http Guzzle:</br>';
    echo $token = $this->getAixuetangToken02($appKey, $encrypted);

    echo "</br>Dump:</br>";
    $json_token = json_decode($token);
    var_dump($json_token);

    echo "</br>Token:</br>";
    echo $token_string = $json_token->{"token"};

    echo "URL path:</br>";
    $url = "http://106.37.240.130:10029/hnds_teacher/jlApi/userLogin?token=" . $token_string . "&userCode=be2269b7-28ac-4ec1-a744-765d8b0e6e6d&userName=\u5f20\u4e09&userType=0&schoolCode=54321&schoolName=\u5409\u6797\u4e00\u5c0f&provinceCode=15&provinceName=\u5409\u6797&cityCode=212&cityName=\u5409\u6797\u5e02&areaCode=1784&areaName=\u8239\u8425\u533a&subjectName=\u6570\u5b66&gradeName=\u4e03\u5e74\u7ea7";
    echo $url;

    $this->aesECB();

    // echo file_get_contents($url);

    return $this->render('AcmeWebBundle:Frontend/Front:index.html.twig', array('encrypted_data' => $decrypted));
  }

  public function test01Action(Request $request)
  {
    $client = new \GuzzleHttp\Client();
    $token = "B8032C8933CFDF8F5AFC88177C2B96870A44939B45A44464C14616521C648466";
    $url = "http://106.37.240.130:10086/jl_online_teacher/jlApi/userLogin";

    $url = "http://106.37.240.130:10086/jl_online_teacher/jlApi/userLogin?token=B8032C8933CFDF8F5AFC88177C2B96870A44939B45A44464C14616521C648466&userCode=12&userName=\u5f20\u4e09&userType=1&schoolCode=54321&schoolName=\u5409\u6797\u4e00\u5c0f&provinceCode=15&provinceName=\u5409\u6797&cityCode=212&cityName=\u5409\u6797\u5e02&areaCode=1784&areaName=\u8239\u8425\u533a&subjectName=\u6570\u5b66&gradeName=\u516d\u5e74\u7ea7";
    //$url = "http://106.37.240.130:10086/jl_online_teacher/jlApi/userLogin?token=B8032C8933CFDF8F5AFC88177C2B96870A44939B45A44464C14616521C648466&userCode=12&userName=". $this->unicode_encode("张三") . "&userType=1&schoolCode=54321&schoolName=" . $this->unicode_encode("吉林一小") . "&provinceCode=15&provinceName=" . $this->unicode_encode("吉林") . "&cityCode=212&cityName=" . $this->unicode_encode("吉林市") . "&areaCode=1784&areaName=" . $this->unicode_encode("船营区") . "&subjectName=" . $this->unicode_encode("数学") . "&gradeName=" . $this->unicode_encode("六年级");
    echo $url;

    // $paramsArray = array(
    //                         "token" => $token,
    //                         "userCode" => 12,
    //                         "userName" => "张三",
    //                         "userType" => 1,
    //                         "schoolCode" => 54321,
    //                         "schoolName" => "吉林一小",
    //                         "provinceCode" => 15,
    //                         "provinceName" => "吉林",
    //                         "cityCode"     => 212,
    //                         "cityName"     => "吉林市",
    //                         "areaCode"     => 1784,
    //                         "areaName"     => "船营区",
    //                         "subjectName"  => "数学",
    //                         "gradeName"    => "六年级"
    //                     );

    // echo urlencode($url);

    // $res = $client->request('GET', $url, $paramsArray);

    // var_dump($res);

    //echo $res->getBody();

    // $res = $client->request('GET', 'https://api.github.com/user', [ 'auth' => ['zzpf@163.com', 'pass']]);

    // echo $res->getStatusCode();
    // echo '</br>';
    // var_dump($res->getHeader('content-type'));
    // echo '</br>';
    // echo $res->getBody();

    // $requestAsy = new \GuzzleHttp\Psr7\Request('GET', 'http://httpbin.org');

    // $promise = $client->sendAsync($requestAsy)->then(function($response){
    //   echo "I completed!" . $response->getBody();
    // });
    // $promise->wait();

    // echo "I am loading";
    // echo "</br>";

    // return new Response('<body><p>Test Page!</p><frameset rows="80%"><frame src="http://httpbin.org/"></frameset></body>');

    return new Response("");
    // return $this->render('AcmeWebBundle:Frontend/Front:test01.html.twig');
  }

  public function test02Action()
  {
    $user = $this->get('acme.user_provider.name')->findUser("test01");
    Return new Response("Response with user: " . $user->getUsername());
  }

  public function unicode_encode($str, $encoding = 'GBK', $prefix = '&#', $postfix = ';') {
    // $str = iconv($encoding, 'UCS-2', $str);
    $arrstr = str_split($str, 2);
    $unistr = '';
    for($i = 0, $len = count($arrstr); $i < $len; $i++) {
        $dec = hexdec(bin2hex($arrstr[$i]));
        $unistr .= $prefix . $dec . $postfix;
    } 
    return $unistr;
} 

  public function getAixuetangToken($appKey, $appToken)
  {        
      // $url = "http://106.37.240.130:10088/hnds_teacher/hndsApi/userVerify";
      $url = "http://106.37.240.130:10029/hnds_online_teacher/jlApi/userVerify";
      
      $url = "http://106.37.240.130:10029/hnds_teacher/jlApi/userVerify";
      $encode = 'UTF-8';

      // $contentUrlEncode = urlencode($content);

      $data = array(
                      'appKey'     => $appKey,
                      'appToken'   => $appToken,
                      'encode'     => $encode
                    );

      $result = $this->curlPost($url, $data);

      return $result;
  }

  public function getAixuetangToken02($appKey, $appToken)
  {
    // $url = "http://106.37.240.130:10088/hnds_teacher/hndsApi/userVerify";
    // $url = "http://106.37.240.130:10086/hnds_online_teacher/jlApi/";
    $url = "http://106.37.240.130:10029/hnds_teacher/jlApi/userVerify";
    $client = new \GuzzleHttp\Client();

    $res = $client->request('POST', $url, ['form_params' => ['appKey' => $appKey, 'appToken' => $appToken]]);

    return $res->getBody();
  }

  private function curlPost($url, $post_fields = array())
  {
      $ch = curl_init();
      curl_setopt($ch, CURLOPT_URL, $url);//用PHP取回的URL地址（值将被作为字符串）
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);//使用curl_setopt获取页面内容或提交数据，有时候希望返回的内容作为变量存储，而不是直接输出，这时候希望返回的内容作为变量
      curl_setopt($ch, CURLOPT_TIMEOUT, 30);//30秒超时限制
      curl_setopt($ch, CURLOPT_HEADER, 1);//将文件头输出直接可见。
      curl_setopt($ch, CURLOPT_POST, 1);//设置这个选项为一个零非值，这个post是普通的application/x-www-from-urlencoded类型，多数被HTTP表调用。
      curl_setopt($ch, CURLOPT_POSTFIELDS, $post_fields);//post操作的所有数据的字符串。
      $data = curl_exec($ch);//抓取URL并把他传递给浏览器
      curl_close($ch);//释放资源
      $res = explode("\r\n\r\n", $data);//explode把他打散成为数组
      // return $res[2]; //然后在这里返回数组。
      return $res;
  }

  private function aesECB(){
    $key = "1234567890123456";
    $key = str_pad($key, 16);
    $iv = 'asdff';    
    $content = 'hello';    
    $content = str_pad($content, 16);
    $AESed =  bin2hex( mcrypt_encrypt(MCRYPT_RIJNDAEL_128, $key, $content, MCRYPT_MODE_ECB, $iv) ); #加密

    echo "128-bit encrypted result:".$AESed.'<br>';    

    $jiemi = mcrypt_decrypt(MCRYPT_RIJNDAEL_128,$key,hexToStr($AESed),MCRYPT_MODE_ECB,$iv); #解密    
    echo '解密:';    

    echo trimEnd($jiemi); 

  }
}
