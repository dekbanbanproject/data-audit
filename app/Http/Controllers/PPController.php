<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\support\Facades\Hash;
use Illuminate\support\Facades\Validator;
use App\Models\User;
// use App\Models\m_registerdata;
// use PDF;
// use setasign\Fpdi\Fpdi;
// use App\Models\Budget_year;
use Illuminate\Support\Facades\File;
use DataTables;
// use Intervention\Image\ImageManagerStatic as Image;
// use Rector\Config\RectorConfig;
// use Rector\PHPOffice\Set\PHPOfficeSetList;
// use PhpOffice\PhpSpreadsheet\Spreadsheet;
// use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
// use PHPExcel_IOFactory;
// use App\Models\Stm_head;
// use App\Models\Stm_import;
 
class PPController extends Controller
{    
    public function welcome(Request $request)
    {  
        $datestart = $request->startdate;
        $dateend = $request->enddate;
        $pp_data = DB::connection('mysql')->select('   
                select 
                    p.cid,pt.hn,concat(p.pname,p.fname," ",p.lname) as ptname
                    ,thaiage(p.birthdate,now()) as age
                    ,p.pttype,t.name pttype_name
                    ,p.house_regist_type_id typearea,h.address
                    ,v.village_moo moo,v.village_name
                    ,group_concat(distinct if(n.nhso_adp_code="12001",n.nhso_adp_code,null) order by o.vstdate desc) Code
                    ,group_concat(distinct if(n.nhso_adp_code="12001",ce2be(o.vstdate),null) order by o.vstdate desc) Vstdate
                    ,pt.hometel
                
                    from person p
                    left join patient pt on pt.cid=p.cid
                    left join pttype t on t.pttype=p.pttype
                    LEFT JOIN village v on v.village_id=p.village_id
                    LEFT JOIN house h on h.house_id=p.house_id
                    left join ovst o on p.patient_hn=o.hn and o.vstdate BETWEEN "'.$datestart.'" AND "'.$dateend.'"  
                    left join opitemrece r on r.vn=o.vn 
                    left join nondrugitems n on n.icode=r.icode and n.nhso_adp_code="12001"
                    where p.nationality="99" and TIMESTAMPDIFF(YEAR,p.birthdate,now()) BETWEEN 15 and 34
                    and v.village_moo<>0 and p.person_discharge_id=9
                    group by p.person_id
                    order by v.village_moo ,p.house_regist_type_id;
                ');  
                // left join ovst o on p.patient_hn=o.hn and o.vstdate BETWEEN "'.$datestart.'" AND "'.$dateend.'" 
        return view('pp.dashboard',[
            'pp_data'  =>  $pp_data,
            'start'    => $datestart,
            'end'      => $dateend,
        ]);
    }
    public function ppfifyear(Request $request)
    {  
        $datestart = $request->startdate;
        $dateend = $request->enddate;
        // dd($datestart);
        $pp_data = DB::connection('mysql')->select('   
                select 
                    p.cid,pt.hn,concat(p.pname,p.fname," ",p.lname) as ptname
                    ,thaiage(p.birthdate,now()) as age
                    ,p.pttype,t.name pttype_name
                    ,p.house_regist_type_id typearea,h.address
                    ,v.village_moo moo,v.village_name
                    ,group_concat(distinct if(n.nhso_adp_code="12001",n.nhso_adp_code,null) order by o.vstdate desc) Code
                    ,group_concat(distinct if(n.nhso_adp_code="12001",ce2be(o.vstdate),null) order by o.vstdate desc) Vstdate
                    ,pt.hometel
                
                    from person p
                    left join patient pt on pt.cid=p.cid
                    left join pttype t on t.pttype=p.pttype
                    LEFT JOIN village v on v.village_id=p.village_id
                    LEFT JOIN house h on h.house_id=p.house_id
                    left join ovst o on p.patient_hn=o.hn   
                    left join opitemrece r on r.vn=o.vn 
                    left join nondrugitems n on n.icode=r.icode and n.nhso_adp_code="12001"
                    where o.vstdate BETWEEN "'.$datestart.'" AND "'.$dateend.'"  
                    and p.nationality="99" and TIMESTAMPDIFF(YEAR,p.birthdate,now()) BETWEEN 15 and 34
                    and v.village_moo<>0 and p.person_discharge_id=9
                    group by p.person_id
                    order by v.village_moo ,p.house_regist_type_id;
                '); 
                // left join ovst o on p.patient_hn=o.hn and o.vstdate BETWEEN "'.$datestart.'" AND "'.$dateend.'"  
        
        return view('pp.p1534year',[
            'pp_data'  =>  $pp_data,
            'start'    => $datestart,
            'end'      => $dateend,
        ]);
    }
    // public function import_stm_save(Request $request)
    // { 

    //             $tar_file = $request->file_;
    //             // $file = Input::file('file_')->getClientOriginalName();
    //             $file = $request->file('file_')->getClientOriginalName();

    //             $filename = pathinfo($file, PATHINFO_FILENAME);
    //             $extension = pathinfo($file, PATHINFO_EXTENSION);
    //             // if ($request->hasfile('file_')) {
    //                 // $file = $request->file('file_');
    //                 // $extention = $file->getClientOriginalExtension();
    //                 // $name = $file->originalName();
    //             $tar_file = "/Export_Claim/stm/".$file;
    //             // foreach ($file as $key => $i) {
    //             //     $name = $i->originalName;
    //             // }
                    
    //                 // dd($extension);

    //             $xmlString = file_get_contents(public_path($tar_file));
    //             $xmlObject = simplexml_load_string($xmlString);
    //             $json = json_encode($xmlObject);
    //             // $json = json_encode($file);
    //             $result = json_decode($json, true); 
           
    //             // dd($result);
    //             @$stmAccountID = $result['stmAccountID'];
    //             @$hcode = $result['hcode'];
    //             @$hname = $result['hname'];
    //             @$AccPeriod = $result['AccPeriod'];
    //             @$STMdoc = $result['STMdoc']; //ชื่อไฟล์
    //             @$dateStart = $result['dateStart']; //"5  ธันวาคม  2565"
    //             @$dateEnd = $result['dateEnd'];  //"18  ธันวาคม  2565"
    //             @$dateData = $result['dateData'];  //"3  มกราคม  2566"
    //             @$dateIssue = $result['dateIssue'];  //"4  มกราคม  2566"
    //             @$acount = $result['acount'];  //"102"
    //             @$amount = $result['amount'];  //"192100.0000"
    //             @$thamount = $result['thamount'];  // "หนึ่งแสนเก้าหมื่นสองพันหนึ่งร้อยบาทถ้วน"
               
    //             @$STMdat = $result['STMdat'];  // array
    //             @$HDBills = $result['HDBills'];  // array
    //             @$Remarks = $result['Remarks'];  // array
    //             @$config = $result['config'];  // array
                
    //             $dates = date('Y-m-d H:m:s');
    //             Stm_head::insert([                        
    //                 'stmAccountID'       => $stmAccountID, 
    //                 'hcode'              => $hcode,
    //                 'hname'              => $hname,
    //                 'AccPeriod'          => $AccPeriod,
    //                 'STMdoc'             => $STMdoc.'.'.$extension,
    //                 'dateStart'          => $dateStart,
    //                 'dateEnd'            => $dateEnd,
    //                 'dateData'           => $dateData,
    //                 'dateIssue'          => $dateIssue,
    //                 'acount'             => $acount,
    //                 'amount'             => $amount,
    //                 'thamount'           => $thamount,
    //                 'created_at'         => $dates
    //             ]);
                
    //             // dd($hcode);
                
    //                 $hd_bills        = @$HDBills;
    //                 // dd($hd_bills);
                   
    //                 foreach ($hd_bills as $key => $value2) {
    //                     foreach ($value2 as $v) {
    //                         $hreg = $v["hreg"];
    //                         $hn = $v["hn"];
    //                         $name = $v["name"];
    //                         $pid = $v["pid"];
    //                         $wkno = $v["wkno"];
    //                         $hds = $v["hds"];
    //                         $quota = $v["quota"];
    //                         $hdcharge = $v["hdcharge"];
    //                         $payable = $v["payable"];
    //                         $outstanding = $v["outstanding"];

    //                         $effHDs = $v['EPO']['effHDs'];     //EPO  
    //                         $effHCT = $v['EPO']['effHCT'];     //EPO   
    //                         $epoPay = $v['EPO']['epoPay'];     //EPO  
    //                         $epoAdm = $v['EPO']['effHDs'];     //EPO 

    //                         $tbil = $v['TBill'];     //TBill 
    //                         // dd($tbil );
    //                         foreach ($tbil as $key => $item) { 
    //                                 $hcode = $item["hcode"];
    //                                 $station = $item["station"];
    //                                 $wkno = $item['wkno'];
    //                                 $hreg = $item['hreg'];
    //                                 // $hn = $item['hn'];
    //                                 $invno = $item['invno'];
    //                                 $dttran = $item['dttran'];
                                  
    //                                 $ex_dttran = explode("T",$item['dttran']);
    //                                 $dttran1 = $ex_dttran[0];
    //                                 $dttran2 = $ex_dttran[1];
    //                                 // $y = date("Y")+543;
    //                                 $ye = date('Y',strtotime($dttran1))+543;
    //                                 $y = substr($ye, -2);
    //                                 $m = date('m',strtotime($dttran1));
    //                                 $d = date('d',strtotime($dttran1));
    //                                 $dttran_1 =  $y.''.$m.''.$d;
    //                                 // dd($d);
    //                                 // $sss_date_now = date("Y-m-d");
    //                                 $time_now = date("H:i:s");
    //                                  #ตัดขีด, ตัด : ออก
    //                                 $pattern_date = '/-/i';
    //                                 $aipn_date_now_preg = preg_replace($pattern_date, '', $dttran1);
    //                                 $pattern_time = '/:/i';
    //                                 $aipn_time_now_preg = preg_replace($pattern_time, '', $dttran2);
    //                                 #ตัดขีด, ตัด : ออก

    //                                 // $year = substr(date("Y"),2) +43;
    //                                 // $mounts = date('m');
    //                                 // $day = date('d');
    //                                 // $time = date("His");  
    //                                 // $vn = $year.''.$mounts.''.$day.''.$time;


    //                                 $hdrate = $item['hdrate'];
    //                                 $hdcharge2 = $item['hdcharge'];
    //                                 $amount = $item['amount'];
    //                                 $paid = $item['paid'];
    //                                 $rid = $item['rid'];
    //                                 $accp = $item['accp'];
    //                             // dd($invno);
    //                         }
    //                         $maxid = Stm_head::max('stm_head_id');
    //                         Stm_import::insert([                        
    //                             'stm_head_id'        => $maxid, 
    //                             'hreg'               => $hreg,
    //                             'hn'                 => $hn,
    //                             'name'               => $name,
    //                             'pid'                => $pid,
    //                             'wkno'               => $wkno,
    //                             'hds'                => $hds,
    //                             'quota'              => $quota,
    //                             'hdcharge'           => $hdcharge,
    //                             'payable'            => $payable,
    //                             'outstanding'        => $outstanding ,                                
    //                             'effHDs'             => $effHDs,
    //                             'effHCT'             => $effHCT,
    //                             'epoPay'             => $epoPay,
    //                             'epoAdm'             => $epoAdm,
    //                             'invno'              => $invno,

    //                             'vn'             => $dttran_1,
    //                             // 'dttran'             => $dttran1.''.$dttran2,

    //                             'dttran'             => $dttran1,

    //                             'hcode'              => $hcode,
    //                             'station'            => $station,
    //                             'hdrate'             => $hdrate,
    //                             'tbill_hdcharge'     => $hdcharge2,
    //                             'amount'               => $amount,
    //                             'paid'               => $paid,
    //                             'rid'                => $rid,
    //                             'accp'               => $accp,
    //                             'created_at'         => $dates
    //                         ]);                            
    //                         // dd($effHDs );
    //                     }
    //                 }

              
    //                 // $tbill_data = $value2[0]['TBill']; 
    //                 // dd($tbill_data );
    //                 //     foreach ($tbill_data as $key => $val) {
    //                         // foreach ($val as $bt) {
    //                             // $hcode = $bt["hcode"];
    //                             // $station = $bt["station"];
    //                             // $wkno = $bt['wkno'];
    //                             // $hreg = $bt['hreg'];
    //                             // $hn = $bt['hn'];
    //                             // $invno = $bt['invno'];
    //                             // $dttran = $bt['dttran'];
    //                             // $hdrate = $bt['hdrate'];
    //                             // $hdcharge = $bt['hdcharge'];
    //                             // $amount = $bt['amount'];
    //                             // $paid = $bt['paid'];
    //                             // $rid = $bt['rid'];
    //                             // $accp = $bt['accp'];
    
    //                             // $EPOiu = $v['EPOs']['EPOiu'];//EPOs  
    //                             // $LN = $v['EPOs']['LN'];//EPOs 
    //                             // $iu = $v['EPOs']['iu'];//EPOs 
    //                             // $item = $v['EPOs']['item'];//EPOs 
    //                             // $epoPay = $v['EPOs']['epoPay'];//EPOs 
    //                             // $epoclaim = $v['EPOs']['epoclaim'];//EPOs 
    //                             // Stm_import::insert([                        
    //                             //     'stm_head_id'        => $maxid, 
    //                             //     'hreg'               => $hreg,
    //                             //     'hn'                 => $hn,
    //                             //     'name'               => $name,
    //                             //     'pid'                => $pid,
    //                             //     'wkno'               => $wkno,
    //                             //     'hds'                => $hds,
    //                             //     'quota'              => $quota,
    //                             //     'hdcharge'           => $hdcharge,
    //                             //     'payable'            => $payable,
    //                             //     'outstanding'        => $outstanding ,                                
    //                             //     'effHDs'             => $effHDs,
    //                             //     'effHCT'             => $effHCT,
    //                             //     'epoPay'             => $epoPay,
    //                             //     'epoAdm'             => $epoAdm
    //                             // ]);      
    //                         // }
    //                         // $hcode = $val['hcode'];
    //                         // $station = $val['station'];
                            
    //                     // }





    //                     // $array_hdbills["hreg"] = $value2[$i++]["hreg"];
    //                     // $array_hdbills["hn"] = $value2[$i]["hn"];
    //                     // $array_hdbills["name"] = $value2[$i]["name"];
    //                     // $array_hdbills["pid"] = $value2[$i]["pid"];
    //                     // $array_hdbills["wkno"] = $value2[$i]["wkno"];
    //                     // $array_hdbills["hds"] = $value2[$i]["hds"];
    //                     // $array_hdbills["quota"] = $value2[$i]["quota"];
    //                     // $array_hdbills["hdcharge"] = $value2[$i]["hdcharge"];
    //                     // $array_hdbills["payable"] = $value2[$i]["payable"];
    //                     // $array_hdbills["outstanding"] = $value2[$i]["outstanding"]; 
    //                     // $i++;

    //                     // dd( $array_hdbills["pid"]);
    //                     // $hreg =  $value2[$i]["hreg"]; 
    //                     // $hn = $value2[$i]["hn"]; 
    //                     // $name = $value2[$i]["name"]; 
    //                     // $pid = $value2[$i]["pid"]; 
    //                     // $wkno = $value2[$i]["wkno"]; 
    //                     // $hds = $value2[$i]["hds"]; 
    //                     // $quota = $value2[$i]["quota"]; 
    //                     // $hdcharge =  $value2[$i]["hdcharge"] ; 
    //                     // $payable = $value2[$i]["payable"]; 
    //                     // $outstanding = $value2[$i]["outstanding"]; 
 
    //                     // $hreg = $value2[0]['hreg']; 
    //                     // $hn = $value2[0]['hn']; 
    //                     // $name = $value2[0]['name']; 
    //                     // $pid = $value2[0]['pid']; 
    //                     // $wkno = $value2[0]['wkno']; 
    //                     // $hds = $value2[0]['hds']; 
    //                     // $quota = $value2[0]['quota']; 
    //                     // $hdcharge = $value2[0]['hdcharge']; 
    //                     // $payable = $value2[0]['payable']; 
    //                     // $outstanding = $value2[0]['outstanding']; 

    //                     // $effHDs = $value2[0]['EPO']['effHDs'];     //EPO   
    //                     // $effHCT = $value2[0]['EPO']['effHCT'];     //EPO
    //                     // $epoPay = $value2[0]['EPO']['epoPay'];     //EPO
    //                     // $epoAdm = $value2[0]['EPO']['epoAdm'];     //EPO    
    //                     // dd($epoPay);

                        

    //                     // Stm_import::insert([                        
    //                     //     'stm_head_id'        => '', 
    //                     //     'hreg'               =>   $hreg,
    //                         // 'hn'                 => $hn,
    //                         // 'name'               => $name,
    //                         // 'pid'                => $pid,
    //                         // 'wkno'               => $wkno,
    //                         // 'hds'                => $hds,
    //                         // 'quota'              => $quota,
    //                         // 'hdcharge'           => $hdcharge,
    //                         // 'payable'            => $payable,
    //                         // 'outstanding'        => $outstanding ,
                            
    //                         // 'effHDs'             => $effHDs,
    //                         // 'effHCT'             => $effHCT,
    //                         // 'epoPay'             => $epoPay,
    //                         // 'epoAdm'             => $epoAdm
    //                     // ]);





    //                 // }
               
                     
                  
    //             // dd($hd_bills);
    //             // dd($TBill);
    //             // dd($EPO);
    //             // dd($invno);
    //     //    }
    //     // return view('telemed.import_stm');
    //     return redirect()->back();
    // }
}

