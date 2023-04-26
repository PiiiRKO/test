<?php

$json = file_get_contents('php://input');
$obj = json_decode($json);
$response=new StdClass();
if($obj){
    $uniqueid=isset($obj->uniqueid)?$obj->uniqueid:"uniqueid";
    $modelId=isset($obj->modelId)?$obj->modelId*1:0;
    $modelName=isset($obj->modelName)?$obj->modelName:"";
    $screenWidth=isset($obj->screenWidth)?$obj->screenWidth*1:300;
    $screenHeight=isset($obj->screenHeight)?$obj->screenHeight:300;
    $data=isset($obj->data)?$obj->data:"";
    $battery=isset($obj->battery)?$obj->battery*1:0;
    
    // test data from the phone 
    $test=isset($obj->test)?$obj->test:false;
    $response->status='ok';
    $info="";
    if($test) $info.="test\n";
    else{
       $url = 'https://api.exchangerate.host/latest?base=CAD&symbols=CZK';
$data = json_decode(file_get_contents($url), true);
$rate = $data['rates']['CZK'];

echo "CAD/CZK: " . $rate;
    }
    $info.="\n".gmdate("Y-m-d H:i:s");
    $response->info=$info;
    $response->vibe=0;
}
else $response->status='error';

header("Content-Type: application/json;charset=utf-8");
echo json_encode($response);


?>
