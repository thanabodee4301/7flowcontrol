<?

class Jsonhostdata extends CI_Controller {

	function index(){
		header('Access-Control-Allow-Origin: *');
		header('Content-Type: application/json; charset=utf-8 ');

	$json='{"hostdata": [';
$sqlqhost="
 SELECT * FROM erp_website 
WHERE 
(importnewhost  !=1 OR importnewhost IS NULL)
 AND
web_status_id=22
";
		$qhost=$this->db->query($sqlqhost);
		$numrow=$qhost->num_rows();
		$r=1;
		$bDesign=0;
		foreach($qhost->result_array() as $host){

			$sqlcus="SELECT c.*,ol.product_id
							FROM 
							erp_website w,
							erp_orders_list ol,
							erp_orders o,
							erp_customer_contact ct,
							erp_customer c
							WHERE 
							w.orders_list_id=ol.id AND
							ol.orders_id=o.id AND
							o.customer_contact_id=ct.id AND
							ct.customer_id=c.id AND 
							w.id=".$host['id'];
			$qcus=$this->db->query($sqlcus);
			$mycus=$qcus->row_array();
			$ad1=$mycus['address'];
			$addr = str_replace("\n", "", $ad1);
			$addr = str_replace("\r", "", $addr);
			$addr = str_replace("\t", "", $addr);

			$cusname=$mycus['companyname'];
			$cusname = str_replace("\n", "", $cusname);
			$cusname = str_replace("\r", "", $cusname);
			$cusname = str_replace("\t", "", $cusname);

			

			$webname	=substr($host['websitename'],4,strlen($host['websitename']));
			$XNname	=substr($host['XNname'],4,strlen($host['XNname']));

			$websitename=preg_replace('/\s+/', '', $webname);
			$XNname		=preg_replace('/\s+/', '', $XNname);
			$PASATHA	=preg_replace('/\s+/', '', $XNname);
			
			if(empty($host['package_order_list'])){
				$bDesign=0;
			}else{
				$bDesign=1;
			}

			$json.='{
									"website_id"			: "'.$host['id'].'",
									"websitename"		: "'.$websitename.'",
									"XNname"				: "'.$XNname.'",
									"PASATHA"			:"'.$PASATHA.'",
									"ftpuser"					: "'.$host['ftpuser'].'",
									"ftppassword"			: "'.$host['ftppassword'].'",
									"DBname"				: "'.$host['DBname'].'",
									"DBuser"					: "'.$host['DBuser'].'",
									"DBpassword"		: "'.$host['DBpassword'].'",
									"ftppath"					: "'.$host['ftppath'].'",
									"sys_username"		: "'.$host['sys_username'].'",
									"sys_password"		: "'.md5($host['sys_password']).'",
									"email"						: "'.$host['email'].'",
									"host_id"					: "'.$host['host_id'].'",
									"CustomerName"	: "'.trim(preg_replace('/^([\'"])(.*)\\1$/', '\_',addslashes ($cusname))).'",
									"address"				: "'.trim(preg_replace('/^([\'"])(.*)\\1$/', '\\2', addslashes($addr))).'",
									"Telephone"			:"'.trim($mycus['tel']).'",
									"Fax"						:"'.trim($mycus['fax']).'",
									"Email"					:"'.trim($mycus['email']).'",
									"customer_id"			: "'.$mycus['id'].'",
									"RegistrationNo"		:"'.$mycus['RegistrationNo'].'",
									"ExpirationDate"		:"'.date("Y-m-d",strtotime($host['host_expired_date'])).'",
									"success_date"		: "'.$host['success_date'].'",
									"ecommerch"			: "'.$host['ecommerch'].'",
									"sub_domain"			: "'.$host['sub_domain'].'",
									"openweb"				: "'.$host['openweb'].'",
									"bDesign"               : "'.$bDesign.'",
									"product_id"            : "'.$mycus['product_id'].'"

					}';
					if($r!=$numrow){
						$json.=',';
					}else{
						$json.='';
					}

					$r++;
		}
$json.=']}';
echo $json;

	}
	function updatehostcreate(){
		header('Access-Control-Allow-Origin: *');
		header('Access-Control-Allow-Headers:Content-Type, Accept, MaxDataServiceVersion ');
		header('Content-Type: application/json; charset=utf-8 ');
			$request_body = file_get_contents('php://input');
			$data = json_decode($request_body);
		//var_dump($this->input->ip_address());
		if($data->token=='b42ec87ec4eaadc1449584c164ae7ff5'){
			$website_id=$this->input->post('website_id');
			$updaarr=array('importnewhost'=>1);
			$this->db->where('id',$data->website_id);
			$upstat=$this->db->update('erp_website',$updaarr);
			if($upstat){
				echo '{"stat":"success"}';
			}else{
				echo '{"stat":"unsuccess"}';
			}
		}else{
			echo '{"stat":"'.$data->website_id.'"}';
		}
	}
	function changstaterpwebsite(){
		header('Access-Control-Allow-Origin: *');
		header('Access-Control-Allow-Headers:Content-Type, Accept, MaxDataServiceVersion ');
		header('Content-Type: application/json; charset=utf-8 ');
		$request_body = file_get_contents('php://input');
		$data = json_decode($request_body);
		//var_dump($this->input->ip_address());
		if($data->token=='b42ec87ec4eaadc1449584c164ae7ff5'){			
	

			$website_id=$this->input->post('website_id');
			$updaarr=array('web_status_id'=>3);
			$this->db->where('id',$data->website_id);
			$upstat=$this->db->update('erp_website',$updaarr);
			if($upstat){
				echo '{"stat":"success"}';
			}else{
				echo '{"stat":"unsuccess"}';
			}
		}else{
			echo '{"stat":"'.$data->website_id.'"}';
		}
	}

}
?>