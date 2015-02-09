<?php

    session_start();
    require_once('../inc/config.inc.php');
	require_once(DIR_INC.'valid_sess.php');
    require_once(DIR_INC.'dbinit.php');
    
    
    $output = "&output=";
    
    $modelsale_id = 0; $interior = 0; $exterior = 0; $doors = 0; $data_day = 0;
    
    if ($_POST['modelsale_id']) $modelsale_id = $_POST['modelsale_id'];
    if ($_POST['interior']) $interior = $_POST['interior'];
    if ($_POST['exterior']) $exterior = $_POST['exterior'];
    if ($_POST['doors']) $doors = $_POST['doors'];
    if ($_POST['data_day']) $data_day = $_POST['data_day'];
    /*
    $modelsale_id = 21;
    $interior = 2288;
    $exterior = 2288;
    $doors = 1026;
    $data_day = "0000-00-00 00:00:00";*/
    if ($modelsale_id == 0 || $interior == 0 || $exterior == 0 || $doors == 0 || $data_day == 0){
    
    	echo $output."Usage: ?modelsale_id=$modelsale_id&interior=$interior&exterior=$exterior&doors=$doors&data_day=$data_day<br>";
    	exit;
    }
    
    if ($modelsale_id > 0){
    
    	$sql = "select * from modelsales where modelsale_id = $modelsale_id and ebay_id is not null";
    
    	$data = $dbh->getAll($sql);
    
    	if($data){
    		echo $output.urlencode("Already on eBay. http://cgi.sandbox.ebay.com/ebaymotors/ws/eBayISAPI.dll?ViewItem&item=".$data[0]['ebay_id']);
    		exit;
    	}
    
    	$opts = array();
    	$ebay = new eBay();
    	$ebay->setId($modelsale_id, $dbh);
    
    	$item = $ebay->AddItem($opts);
    
    	$xml = simplexml_load_string($item);
    
    	if (@$xml->Item->Id) {
    
    		$id = $xml->Item->Id;
    
    		$output .= urlencode("Congratuations. Your item is listed. It has id: $id\n http://cgi.sandbox.ebay.com/ebaymotors/ws/eBayISAPI.dll?ViewItem&item=$id");
    		$output .= "&loadkey=1";
    
    		echo $output;
    
    		$sql = "update modelsales set ebay_id = '$id', ebay_end_time =  now() + interval $data_day day where modelsale_id = $modelsale_id";
    
    		$dbh->query($sql);
    
    		exit;
    	}else{
    		for($i = 0; $i<sizeof($xml->Errors->Error); $i++){
    			$output .=$xml->Errors->Error[$i]->LongMessage."\n";
    		}
    
    		echo $output;
    		exit;
    	}
    }
    
    class eBay {
    	protected $authToken;
    	protected $gatewayUrl;
    	protected $devId;
    	protected $appId;
    	protected $cert;
    	protected $debug;
    	protected $compatibilityLevel;
    	protected $modelsale_id;
    	protected $dbh;
    	
    	public function setId($id, $dbh){
    		$this->id_modelsale = $id;
    		$this->dbh= $dbh;
    	}
    
    	public function __construct($opts = array()) {
    		// Load in configuration data
    		$config = parse_ini_file('config.ini', true);
    		$site = $config['settings']['site'];
    		
    		$this->authToken = $config[$site]['authToken'];
    		$this->gatewayUrl = $config[$site]['gatewayUrl'];
    		$this->devId = $config[$site]['devId'];
    		$this->appId = $config[$site]['appId'];
    		$this->cert = $config[$site]['cert'];
    
    		$this->compatibilityLevel = (isset($opts['compatibilityLevel']) ? $opts['compatibilityLevel'] : $config['settings']['compatibilityLevel']);
    		$this->debug = (isset($opts['debug']) ? $opts['debug'] : false);
    	}
    
    	public function __call($verb = 'GetEBayOfficialTime', $args = array()) {
    		if (array_key_exists(0, $args)) {
    			$args = $args[0];
    		}
    
    		if (!isset($args['DetailLevel']))  { $args['DetailLevel']  = 0;          }
    		if (!isset($args['SiteId']))       { $args['SiteId']       = 0;          }
    
    		$request = $this->getRequest($verb, $args);
    		$headers = $this->getHeaders($verb, $args, strlen($request));
    
    		// The cURL request
    		$ch = curl_init();
    		curl_setopt($ch, CURLOPT_URL, $this->gatewayUrl);
    		curl_setopt($ch, CURLOPT_HEADER, false);
    		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    		curl_setopt($ch, CURLOPT_POST, true);
    		curl_setopt($ch, CURLOPT_POSTFIELDS, $request);
    		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    		$data = curl_exec($ch);
    		curl_close($ch);
    
    		//if ($this->debug) print htmlentities($data);
    
    		return $data;
    	}
    
    	protected function getHeaders($call, $args, $length) {
    
    		$headers = array();
    		$headers[] = "X-EBAY-API-COMPATIBILITY-LEVEL: $this->compatibilityLevel";
    		$headers[] = "X-EBAY-API-SESSION-CERTIFICATE: $this->devId;$this->appId$this->cert";
    		$headers[] = "X-EBAY-API-DEV-NAME: $this->devId";
    		$headers[] = "X-EBAY-API-APP-NAME: $this->appId";
    		$headers[] = "X-EBAY-API-CERT-NAME: $this->cert";
    		$headers[] = "X-EBAY-API-CALL-NAME: $call";
    		$headers[] = "X-EBAY-API-SITEID: 100";
    		$headers[] = "X-EBAY-API-DETAIL-LEVEL: 1";
    		$headers[] = "Content-Type: text/xml";
    		$headers[] = "Content-Length: $length";
    
    		return $headers;
    	}
    
    	protected function getRequest($verb, $args) {
    
    		global $modelsale_id, $interior, $exterior, $doors, $data_day;
    
    						     $args['Verb']         = $verb;
    		if (!isset($args['ErrorLevel']))   { $args['ErrorLevel']   = 1;          }
    		if (!isset($args['RequestToken'])) { $args['RequestToken'] = $this->authToken; }
    
    		$request  = "<?xml version=\"1.0\" encoding=\"utf-8\" ?>\n";
    
    $request .= "<request><RequestToken><![CDATA[AgAAAA**AQAAAA**aAAAAA**7JMZQw**nY+sHZ2PrBmdj6wVnY+sEZ2PrA2dj6wJnY+lCpiHowydj6x9nY+seQ**TFgAAA**AAMAAA**nskXuP163+jaM7rOuMi6kpXr3V0ajCdUVFSKjwzmwLBKaN549Sk6yj4O6UgN/ACHLsWCbR9Fkg481135zYgHIciyl3NfX4/QUyhsDsL6uM6I67t8dELl9lzLAtekA+BsuNxzACmNhMeBB+/fgEQWHkExe5RUD0MgREKFPcLkXiU6LryJ6O/x13cXxTa8N8VlOu2IbS7B16h/vFYQiquViqI6ChrluTswZowGN3yDYF+y6yT6uCXjqQEbfZi9JSeX0MlWRdKSjxaWMqfLc6G66Qt9/7YbRfe7LPafBV8Suxbn6aeipldZW5I58CarunDmZjS4W66bSg6/TbJlXu9d82VjvPUzI/OOMq9PuASdiSRb7sFFtLDp7rvx9l0TxsG6blUxO4VNNT0jfck13pyov3jm7u9fwhiwVH368cMio8UEvuezZY9DJRLQZRHnUw9Uly/6BT35HOhjNDj2FESQVK31tpCC43qr1+aBYkJA8CIFoycpS15U42+/cN0Z3un3fhNDD4gLfaAyvw+GbonB4LNrCvbZW1qmLfr16GhzXm0lRDCE+wz4/Tzevqu7Kk7ilR+nHPxA2AkAQ4SKhwOw66HqZQlVRh9Yc6w4L1PJyPCqSHKDe/VHZwXDSSP+NNc56uWyW9Ti/0iR5DyucOMbJvnyJXWf29SazVUT+azlPb+v972Z4yzkcksWDL5zO4lvnrPgxh+JvRfemb2c3vCMV6XOTNSqrfbaFwYuMIVBIjI74gWDjPtIf/KaYUOYGbZm]]></RequestToken>";
    
    //6254
    //  <Title>Super Auto! </Title>
    
    $sql = "SELECT * FROM modelsales ms, models m, makes ma WHERE ms.model_id = m.model_id and ms.modelsale_id = ".$this->id_modelsale." and m.make_id = ma.make_id";
    //echo $sql;
    $data =$this->dbh->getAll($sql);	
    
    if ($data[0]["id_ebay_category"]){
    	$ebay_category = $data[0]["id_ebay_category"];
    }else if ($data[0]["id_ebay_others_category"]){
    	$ebay_category = $data[0]["id_ebay_others_category"];
    	$model = "<Model>".$data[0]["model_name"]."</Model>";
    }else{
    	echo $output."NO EBAY CATEGORY";
    	return "";
    }
    
    $p = array();
    if ($data[0]["modelsale_pic"]){
    	$p = explode(",", $data[0]["modelsale_pic"]);
    }
    
    $pic = "http://www.e37automotive.com/upload/".$p[0];
    
    
    /*      <Attribute id=\"10734\">
            <ValueList>
              <Value id=\"-3\">
                <ValueLiteral>1</ValueLiteral>
              </Value>
            </ValueList>
          </Attribute>
          <Attribute id=\"10733\">
            <ValueList>
              <Value id=\"-3\">
                <ValueLiteral>2000</ValueLiteral>
              </Value>
            </ValueList>
          </Attribute>*/
    
    	$vin = "11111111111111111";
    	if($data[0]["modelsale_vin"]) $vin = $data[0]["modelsale_vin"];
    
    
    
    $AddItemXML = "<Category>$ebay_category</Category>
      <Country>US</Country>
      <Currency>1</Currency>
      <Description>".$data[0]["modelsale_description"]."</Description>
      <DetailLevel>1</DetailLevel>
      <Duration>$data_day</Duration>
      <ErrorLevel>1</ErrorLevel>
      <Location>San Jose, CA</Location>
      <BuyItNowPrice>".$data[0]["modelsale_price"]."</BuyItNowPrice>
      <MinimumBid>".$data[0]["modelsale_price"]."</MinimumBid>  
      <Quantity>1</Quantity>
      <Region>60</Region>
      <SiteId>100</SiteId>
      <Verb>AddItem</Verb>
    	  <Title>My Passenger Vehicle</Title>
      <BoldTitle>1</BoldTitle>
      <Highlight>1</Highlight>
      <PictureURL>$pic</PictureURL>
     <!--<ThumbnailURL>$pic</ThumbnailURL> -->
      <Featured>1</Featured>
      <GiftIcon>5</GiftIcon>  
      <Attributes>
        <AttributeSet id=\"1137\">
          <Attribute id=\"10246\">
            <ValueList>
              <Value id=\"-3\">
                <ValueLiteral>".$data[0]["make_name"]." ".$data[0]["model_name"]." ".$data[0]["submodel_name"]."</ValueLiteral>
              </Value>
            </ValueList>
          </Attribute>
    
    <!-- Inspected -->
     <!--     <Attribute id=\"10245\">
            <ValueList>
              <Value id=\"-13\">
                <ValueLiteral/>
              </Value>
            </ValueList>
          </Attribute>-->
    
    <!-- Clear | Salvage -->
          <Attribute id=\"10243\">
            <ValueList>
              <Value id=\"10448\">
                <ValueLiteral>Clear</ValueLiteral>
              </Value>
            </ValueList>
          </Attribute>
    
          <Attribute id=\"85\">
            <ValueList>
              <Value id=\"-3\">
                <ValueLiteral>".$data[0]["modelsale_mile"]."</ValueLiteral>
              </Value>
            </ValueList>
          </Attribute>
    
    <!-- Condition: New(10425)|Used(10426)-->
          <Attribute id=\"10244\">
            <ValueList>
              <Value id=\"10426\">
              </Value>
            </ValueList>
          </Attribute>
    
          <Attribute id=\"10719\">
            <ValueList>
              <Value id=\"$interior\">
                <!--<ValueLiteral>Black</ValueLiteral>-->
              </Value>
            </ValueList>
          </Attribute>
          <Attribute id=\"10720\">
            <ValueList>
              <Value id=\"$exterior\">
                <!--<ValueLiteral>Black</ValueLiteral>-->
              </Value>
            </ValueList>
          </Attribute>
    
    	<!--  Doors: 1026 - 2, 1027 - 3, 1028 - 4, -12 - 5 or more -->
          <Attribute id=\"10240\">
            <ValueList>
              <Value id=\"$doors\">
              </Value>
            </ValueList>
          </Attribute>-->
    
    	<!--  Cylinders: 1026 - 2, 1027 - 3, 1028 - 4, 1029 - 3, 1030 - 6, 1032 - 8, 1034 - 10, 1036 - 12-->
          <Attribute id=\"10718\">
            <ValueList>
              <Value id=\"1028\">
              </Value>
            </ValueList>
          </Attribute>-->
    
          <Attribute id=\"10239\">
            <ValueList>
              <Value id=\"10427\">
                <ValueLiteral/>
              </Value>
            </ValueList>
          </Attribute>
    
    
    <!-- Warrancy -->
          <!--<Attribute id=\"10242\">
            <ValueList>
              <Value id=\"10721\">
                <ValueLiteral>Existing</ValueLiteral>
              </Value>
            </ValueList>
          </Attribute>-->
    <Attribute id=\"10242\">
            <ValueList>
              <Value id=\"10722\">
              </Value>
            </ValueList>
          </Attribute>
    
          <Attribute id=\"38\">
            <ValueList>
              <Value id=\"1195\">
                <ValueLiteral>".(1984+$data[0]["year_id"])."</ValueLiteral>
              </Value>
            </ValueList>
          </Attribute>
          <Attribute id=\"10236\">
            <ValueList>
              <Value id=\"-3 \">
                <ValueLiteral>$vin</ValueLiteral>
              </Value>
            </ValueList>
          </Attribute>
    
        </AttributeSet>
      </Attributes>
    <LoanCheck>1</LoanCheck>
    <CashInPerson>1</CashInPerson>
    <PersonalCheck>1</PersonalCheck>
    <HoursToDeposit>72</HoursToDeposit>
    <DaysToFullPayment>3</DaysToFullPayment>";
    
    		
    		// Generate a Unique GUID for the UUID Parameter
    		$uuid = md5(uniqid(rand(), true));
    		$AddItemXML .= "<UUID>$uuid</UUID>";
    
    		$request .= $AddItemXML;
    
    		$request .= "</request>";
    
    //echo $request;
    		return $request;
    	}
    }
?>
