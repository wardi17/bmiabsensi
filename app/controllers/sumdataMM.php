<?php

class sumdataMM extends Controller {
	public $db;
	public function index()
	{
		
		$data['page'] = "sum";
		$this->view('templates/header');
		$this->view('templates/sidebar', $data);
		$this->view('sumdatamm/index');
		$this->view('templates/footer');
	
	}

	public function __construct()
	{
		$this->db = new Database;
	}
	

	 public function Kirimdata(){
		$from  = $_POST["tgl_from"];
		$to  = $_POST["tgl_to"];
	
		$query ="select  DISTINCT  b.partid
		from dotransaction a, dotransactiondetail b, sotransaction c
		where a.flagposting = 'Y' and a.flagpostinginv = 'Y'  and divisi='MM' and a.dodate >= '".$from."' and a.dodate <= '".$to."' 
		and a.dotransacid = b.dotransacid and a.sotransacid = c.sotransacid order by partid  ";
		

		$result = $this->db->baca_sql2($query);

        $data =[];
        while(odbc_fetch_row($result)){
            $data[] = array(
                "partid"=>$this->subts(rtrim(odbc_result($result,'partid'))),
				
            );
            }

		
			$fulldata =[];
		foreach ($data as $item){
			$fulldata[] =[
				"partid"=>$item["partid"],
				"QtyDelSentul"=>$this->SetQty($from,$to,$item["partid"]),
			];
			
		}

		die(var_dump($fulldata));
		if(empty($data)){
            $data = null;
            echo json_encode($data);
        }else{
            echo json_encode($data);
        }

	 }


	 private function subts($partid){

		$expolod = explode("-",$partid);
		
		$partineew = $expolod[0];
		
		return $partineew;
	 }


	 private function SetQty($from,$to,$partid){
		
		$query ="SP_Rubah_partid  '".$from."','".$to."','".$partid."'";
	
		$result = $this->db->baca_sql3($query);
		$qty=odbc_result($result,"qty");

		return $qty;

	 }
}