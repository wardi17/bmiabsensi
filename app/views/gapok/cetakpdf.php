<?php

class FPDF_AutoWrapTable extends FPDF {
      private $data = array();
      private $header = array();
      private $options = array(
          'filename' => '',
          'destinationfile' => '',
          'paper_size'=>'F4',
          'orientation'=>'L'
      );

    function __construct($data = array(), $options = array()) {
      
        
        parent::__construct();
        $this->data =$data;
        
        
        $this->options = $options;
    }

    public function rptDetailData () {
		
      
       
        // $DataDetail =[];
        // foreach($datauser  as $useritem){
        //    // $DataDetail[] = $useritem->Detail;
          
        // }
  
      


		
			
    
        // $judul_bulan = strtoupper($bulan_angka);
        //
        $border = 0;
        $this->AddPage();
        $this->SetAutoPageBreak(true,20);
        $this->AliasNbPages();
        $left = 10;

        //header
        
        $this->SetTitle('ABSEN');
        $this->SetFont("", "B", 10);
        $this->SetX($left); $this->Cell(0, 5, 'MASTER GAPOK PT.BMI', 0, 1,'C');
        $this->SetFont("", "", 10);
        $this->SetFont("", "", 10);
        // $this->SetX(10); $this->Cell(0, 1, '___________________________________________________________________________________________________', 0, 1,'C');
        // $this->SetX(10); $this->Cell(0, 2, '___________________________________________________________________________________________________', 0, 1,'C');
        //$this->Ln(3);
        // $this->SetFont("", "B", 10);
        // $this->SetX($left); $this->Cell(0, 10, 'ABSEN ', 0, 1,'C');
        $this->Ln(3);
        $h = 8;
        $left =20;
        $top = 80;

        #tableheader
        $this->SetFillColor(200,200,200);    
        $left = $this->GetX();
        $this->SetFont("", "B",8);
        $this->Cell(10,$h,'No',1,0,'C',true);
        $this->SetX($left += 10);$this->Cell(15,$h, 'Userid', 1, 0, 'L',true);
        $this->SetX($left += 15);$this->Cell(15,$h, 'NIK', 1, 0, 'L',true);
        $this->SetX($left += 15); $this->Cell(30,$h,'Nama' , 1, 0, 'L',true);
        $this->SetX($left += 30); $this->Cell(20,$h, 'Jabatan', 1, 0, 'L',true);
        $this->SetX($left +=20); $this->Cell(50,$h, 'Departemen Nama', 1, 0, 'L',true);
        $this->SetX($left += 50); $this->Cell(20,$h, 'Salery', 1, 0, 'R',true);
        $this->SetX($left += 20); $this->Cell(20,$h, 'Status', 1, 1, 'L',true);
        #data dari database
       $this->SetFont('Arial','',8);
        $this->SetWidths(array(10,15,15,30,20,50,20,20));
        $this->SetAligns(array('C','L','L','L','L','L','R','L'));
    
            $no = 1; $this->SetFillColor(255);
			$totalsaley =0;
			$totalgapok =0;
			$totallembur =0;
			$totalditerima =0;
           foreach($this->data as $key=>$value){
              
               // print_r($value->userid);die();
                $this->Row(

                    array(
                       $no++, 
                      $value->userid,
                      $value->NIK,
                      $value->name,
                      $value->title,
                      $value->departemenName,
                      $value->saleri,
                      $value->status,

                    )
                );
				
				$str_rip = str_replace(",","",$value->saleri);
                $totalsaley +=(float)$str_rip;
				/*	
					
					$str_gapok = str_replace(",","",$value->gapok);
					$str_gjlembur = str_replace(",","",$value->gaji_lembur);
					$str_gjterima = str_replace(",","",$value->gajihditerima);
					
					
					$totalgapok +=(float)$str_gapok;
					$totallembur +=(float)$str_gjlembur;
					$totalditerima +=(float)$str_gjterima;*/
            }
			$label = "Total : ";
			$setsaley = $this->getformatnumer($totalsaley);
            $this->SetX(140);$this->Cell(20,$h,$label,0, 0, 'L',true);
		    $this->SetX(150);$this->Cell(20,$h,$setsaley, 1, 1, 'R',true);
            /*
			$setgapok = $this->getformatnumer($totalgapok);
			$setgjlembur = $this->getformatnumer($totallembur);
			$setgjterima = $this->getformatnumer($totalditerima);
			
			
		
			$this->SetX(144);$this->Cell(20,$h,$setgapok, 1, 0, 'R',true);
			$this->SetX(144+20);$this->Cell(20,$h,$setgjlembur, 1, 0, 'R',true);
			$this->SetX(164+20);$this->Cell(20,$h,$setgjterima, 1, 1, 'R',true);
			//$this->SetX($left += 20);$this->Cell(20,$h,$setsaley, 1, 1, 'R',true);
		*/
            
       
    }
	
