<?php
$ch = curl_init();
$url = 'http://apis.data.go.kr/1360000/VilageFcstInfoService_2.0/getVilageFcst'; /*URL*/
$queryParams = '?' . urlencode('ServiceKey') . '=XvksfMzK5mJmpIcQS5gcvO0bMyOZsXfk%2FYGJJkt%2Buc6DZ5PJQmNwVceuN2BfU3JIPmKhIU3Ejwnj9OIKhhdMSQ%3D%3D'; /*Service Key*/
//$queryParams = '?' . urlencode('ServiceKey') . '=XvksfMzK5mJmpIcQS5gcvO0bMyOZsXfk/YGJJkt+uc6DZ5PJQmNwVceuN2BfU3JIPmKhIU3Ejwnj9OIKhhdMSQ=='; /*Service Key*/
$queryParams .= '&' . urlencode('pageNo') . '=' . urlencode('1'); /**/
$queryParams .= '&' . urlencode('numOfRows') . '=' . urlencode('10'); /**/
$queryParams .= '&' . urlencode('dataType') . '=' . urlencode('XML'); /**/
$queryParams .= '&' . urlencode('base_date') . '=' . urlencode('20210730'); /**/
$queryParams .= '&' . urlencode('base_time') . '=' . urlencode('0500'); /**/
$queryParams .= '&' . urlencode('nx') . '=' . urlencode('60'); /**/
$queryParams .= '&' . urlencode('ny') . '=' . urlencode('127'); /**/

// $queryparams = '?' . urlencode('ServiceKey') . '=XvksfMzK5mJmpIcQS5gcvO0bMyOZsXfk/YGJJkt+uc6DZ5PJQmNwVceuN2BfU3JIPmKhIU3Ejwnj9OIKhhdMSQ==';
// $queryparams .= ''
//curl_setopt($ch, CURLOPT_URL, $url . $queryParams);
curl_setopt($ch, CURLOPT_URL, $url . $queryParams);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($ch, CURLOPT_HEADER, FALSE);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'GET');
$response = curl_exec($ch);
curl_close($ch);

// $xml_string = file_get_contents_curl($url);
$xml = simplexml_load_string($response);
$json = json_encode($xml); // XML to JSON
$R = json_decode($json,TRUE);//배열로 변환

// print_r($R);
echo '<br />';
echo '<br />';
// echo $R['response']['header']['tm'].'<br />';//날씨 예보시간
$date = $R['body']['items']['item'][0]['baseDate'];
$tmp = $R['body']['items']['item'][0]['fcstValue'];
$pop = $R['body']['items']['item'][7]['fcstValue'];
echo '날짜 : '.$date.' 기온 : '.$tmp.' 강수확률 : '.$pop.'%';
// var_dump($response);