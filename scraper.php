<?
// This is a template for a PHP scraper on morph.io (https://morph.io)
// including some code snippets below that you should find helpful
//  https://e.fbr.gov.pk/Registration/searchDetail.aspx?rand=0.6987121410114072&crup=6299999
require 'scraperwiki.php';
require 'scraperwiki/simple_html_dom.php';
ini_set('memory_limit', '-1');
$cHeadres = array(
      'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8',
      'Accept-Language: en-US,en;q=0.5',
      'Connection: Keep-Alive',
      'Pragma: no-cache',
      'Cache-Control: no-cache'
     );
     function dlPage($link) {
        global $cHeadres;
        $ch = curl_init();
        if($ch){
         curl_setopt($ch, CURLOPT_URL, $link);
         curl_setopt($ch, CURLOPT_HTTPHEADER, $cHeadres);
         curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
         curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
         curl_setopt($ch, CURLOPT_COOKIEFILE, 'cookies.txt');
         curl_setopt($ch, CURLOPT_COOKIEJAR, 'cookies.txt');
         curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
         curl_setopt($ch, CURLOPT_HEADER, false);
         curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
         curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (compatible; Googlebot/2.1; +http://www.google.com/bot.html)");
         $str = curl_exec($ch);
         curl_close($ch);
         $dom = new simple_html_dom();
         $dom->load($str);
         return $dom;
        }
       }
//Main Code Start Here.
//Total Pages in that site is 4995153
for($page = 5995000;$page <6326776; $page++)
 {
	
	
      $link ='https://e.fbr.gov.pk/Registration/searchDetail.aspx?crup='.$page;
      $maincode = dlPage($link);
	if($maincode)
	{
      sleep(4);
      $ntn              = $maincode->find("//*[@id='lblSRNTN']",0)->plaintext;
      $name             = $maincode->find("//*[@id='lblSRName']",0)->plaintext;
      $cnic_reg         = $maincode->find("//*[@id='lblCNICRegIncPP']",0)->plaintext;
      $house_flat       = $maincode->find("//*[@id='lblAddress1']",0)->plaintext;
      $street_lane      = $maincode->find("//*[@id='lblAddress2']",0)->plaintext;
      $sec_block_road   = $maincode->find("//*[@id='lblAddress3']",0)->plaintext;
      $city             = $maincode->find("//*[@id='lblCity']",0)->plaintext;
      echo "$link\n";
	
	
	
	
      $record = array( 'ntn' =>trim($ntn), 
		   'name' => trim($name),
		   'cnic_reg' => trim($cnic_reg), 
		   'house_flat' => trim($house_flat), 
		   'street_lane' => trim($street_lane), 
		   'sec_block_road' => trim($sec_block_road), 
		   'city' => trim($city), 
		   'link' =>  trim($link)
		   );
				
       scraperwiki::save(array('ntn','name','cnic_reg','house_flat','street_lane','sec_block_road','city','link'), $record);
     	unset($maincode);
	unset($ntn);
	unset($name);
	unset($cnic_reg);
	unset($house_flat);
	unset($street_lane);
	unset($sec_block_road);
	unset($city);
	unset($link);
				
	}
      
 }
?>