		protected function getformatnumer($data){
		$format =number_format($data,0,",",",");
		return $format;
	}
	
	
    public function printPDF () {

        if ($this->options['paper_size'] == "A4") {
            $a = 8.3 * 72; //1 inch = 72 pt
            $b = 13.0 * 72;
             new FPDF($this->options['orientation'], "pt", array($a,$b));
          
        } else {
            $this->FPDF($this->options['orientation'], "pt", $this->options['paper_size']);
        }

        $this->SetAutoPageBreak(false);
        $this->AliasNbPages();
        $this->SetFont("helvetica", "B", 10);
        //$this->AddPage();

        $this->rptDetailData();
        $this->Output($this->options['filename'],$this->options['destinationfile']);
      }

    private $widths;
    private $aligns;

    function SetWidths($w)
    {
        //Set the array of column widths
        $this->widths=$w;
    }

    function SetAligns($a)
    {
        //Set the array of column alignments
        $this->aligns=$a;
    }

    function Row($data)
    {
      
        //Calculate the height of the row
        $nb=0;
        for($i=0;$i<count($data);$i++)
        $nb=max($nb,$this->NbLines($this->widths[$i],$data[$i]));
       
        $h=6*$nb;

        //Issue a page break first if needed
        $this->CheckPageBreak($h);

        //Draw the cells of the row
        for($i=0;$i<count($data);$i++)
        {
            $w=$this->widths[$i];
            $a=isset($this->aligns[$i]) ? $this->aligns[$i] : 'L';

            //Save the current position
            $x=$this->GetX();
            $y=$this->GetY();

            //Draw the border
            $this->Rect($x,$y,$w,$h);

            //Print the text
            $this->MultiCell($w,6,$data[$i],0,$a);

            //Put the position to the right of the cell
            $this->SetXY($x+$w,$y);
        }

        //Go to the next line
        $this->Ln($h);
    }

    function CheckPageBreak($h)
    {
        //If the height h would cause an overflow, add a new page immediately
        if($this->GetY()+$h>$this->PageBreakTrigger)
        $this->AddPage($this->CurOrientation);
    }

    function NbLines($w,$txt)
    {
        //Computes the number of lines a MultiCell of width w will take
        $cw=&$this->CurrentFont['cw'];
        if($w==0)
            $w=$this->w-$this->rMargin-$this->x;
        $wmax=($w-2*$this->cMargin)*1000/$this->FontSize;
        $s=str_replace("\r",'',$txt);
        $nb=strlen($s);
        if($nb>0 and $s[$nb-1]=="\n")
            $nb--;
        $sep=-1;
        $i=0;
        $j=0;
        $l=0;
        $nl=1;

        while($i<$nb)
        {
            $c=$s[$i];
            if($c=="\n")
            {
                $i++;
                $sep=-1;
                $j=$i;
                $l=0;
                $nl++;
                continue;
            }
            if($c==' ')
                $sep=$i;
            $l+=$cw[$c];
            if($l>$wmax)
            {
                if($sep==-1)
                {
                    if($i==$j)
                        $i++;
                }
                else
                    $i=$sep+1;
                $sep=-1;
                $j=$i;
                $l=0;
                $nl++;
            }
            else
                $i++;
        }
        return $nl;
    }


   private function rubahbulan($bulanInggris) {
        $bulan = array(
            'January' => 'Januari',
            'February' => 'Februari',
            'March' => 'Maret',
            'April' => 'April',
            'May' => 'Mei',
            'June' => 'Juni',
            'July' => 'Juli',
            'August' => 'Agustus',
            'September' => 'September',
            'October' => 'Oktober',
            'November' => 'November',
            'December' => 'Desember'
        );
    
        return $bulan[$bulanInggris];
    }


    private function rubahbulanangka($bulan){
        Switch ($bulan){
            case 1 : $bulan="Januari";
                Break;
            case 2 : $bulan="Februari";
                Break;
            case 3 : $bulan="Maret";
                Break;
            case 4 : $bulan="April";
                Break;
            case 5 : $bulan="Mei";
                Break;
            case 6 : $bulan="Juni";
                Break;
            case 7 : $bulan="Juli";
                Break;
            case 8 : $bulan="Agustus";
                Break;
            case 9 : $bulan="September";
                Break;
            case 10 : $bulan="Oktober";
                Break;
            case 11 : $bulan="November";
                Break;
            case 12 : $bulan="Desember";
                Break;
            }

          return $bulan;
    }
} //end of class

#ambil data dari DB dan masukkan ke array


//pilihan
$options = array(
    'filename' => '', //nama file penyimpanan, kosongkan jika output ke browser
    'destinationfile' => '', //I=inline browser (default), F=local file, D=download
    'paper_size'=>'A4',    //paper size: F4, A3, A4, A5, Letter, Legal
    'orientation'=>'P' //orientation: P=portrait, L=landscape
);

$tabel = new FPDF_AutoWrapTable($data, $options);

$tabel->printPDF();
?>

