<?php

namespace App\Http\Controllers;

use App\TNAsk;
use App\TNBodyPart;
use App\TNBook;
use App\TNBookPage;
use App\TNCheck;
use App\TNCity;
use App\TNDepartment;
use App\TNDisease;
use App\TNDrugStore;
use App\TNFactory;
use App\TNFood;
use App\TNHostpital;
use App\TNLore;
use App\TNMedicine;
use App\TNMedicineCode;
use App\TNMedicineNumber;
use App\TNOperation;
use App\TNRecipe;
use App\TNSymptom;
use Illuminate\Http\Request;
use \GuzzleHttp\Client;
use \GuzzleHttp\get;
use \GuzzleHttp\Psr7;
use Illuminate\Support\Facades\Response;
use League\Flysystem\Exception;


class UtilController extends Controller
{
    /**
     * UtilController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth', ['only'=>['index']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('util.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function getHostpitals() {
        $hospitals = 29650;//9777;
//        $hospital = 9778;
        $client = new Client();
        for($hospital=1; $hospital<= $hospitals; $hospital++) {
            $url = "http://www.tngou.net/api/hospital/show?id=".$hospital;
            $res = $client->request('GET', $url);
            $result = \GuzzleHttp\json_decode($res->getBody(), true);
            TNHostpital::create($result);
        }
//        $citys = 396;
//        $city = 2;
//        $rows = 100;
////        $results = array();
//
//        for($city = 2; $city <= $citys; $city++) {
//            $page = 1;
//            $url = "http://www.tngou.net/api/hospital/list?id=".$city."&rows=".$rows."&page=".$page;
//            $client = new Client();
//            $res = $client->request('GET', $url);
//            $result = \GuzzleHttp\json_decode($res->getBody(), true);
//            $total = $result['total'];
////        echo ceil($total/$rows);//$total;
////            $results = array_merge($results, $result['tngou']);
//            foreach($result['tngou'] as $hospital) {
//                TNHostpital::create($hospital);
//            }
//
//            if($total > $rows) {
//                for($page=2; $page<= ceil($total/$rows); $page++) {
//                    $url = "http://www.tngou.net/api/hospital/list?id=".$city."&rows=".$rows."&page=".$page;
//                    $res = $client->request('GET', $url);
//                    $result = \GuzzleHttp\json_decode($res->getBody(), true);
////                    $results = array_merge($results, $result['tngou']);
//                    foreach($result['tngou'] as $hospital) {
//                        TNHostpital::create($hospital);
//                    }
//                }
//            }
//        }
        echo 'finished';

//        $response = get($url);
//        $stream = Psr7\stream_for($res->getBody());
//        echo $res->getBody()->getContents();
//        return $results;
    }

    public function getMedicines() {
        $medicines = 12376;
        $client = new Client();
        for($medicine=7085; $medicine<= $medicines; $medicine++) {
            $url = "http://www.tngou.net/api/drug/show?id=".$medicine;
            $res = $client->request('GET', $url);
            $result = \GuzzleHttp\json_decode($res->getBody(), true);
            $drug = TNMedicine::create($result);
            if($drug->name) {
                $codes = $result['codes'];
                $numbers = $result['numbers'];
                if(count($codes)) {
                    foreach($codes as $code) {
                        TNMedicineCode::create($code);
                    }
                }
                if(count($numbers)) {
                    foreach($numbers as $number) {
                        TNMedicineNumber::create($number);
                    }
                }
            }
        }
        echo 'finished';
    }

    public function getDiseases() {
        $diseases = 7229;
        $client = new Client();
        for($disease=1561; $disease<= $diseases; $disease++) {
            $url = "http://www.tngou.net/api/disease/show?id=".$disease;
            $res = $client->request('GET', $url);
            $result = \GuzzleHttp\json_decode($res->getBody(), true);
            if($result['name'])
                TNDisease::create($result);
        }
        echo 'finished';
    }

    public function getSymptoms() {
        $symptoms = 3404;
        $client = new Client();
        for($symptom=10; $symptom<= $symptoms; $symptom++) {
            $url = "http://www.tngou.net/api/symptom/show?id=".$symptom;
            $res = $client->request('GET', $url);
            $result = \GuzzleHttp\json_decode($res->getBody(), true);
            if(count($result) > 5)
                TNSymptom::create($result);
        }
        echo 'finished';
    }

    public function getOperations() {
        $operations = 5801;
        $client = new Client();
        for($operation=1; $operation<= $operations; $operation++) {
            $url = "http://www.tngou.net/api/operation/show?id=".$operation;
            $res = $client->request('GET', $url);
            $result = \GuzzleHttp\json_decode($res->getBody(), true);
            if(count($result) > 5)
                TNOperation::create($result);
        }
        echo 'finished';
    }

    public function downImages() {
//        $all = TNOperation::all();
//        $all = TNDisease::all();
//        $all = TNDrugStore::skip(100000)->take(25000)->get();
//        $all = TNHostpital::skip(25000)->take(25000)->get();
//        $all = TNMedicine::all();
//        $all = TNFactory::all();
        $all = TNRecipe::skip(60000)->take(10000)->get();
//        $all = TNCheck::skip(1210)->take(5000)->get();//all();
//        $all = TNBook::all();
//        $all = TNLore::skip(20000)->take(5000)->get();
//        $all = TNAsk::all();
//        $all = TNSymptom::all();
//        $all = TNFood::all();
        $subDir = 'recipe';
        //lores message contains img
//        $path = $all->first()['img'];
//        $url = 'http://tnfs.tngou.net/img'.$path;

//        echo public_path();
//        $this->getDownloadImage($url, explode('.', $path)[1]);
        foreach($all as $item) {
//            $path = $item['img'];
//            if($path != null && strlen($path)) {
//                $url = 'http://tnfs.tngou.net/img/'.$path;
////            echo $path;
//                $splitedPath = explode('/', $path);
//                $filePath = public_path().'/images/'.$subDir.'/'.$splitedPath[count($splitedPath)-1];
//                if(!is_file($filePath))// && @fopen($url,"r"))
////                try {
//                    file_put_contents($filePath, file_get_contents($url));
////                } catch (Exception $e) {
////                    echo $url.' ';
////                    echo $e;
////                }

                $paths = $item['images'];
                if($paths != null && strlen($paths)) {
                echo $paths;
                    $splitedPathes = explode(',', $paths);
                    foreach($splitedPathes as $splitedPath) {
                        $url = 'http://tnfs.tngou.net/img/'.$splitedPath;

                        $splitedPath = explode('/', $splitedPath);
                        $filePath = public_path().'/images/'.$subDir.'/images/'.end($splitedPath);
                        if(!is_file($filePath))
                            file_put_contents($filePath, file_get_contents($url));
                    }
                }

//            }


//            Response::download($path);
//            $this->getDownloadImage($url, explode('.', $path)[1]);
        }
        echo 'finished';
    }

    public function getChecks() {
        $checks = 3627;
        $client = new Client();
        for($check=1247; $check<= $checks; $check++) {
            $url = "http://www.tngou.net/api/check/show?id=".$check;
            $res = $client->request('GET', $url);
            $result = \GuzzleHttp\json_decode($res->getBody(), true);
            if(count($result) > 5)
                TNCheck::create($result);
        }
        echo 'finished';
    }

    public function getDepartments() {
        $client = new Client();
        $url = "http://www.tngou.net/api/department/all";
        $res = $client->request('GET', $url);
        $body = '{"status":true,"tngou":[{"department":0,"departments":[{"department":1,"description":"","id":2,"keywords":"","name":"呼吸内科","seq":0,"title":""},{"department":1,"description":"","id":3,"keywords":"","name":"消化内科","seq":0,"title":""},{"department":1,"description":"","id":4,"keywords":"","name":"神经内科","seq":0,"title":""},{"department":1,"description":"","id":5,"keywords":"","name":"内分泌科","seq":0,"title":""},{"department":1,"description":"","id":6,"keywords":"","name":"肾内科","seq":0,"title":""},{"department":1,"description":"","id":7,"keywords":"","name":"风湿科","seq":0,"title":""},{"department":1,"description":"","id":8,"keywords":"","name":"血液科","seq":0,"title":""},{"department":1,"description":"","id":9,"keywords":"","name":"心血管内科","seq":0,"title":""}],"description":"","id":1,"keywords":"","name":"内科","seq":0,"title":""},{"department":0,"departments":[{"department":10,"description":"","id":11,"keywords":"","name":"普外科","seq":0,"title":""},{"department":10,"description":"","id":12,"keywords":"","name":"心胸外科","seq":0,"title":""},{"department":10,"description":"","id":13,"keywords":"","name":"肝胆外科","seq":0,"title":""},{"department":10,"description":"","id":14,"keywords":"","name":"胃肠外科","seq":0,"title":""},{"department":10,"description":"","id":15,"keywords":"","name":"脑外科","seq":0,"title":""},{"department":10,"description":"","id":16,"keywords":"","name":"泌尿外科","seq":0,"title":""},{"department":10,"description":"","id":17,"keywords":"","name":"骨科","seq":0,"title":""},{"department":10,"description":"","id":18,"keywords":"","name":"肛肠外科","seq":0,"title":""},{"department":10,"description":"","id":19,"keywords":"","name":"乳腺外科","seq":0,"title":""},{"department":10,"description":"","id":20,"keywords":"","name":"血管外科","seq":0,"title":""},{"department":10,"description":"","id":21,"keywords":"","name":"器官移植","seq":0,"title":""},{"department":10,"description":"","id":22,"keywords":"","name":"烧伤科","seq":0,"title":""},{"department":10,"description":"","id":24,"keywords":"","name":"外伤科","seq":0,"title":""}],"description":"","id":10,"keywords":"","name":"外科","seq":0,"title":""},{"department":0,"departments":[],"description":"","id":23,"keywords":"","name":"手外科","seq":0,"title":""},{"department":0,"departments":[{"department":25,"description":"","id":26,"keywords":"","name":"妇科","seq":0,"title":""},{"department":25,"description":"","id":27,"keywords":"","name":"产科","seq":0,"title":""}],"description":"","id":25,"keywords":"","name":"妇产科","seq":0,"title":""},{"department":0,"departments":[{"department":28,"description":"","id":29,"keywords":"","name":"眼科","seq":0,"title":""},{"department":28,"description":"","id":30,"keywords":"","name":"耳鼻喉科","seq":0,"title":""},{"department":28,"description":"","id":31,"keywords":"","name":"口腔科","seq":0,"title":""}],"description":"","id":28,"keywords":"","name":"五官科","seq":0,"title":""},{"department":0,"departments":[{"department":32,"description":"","id":33,"keywords":"","name":"皮肤科","seq":0,"title":""},{"department":32,"description":"","id":34,"keywords":"","name":"性病科","seq":0,"title":""}],"description":"","id":32,"keywords":"","name":"皮肤性病","seq":0,"title":""},{"department":0,"departments":[{"department":35,"description":"","id":36,"keywords":"","name":"中医科","seq":0,"title":""}],"description":"","id":35,"keywords":"","name":"中西医结合科","seq":0,"title":""},{"department":0,"departments":[{"department":37,"description":"","id":38,"keywords":"","name":"肝炎","seq":0,"title":""}],"description":"","id":37,"keywords":"","name":"肝病","seq":0,"title":""},{"department":0,"departments":[{"department":39,"description":"","id":40,"keywords":"","name":"精神病科","seq":0,"title":""},{"department":39,"description":"","id":41,"keywords":"","name":"心理咨询","seq":0,"title":""}],"description":"","id":39,"keywords":"","name":"精神心理科","seq":0,"title":""},{"department":0,"departments":[{"department":42,"description":"","id":43,"keywords":"","name":"儿科","seq":0,"title":""}],"description":"","id":42,"keywords":"","name":"儿科","seq":0,"title":""},{"department":0,"departments":[{"department":44,"description":"","id":45,"keywords":"","name":"男科","seq":0,"title":""}],"description":"","id":44,"keywords":"","name":"男科","seq":0,"title":""},{"department":0,"departments":[{"department":46,"description":"","id":47,"keywords":"","name":"生殖健康","seq":0,"title":""}],"description":"","id":46,"keywords":"","name":"生殖健康","seq":0,"title":""},{"department":0,"departments":[{"department":48,"description":"","id":49,"keywords":"","name":"肿瘤科","seq":0,"title":""}],"description":"","id":48,"keywords":"","name":"肿瘤科","seq":0,"title":""},{"department":0,"departments":[{"department":50,"description":"","id":51,"keywords":"","name":"传染科","seq":0,"title":""}],"description":"","id":50,"keywords":"","name":"传染科","seq":0,"title":""},{"department":0,"departments":[{"department":52,"description":"","id":53,"keywords":"","name":"老年科","seq":0,"title":""}],"description":"","id":52,"keywords":"","name":"老年科","seq":0,"title":""},{"department":0,"departments":[{"department":54,"description":"","id":55,"keywords":"","name":"体检保健科","seq":0,"title":""}],"description":"","id":54,"keywords":"","name":"体检保健科","seq":0,"title":""},{"department":0,"departments":[{"department":56,"description":"","id":57,"keywords":"","name":"成瘾医学科","seq":0,"title":""}],"description":"","id":56,"keywords":"","name":"成瘾医学科","seq":0,"title":""},{"department":0,"departments":[{"department":58,"description":"","id":59,"keywords":"","name":"核医学科","seq":0,"title":""}],"description":"","id":58,"keywords":"","name":"核医学科","seq":0,"title":""},{"department":0,"departments":[{"department":60,"description":"","id":61,"keywords":"","name":"急诊科","seq":0,"title":""}],"description":"","id":60,"keywords":"","name":"急诊科","seq":0,"title":""},{"department":0,"departments":[{"department":62,"description":"","id":63,"keywords":"","name":"营养科","seq":0,"title":""}],"description":"","id":62,"keywords":"","name":"营养科","seq":0,"title":""}]}';
        $result = \GuzzleHttp\json_decode($body, true);
//        var_dump($result);
        foreach($result['tngou'] as $departments) {
            TNDepartment::create($departments);
            foreach($departments['departments'] as $department) {
                TNDepartment::create($department);
            }
        }
        echo 'finished';
    }

    public function getBodyParts() {
//        $client = new Client();
//        $url = "http://www.tngou.net/api/place/all";
//        $res = $client->request('GET', $url);
        $body = '{"status":true,"tngou":[{"description":"头部","id":1,"keywords":"头部","name":"头部","place":0,"places":[{"description":"鼻","id":2,"keywords":"鼻","name":"鼻","place":1,"seq":0,"title":"鼻"},{"description":"耳","id":3,"keywords":"耳","name":"耳","place":1,"seq":0,"title":"耳"},{"description":"口","id":4,"keywords":"口","name":"口","place":1,"seq":0,"title":"口"},{"description":"颅脑","id":5,"keywords":"颅脑","name":"颅脑","place":1,"seq":0,"title":"颅脑"},{"description":"面部","id":6,"keywords":"面部","name":"面部","place":1,"seq":0,"title":"面部"},{"description":"咽喉","id":7,"keywords":"咽喉","name":"咽喉","place":1,"seq":0,"title":"咽喉"},{"description":"眼","id":8,"keywords":"眼","name":"眼","place":1,"seq":0,"title":"眼"}],"seq":0,"title":"头部"},{"description":"颈部","id":9,"keywords":"颈部","name":"颈部","place":0,"places":[{"description":"甲状腺","id":10,"keywords":"甲状腺","name":"甲状腺","place":9,"seq":0,"title":"甲状腺"},{"description":"气管","id":11,"keywords":"气管","name":"气管","place":9,"seq":0,"title":"气管"}],"seq":0,"title":"颈部"},{"description":"胸部","id":12,"keywords":"胸部","name":"胸部","place":0,"places":[{"description":"肺","id":13,"keywords":"肺","name":"肺","place":12,"seq":0,"title":"肺"},{"description":"膈肌","id":14,"keywords":"膈肌","name":"膈肌","place":12,"seq":0,"title":"膈肌"},{"description":"乳房","id":15,"keywords":"乳房","name":"乳房","place":12,"seq":0,"title":"乳房"},{"description":"食管","id":16,"keywords":"食管","name":"食管","place":12,"seq":0,"title":"食管"},{"description":"心脏","id":17,"keywords":"心脏","name":"心脏","place":12,"seq":0,"title":"心脏"},{"description":"纵膈","id":18,"keywords":"纵膈","name":"纵膈","place":12,"seq":0,"title":"纵膈"}],"seq":0,"title":"胸部"},{"description":"腹部","id":19,"keywords":"腹部","name":"腹部","place":0,"places":[{"description":"肠","id":20,"keywords":"肠","name":"肠","place":19,"seq":0,"title":"肠"},{"description":"肝","id":21,"keywords":"肝","name":"肝","place":19,"seq":0,"title":"肝"},{"description":"胆","id":22,"keywords":"胆","name":"胆","place":19,"seq":0,"title":"胆"},{"description":"腹膜","id":23,"keywords":"腹膜","name":"腹膜","place":19,"seq":0,"title":"腹膜"},{"description":"肠系膜","id":24,"keywords":"肠系膜","name":"肠系膜","place":19,"seq":0,"title":"肠系膜"},{"description":"阑尾","id":25,"keywords":"阑尾","name":"阑尾","place":19,"seq":0,"title":"阑尾"},{"description":"脾","id":26,"keywords":"脾","name":"脾","place":19,"seq":0,"title":"脾"},{"description":"胃","id":27,"keywords":"胃","name":"胃","place":19,"seq":0,"title":"胃"},{"description":"胰腺","id":28,"keywords":"胰腺","name":"胰腺","place":19,"seq":0,"title":"胰腺"}],"seq":0,"title":"腹部"},{"description":"腰部","id":29,"keywords":"腰部","name":"腰部","place":0,"places":[{"description":"肾","id":30,"keywords":"肾","name":"肾","place":29,"seq":0,"title":"肾"},{"description":"肾上腺","id":31,"keywords":"肾上腺","name":"肾上腺","place":29,"seq":0,"title":"肾上腺"},{"description":"输尿管","id":32,"keywords":"输尿管","name":"输尿管","place":29,"seq":0,"title":"输尿管"}],"seq":0,"title":"腰部"},{"description":"臀部","id":33,"keywords":"臀部","name":"臀部","place":0,"places":[{"description":"肛门","id":34,"keywords":"肛门","name":"肛门","place":33,"seq":0,"title":"肛门"}],"seq":0,"title":"臀部"},{"description":"上肢","id":35,"keywords":"上肢","name":"上肢","place":0,"places":[{"description":"肩部","id":36,"keywords":"肩部","name":"肩部","place":35,"seq":0,"title":"肩部"},{"description":"前臂","id":37,"keywords":"前臂","name":"前臂","place":35,"seq":0,"title":"前臂"},{"description":"上臂","id":38,"keywords":"上臂","name":"上臂","place":35,"seq":0,"title":"上臂"},{"description":"手部","id":39,"keywords":"手部","name":"手部","place":35,"seq":0,"title":"手部"},{"description":"肘部","id":40,"keywords":"肘部","name":"肘部","place":35,"seq":0,"title":"肘部"}],"seq":0,"title":"上肢"},{"description":"下肢","id":41,"keywords":"下肢","name":"下肢","place":0,"places":[{"description":"大腿","id":42,"keywords":"大腿","name":"大腿","place":41,"seq":0,"title":"大腿"},{"description":"膝部","id":43,"keywords":"膝部","name":"膝部","place":41,"seq":0,"title":"膝部"},{"description":"小腿","id":44,"keywords":"小腿","name":"小腿","place":41,"seq":0,"title":"小腿"},{"description":"足部","id":45,"keywords":"足部","name":"足部","place":41,"seq":0,"title":"足部"}],"seq":0,"title":"下肢"},{"description":"骨","id":46,"keywords":"骨","name":"骨","place":0,"places":[{"description":"骨髓","id":47,"keywords":"骨髓","name":"骨髓","place":46,"seq":0,"title":"骨髓"},{"description":"关节","id":48,"keywords":"关节","name":"关节","place":46,"seq":0,"title":"关节"},{"description":"脊髓","id":49,"keywords":"脊髓","name":"脊髓","place":46,"seq":0,"title":"脊髓"},{"description":"脊柱","id":50,"keywords":"脊柱","name":"脊柱","place":46,"seq":0,"title":"脊柱"},{"description":"肋骨","id":51,"keywords":"肋骨","name":"肋骨","place":46,"seq":0,"title":"肋骨"},{"description":"颅骨","id":52,"keywords":"颅骨","name":"颅骨","place":46,"seq":0,"title":"颅骨"},{"description":"盆骨","id":53,"keywords":"盆骨","name":"盆骨","place":46,"seq":0,"title":"盆骨"},{"description":"其他骨","id":54,"keywords":"其他骨","name":"其他骨","place":46,"seq":0,"title":"其他骨"},{"description":"上肢骨","id":55,"keywords":"上肢骨","name":"上肢骨","place":46,"seq":0,"title":"上肢骨"},{"description":"下肢骨","id":56,"keywords":"下肢骨","name":"下肢骨","place":46,"seq":0,"title":"下肢骨"}],"seq":0,"title":"骨"},{"description":"男性生殖","id":57,"keywords":"男性生殖","name":"男性生殖","place":0,"places":[{"description":"睾丸","id":58,"keywords":"睾丸","name":"睾丸","place":57,"seq":0,"title":"睾丸"},{"description":"前列腺","id":59,"keywords":"前列腺","name":"前列腺","place":57,"seq":0,"title":"前列腺"},{"description":"阴囊","id":60,"keywords":"阴囊","name":"阴囊","place":57,"seq":0,"title":"阴囊"},{"description":"阴茎","id":61,"keywords":"阴茎","name":"阴茎","place":57,"seq":0,"title":"阴茎"},{"description":"输精管","id":62,"keywords":"输精管","name":"输精管","place":57,"seq":0,"title":"输精管"}],"seq":0,"title":"男性生殖"},{"description":"女性生殖","id":63,"keywords":"女性生殖","name":"女性生殖","place":0,"places":[{"description":"卵巢","id":64,"keywords":"卵巢","name":"卵巢","place":63,"seq":0,"title":"卵巢"},{"description":"输卵管","id":65,"keywords":"输卵管","name":"输卵管","place":63,"seq":0,"title":"输卵管"},{"description":"外阴","id":66,"keywords":"外阴","name":"外阴","place":63,"seq":0,"title":"外阴"},{"description":"阴道","id":67,"keywords":"阴道","name":"阴道","place":63,"seq":0,"title":"阴道"},{"description":"子宫","id":68,"keywords":"子宫","name":"子宫","place":63,"seq":0,"title":"子宫"}],"seq":0,"title":"女性生殖"},{"description":"盆腔","id":69,"keywords":"盆腔","name":"盆腔","place":0,"places":[{"description":"膀胱","id":70,"keywords":"膀胱","name":"膀胱","place":69,"seq":0,"title":"膀胱"},{"description":"尿道","id":71,"keywords":"尿道","name":"尿道","place":69,"seq":0,"title":"尿道"}],"seq":0,"title":"盆腔"},{"description":"全身","id":72,"keywords":"全身","name":"全身","place":0,"places":[{"description":"肌肉","id":73,"keywords":"肌肉","name":"肌肉","place":72,"seq":0,"title":"肌肉"},{"description":"淋巴","id":74,"keywords":"淋巴","name":"淋巴","place":72,"seq":0,"title":"淋巴"},{"description":"血液血管","id":75,"keywords":"血液血管","name":"血液血管","place":72,"seq":0,"title":"血液血管"},{"description":"免疫系统","id":76,"keywords":"免疫系统","name":"免疫系统","place":72,"seq":0,"title":"免疫系统"},{"description":"皮肤","id":77,"keywords":"皮肤","name":"皮肤","place":72,"seq":0,"title":"皮肤"},{"description":"周围神经系统","id":78,"keywords":"周围神经系统","name":"周围神经系统","place":72,"seq":0,"title":"周围神经系统"}],"seq":0,"title":"全身"},{"description":"会阴部","id":79,"keywords":"会阴部","name":"会阴部","place":0,"places":[{"description":"会阴部","id":80,"keywords":"会阴部","name":"会阴部","place":79,"seq":0,"title":"会阴部"}],"seq":0,"title":"会阴部"},{"description":"心理","id":81,"keywords":"心理","name":"心理","place":0,"places":[{"description":"心理","id":82,"keywords":"心理","name":"心理","place":81,"seq":0,"title":"心理"}],"seq":0,"title":"心理"},{"description":"背部","id":83,"keywords":"背部","name":"背部","place":0,"places":[{"description":"背部","id":84,"keywords":"背部","name":"背部","place":83,"seq":0,"title":"背部"}],"seq":0,"title":"背部"},{"description":"其他","id":85,"keywords":"其他","name":"其他","place":0,"places":[{"description":"其他","id":86,"keywords":"其他","name":"其他","place":85,"seq":0,"title":"其他"}],"seq":0,"title":"其他"},{"description":"全部","id":87,"keywords":"全部","name":"全部","place":0,"places":[],"seq":0,"title":"全部"}]}';
        $result = \GuzzleHttp\json_decode($body, true);
//        var_dump($result);
        foreach($result['tngou'] as $parts) {
            TNDepartment::create($parts);
            foreach($parts['places'] as $part) {
                TNBodyPart::create($part);
            }
        }
        echo 'finished';
    }

    public function getFactories() {
        $factories = 7106;
        $client = new Client();
        for($factory=1; $factory<= $factories; $factory++) {
            $url = "http://www.tngou.net/api/factory/show?id=".$factory;
            $res = $client->request('GET', $url);
            $result = \GuzzleHttp\json_decode($res->getBody(), true);
            if(count($result) > 5)
                TNFactory::create($result);
        }
        echo 'finished';
    }

    public function getDrugStores() {
        $stores = 123242;
        $client = new Client();
        for($store=114576; $store<= $stores; $store++) {
            $url = "http://www.tngou.net/api/store/show?id=".$store;
            $res = $client->request('GET', $url);
            $result = \GuzzleHttp\json_decode($res->getBody(), true);
            if(count($result) > 5)
                TNDrugStore::create($result);
        }
        echo 'finished';
    }

    public function getCities() {
//        $client = new Client();
//        $url = "http://www.tngou.net/api/place/all";
//        $res = $client->request('GET', $url);
        $cities = '{"status":true,"tngou":[{"city":"北京","id":2,"level":2,"province":"北京","seq":0,"x":116.405,"y":39.905},{"city":"上海","id":4,"level":2,"province":"上海","seq":0,"x":121.473,"y":31.2317},{"city":"天津","id":6,"level":2,"province":"天津","seq":0,"x":117.19,"y":39.1256},{"city":"重庆","id":8,"level":2,"province":"重庆","seq":0,"x":106.505,"y":29.5332},{"city":"合肥","id":10,"level":2,"province":"安徽","seq":0,"x":117.283,"y":31.8612},{"city":"芜湖","id":11,"level":2,"province":"安徽","seq":0,"x":117.283,"y":31.8612},{"city":"安庆","id":12,"level":2,"province":"安徽","seq":0,"x":117.283,"y":31.8612},{"city":"蚌埠","id":13,"level":2,"province":"安徽","seq":0,"x":117.283,"y":31.8612},{"city":"亳州","id":14,"level":2,"province":"安徽","seq":0,"x":117.283,"y":31.8612},{"city":"巢湖","id":15,"level":2,"province":"安徽","seq":0,"x":117.283,"y":31.8612},{"city":"池州","id":16,"level":2,"province":"安徽","seq":0,"x":117.283,"y":31.8612},{"city":"滁州","id":17,"level":2,"province":"安徽","seq":0,"x":117.283,"y":31.8612},{"city":"阜阳","id":18,"level":2,"province":"安徽","seq":0,"x":117.283,"y":31.8612},{"city":"黄山","id":19,"level":2,"province":"安徽","seq":0,"x":117.283,"y":31.8612},{"city":"淮北","id":20,"level":2,"province":"安徽","seq":0,"x":117.283,"y":31.8612},{"city":"淮南","id":21,"level":2,"province":"安徽","seq":0,"x":117.283,"y":31.8612},{"city":"六安","id":22,"level":2,"province":"安徽","seq":0,"x":117.283,"y":31.8612},{"city":"马鞍山","id":23,"level":2,"province":"安徽","seq":0,"x":117.283,"y":31.8612},{"city":"宿州","id":24,"level":2,"province":"安徽","seq":0,"x":117.283,"y":31.8612},{"city":"铜陵","id":25,"level":2,"province":"安徽","seq":0,"x":117.283,"y":31.8612},{"city":"宣城","id":26,"level":2,"province":"安徽","seq":0,"x":117.283,"y":31.8612},{"city":"福州","id":28,"level":2,"province":"福建","seq":0,"x":119.306,"y":26.0753},{"city":"厦门","id":29,"level":2,"province":"福建","seq":0,"x":119.306,"y":26.0753},{"city":"泉州","id":30,"level":2,"province":"福建","seq":0,"x":119.306,"y":26.0753},{"city":"龙岩","id":31,"level":2,"province":"福建","seq":0,"x":119.306,"y":26.0753},{"city":"宁德","id":32,"level":2,"province":"福建","seq":0,"x":119.306,"y":26.0753},{"city":"南平","id":33,"level":2,"province":"福建","seq":0,"x":119.306,"y":26.0753},{"city":"莆田","id":34,"level":2,"province":"福建","seq":0,"x":119.306,"y":26.0753},{"city":"三明","id":35,"level":2,"province":"福建","seq":0,"x":119.306,"y":26.0753},{"city":"漳州","id":36,"level":2,"province":"福建","seq":0,"x":119.306,"y":26.0753},{"city":"兰州","id":38,"level":2,"province":"甘肃","seq":0,"x":103.824,"y":36.058},{"city":"白银","id":39,"level":2,"province":"甘肃","seq":0,"x":103.824,"y":36.058},{"city":"定西","id":40,"level":2,"province":"甘肃","seq":0,"x":103.824,"y":36.058},{"city":"金昌","id":41,"level":2,"province":"甘肃","seq":0,"x":103.824,"y":36.058},{"city":"酒泉","id":42,"level":2,"province":"甘肃","seq":0,"x":103.824,"y":36.058},{"city":"平凉","id":43,"level":2,"province":"甘肃","seq":0,"x":103.824,"y":36.058},{"city":"庆阳","id":44,"level":2,"province":"甘肃","seq":0,"x":103.824,"y":36.058},{"city":"武威","id":45,"level":2,"province":"甘肃","seq":0,"x":103.824,"y":36.058},{"city":"天水","id":46,"level":2,"province":"甘肃","seq":0,"x":103.824,"y":36.058},{"city":"张掖","id":47,"level":2,"province":"甘肃","seq":0,"x":103.824,"y":36.058},{"city":"甘南","id":48,"level":2,"province":"甘肃","seq":0,"x":103.824,"y":36.058},{"city":"嘉峪关","id":49,"level":2,"province":"甘肃","seq":0,"x":103.824,"y":36.058},{"city":"临夏","id":50,"level":2,"province":"甘肃","seq":0,"x":103.824,"y":36.058},{"city":"陇南","id":51,"level":2,"province":"甘肃","seq":0,"x":103.824,"y":36.058},{"city":"广州","id":53,"level":2,"province":"广东","seq":0,"x":113.281,"y":23.1252},{"city":"深圳","id":54,"level":2,"province":"广东","seq":0,"x":113.281,"y":23.1252},{"city":"珠海","id":55,"level":2,"province":"广东","seq":0,"x":113.281,"y":23.1252},{"city":"东莞","id":56,"level":2,"province":"广东","seq":0,"x":113.281,"y":23.1252},{"city":"佛山","id":57,"level":2,"province":"广东","seq":0,"x":113.281,"y":23.1252},{"city":"惠州","id":58,"level":2,"province":"广东","seq":0,"x":113.281,"y":23.1252},{"city":"江门","id":59,"level":2,"province":"广东","seq":0,"x":113.281,"y":23.1252},{"city":"中山","id":60,"level":2,"province":"广东","seq":0,"x":113.281,"y":23.1252},{"city":"汕头","id":61,"level":2,"province":"广东","seq":0,"x":113.281,"y":23.1252},{"city":"湛江","id":62,"level":2,"province":"广东","seq":0,"x":113.281,"y":23.1252},{"city":"潮州","id":63,"level":2,"province":"广东","seq":0,"x":113.281,"y":23.1252},{"city":"河源","id":64,"level":2,"province":"广东","seq":0,"x":113.281,"y":23.1252},{"city":"揭阳","id":65,"level":2,"province":"广东","seq":0,"x":113.281,"y":23.1252},{"city":"茂名","id":66,"level":2,"province":"广东","seq":0,"x":113.281,"y":23.1252},{"city":"梅州","id":67,"level":2,"province":"广东","seq":0,"x":113.281,"y":23.1252},{"city":"清远","id":68,"level":2,"province":"广东","seq":0,"x":113.281,"y":23.1252},{"city":"韶关","id":69,"level":2,"province":"广东","seq":0,"x":113.281,"y":23.1252},{"city":"汕尾","id":70,"level":2,"province":"广东","seq":0,"x":113.281,"y":23.1252},{"city":"阳江","id":71,"level":2,"province":"广东","seq":0,"x":113.281,"y":23.1252},{"city":"云浮","id":72,"level":2,"province":"广东","seq":0,"x":113.281,"y":23.1252},{"city":"肇庆","id":73,"level":2,"province":"广东","seq":0,"x":113.281,"y":23.1252},{"city":"南宁","id":75,"level":2,"province":"广西","seq":0,"x":108.32,"y":22.824},{"city":"北海","id":76,"level":2,"province":"广西","seq":0,"x":108.32,"y":22.824},{"city":"防城港","id":77,"level":2,"province":"广西","seq":0,"x":108.32,"y":22.824},{"city":"桂林","id":78,"level":2,"province":"广西","seq":0,"x":108.32,"y":22.824},{"city":"柳州","id":79,"level":2,"province":"广西","seq":0,"x":108.32,"y":22.824},{"city":"崇左","id":80,"level":2,"province":"广西","seq":0,"x":108.32,"y":22.824},{"city":"来宾","id":81,"level":2,"province":"广西","seq":0,"x":108.32,"y":22.824},{"city":"梧州","id":82,"level":2,"province":"广西","seq":0,"x":108.32,"y":22.824},{"city":"河池","id":83,"level":2,"province":"广西","seq":0,"x":108.32,"y":22.824},{"city":"玉林","id":84,"level":2,"province":"广西","seq":0,"x":108.32,"y":22.824},{"city":"贵港","id":85,"level":2,"province":"广西","seq":0,"x":108.32,"y":22.824},{"city":"贺州","id":86,"level":2,"province":"广西","seq":0,"x":108.32,"y":22.824},{"city":"钦州","id":87,"level":2,"province":"广西","seq":0,"x":108.32,"y":22.824},{"city":"百色","id":88,"level":2,"province":"广西","seq":0,"x":108.32,"y":22.824},{"city":"贵阳","id":90,"level":2,"province":"贵州","seq":0,"x":106.713,"y":26.5783},{"city":"安顺","id":91,"level":2,"province":"贵州","seq":0,"x":106.713,"y":26.5783},{"city":"遵义","id":92,"level":2,"province":"贵州","seq":0,"x":106.713,"y":26.5783},{"city":"六盘水","id":93,"level":2,"province":"贵州","seq":0,"x":106.713,"y":26.5783},{"city":"毕节","id":94,"level":2,"province":"贵州","seq":0,"x":106.713,"y":26.5783},{"city":"黔东南","id":95,"level":2,"province":"贵州","seq":0,"x":106.713,"y":26.5783},{"city":"黔西南","id":96,"level":2,"province":"贵州","seq":0,"x":106.713,"y":26.5783},{"city":"黔南","id":97,"level":2,"province":"贵州","seq":0,"x":106.713,"y":26.5783},{"city":"铜仁","id":98,"level":2,"province":"贵州","seq":0,"x":106.713,"y":26.5783},{"city":"海口","id":100,"level":2,"province":"海南","seq":0,"x":110.331,"y":20.032},{"city":"三亚","id":101,"level":2,"province":"海南","seq":0,"x":110.331,"y":20.032},{"city":"白沙县","id":102,"level":2,"province":"海南","seq":0,"x":110.331,"y":20.032},{"city":"保亭县","id":103,"level":2,"province":"海南","seq":0,"x":110.331,"y":20.032},{"city":"昌江县","id":104,"level":2,"province":"海南","seq":0,"x":110.331,"y":20.032},{"city":"澄迈县","id":105,"level":2,"province":"海南","seq":0,"x":110.331,"y":20.032},{"city":"定安县","id":106,"level":2,"province":"海南","seq":0,"x":110.331,"y":20.032},{"city":"东方","id":107,"level":2,"province":"海南","seq":0,"x":110.331,"y":20.032},{"city":"乐东县","id":108,"level":2,"province":"海南","seq":0,"x":110.331,"y":20.032},{"city":"临高县","id":109,"level":2,"province":"海南","seq":0,"x":110.331,"y":20.032},{"city":"陵水县","id":110,"level":2,"province":"海南","seq":0,"x":110.331,"y":20.032},{"city":"琼海","id":111,"level":2,"province":"海南","seq":0,"x":110.331,"y":20.032},{"city":"琼中县","id":112,"level":2,"province":"海南","seq":0,"x":110.331,"y":20.032},{"city":"屯昌县","id":113,"level":2,"province":"海南","seq":0,"x":110.331,"y":20.032},{"city":"万宁","id":114,"level":2,"province":"海南","seq":0,"x":110.331,"y":20.032},{"city":"文昌","id":115,"level":2,"province":"海南","seq":0,"x":110.331,"y":20.032},{"city":"五指山","id":116,"level":2,"province":"海南","seq":0,"x":110.331,"y":20.032},{"city":"儋州","id":117,"level":2,"province":"海南","seq":0,"x":110.331,"y":20.032},{"city":"石家庄","id":119,"level":2,"province":"河北","seq":0,"x":117.202,"y":39.1566},{"city":"保定","id":120,"level":2,"province":"河北","seq":0,"x":117.202,"y":39.1566},{"city":"承德","id":121,"level":2,"province":"河北","seq":0,"x":117.202,"y":39.1566},{"city":"邯郸","id":122,"level":2,"province":"河北","seq":0,"x":117.202,"y":39.1566},{"city":"唐山","id":123,"level":2,"province":"河北","seq":0,"x":117.202,"y":39.1566},{"city":"秦皇岛","id":124,"level":2,"province":"河北","seq":0,"x":117.202,"y":39.1566},{"city":"沧州","id":125,"level":2,"province":"河北","seq":0,"x":117.202,"y":39.1566},{"city":"衡水","id":126,"level":2,"province":"河北","seq":0,"x":117.202,"y":39.1566},{"city":"廊坊","id":127,"level":2,"province":"河北","seq":0,"x":117.202,"y":39.1566},{"city":"邢台","id":128,"level":2,"province":"河北","seq":0,"x":117.202,"y":39.1566},{"city":"张家口","id":129,"level":2,"province":"河北","seq":0,"x":117.202,"y":39.1566},{"city":"郑州","id":131,"level":2,"province":"河南","seq":0,"x":113.665,"y":34.758},{"city":"洛阳","id":132,"level":2,"province":"河南","seq":0,"x":113.665,"y":34.758},{"city":"开封","id":133,"level":2,"province":"河南","seq":0,"x":113.665,"y":34.758},{"city":"许昌","id":134,"level":2,"province":"河南","seq":0,"x":113.665,"y":34.758},{"city":"安阳","id":135,"level":2,"province":"河南","seq":0,"x":113.665,"y":34.758},{"city":"平顶山","id":136,"level":2,"province":"河南","seq":0,"x":113.665,"y":34.758},{"city":"鹤壁","id":137,"level":2,"province":"河南","seq":0,"x":113.665,"y":34.758},{"city":"焦作","id":138,"level":2,"province":"河南","seq":0,"x":113.665,"y":34.758},{"city":"济源","id":139,"level":2,"province":"河南","seq":0,"x":113.665,"y":34.758},{"city":"漯河","id":140,"level":2,"province":"河南","seq":0,"x":113.665,"y":34.758},{"city":"南阳","id":141,"level":2,"province":"河南","seq":0,"x":113.665,"y":34.758},{"city":"濮阳","id":142,"level":2,"province":"河南","seq":0,"x":113.665,"y":34.758},{"city":"三门峡","id":143,"level":2,"province":"河南","seq":0,"x":113.665,"y":34.758},{"city":"商丘","id":144,"level":2,"province":"河南","seq":0,"x":113.665,"y":34.758},{"city":"新乡","id":145,"level":2,"province":"河南","seq":0,"x":113.665,"y":34.758},{"city":"信阳","id":146,"level":2,"province":"河南","seq":0,"x":113.665,"y":34.758},{"city":"驻马店","id":147,"level":2,"province":"河南","seq":0,"x":113.665,"y":34.758},{"city":"周口","id":148,"level":2,"province":"河南","seq":0,"x":113.665,"y":34.758},{"city":"哈尔滨","id":150,"level":2,"province":"黑龙江","seq":0,"x":126.642,"y":45.757},{"city":"大庆","id":151,"level":2,"province":"黑龙江","seq":0,"x":126.642,"y":45.757},{"city":"齐齐哈尔","id":152,"level":2,"province":"黑龙江","seq":0,"x":126.642,"y":45.757},{"city":"佳木斯","id":153,"level":2,"province":"黑龙江","seq":0,"x":126.642,"y":45.757},{"city":"大兴安岭","id":154,"level":2,"province":"黑龙江","seq":0,"x":126.642,"y":45.757},{"city":"黑河","id":155,"level":2,"province":"黑龙江","seq":0,"x":126.642,"y":45.757},{"city":"鹤岗","id":156,"level":2,"province":"黑龙江","seq":0,"x":126.642,"y":45.757},{"city":"鸡西","id":157,"level":2,"province":"黑龙江","seq":0,"x":126.642,"y":45.757},{"city":"牡丹江","id":158,"level":2,"province":"黑龙江","seq":0,"x":126.642,"y":45.757},{"city":"七台河","id":159,"level":2,"province":"黑龙江","seq":0,"x":126.642,"y":45.757},{"city":"绥化","id":160,"level":2,"province":"黑龙江","seq":0,"x":126.642,"y":45.757},{"city":"双鸭山","id":161,"level":2,"province":"黑龙江","seq":0,"x":126.642,"y":45.757},{"city":"伊春","id":162,"level":2,"province":"黑龙江","seq":0,"x":126.642,"y":45.757},{"city":"武汉","id":164,"level":2,"province":"湖北","seq":0,"x":114.299,"y":30.5844},{"city":"襄阳","id":165,"level":2,"province":"湖北","seq":0,"x":114.299,"y":30.5844},{"city":"十堰","id":166,"level":2,"province":"湖北","seq":0,"x":114.299,"y":30.5844},{"city":"黄石","id":167,"level":2,"province":"湖北","seq":0,"x":114.299,"y":30.5844},{"city":"鄂州","id":168,"level":2,"province":"湖北","seq":0,"x":114.299,"y":30.5844},{"city":"恩施","id":169,"level":2,"province":"湖北","seq":0,"x":114.299,"y":30.5844},{"city":"黄冈","id":170,"level":2,"province":"湖北","seq":0,"x":114.299,"y":30.5844},{"city":"荆州","id":171,"level":2,"province":"湖北","seq":0,"x":114.299,"y":30.5844},{"city":"荆门","id":172,"level":2,"province":"湖北","seq":0,"x":114.299,"y":30.5844},{"city":"随州","id":173,"level":2,"province":"湖北","seq":0,"x":114.299,"y":30.5844},{"city":"宜昌","id":174,"level":2,"province":"湖北","seq":0,"x":114.299,"y":30.5844},{"city":"天门","id":175,"level":2,"province":"湖北","seq":0,"x":114.299,"y":30.5844},{"city":"潜江","id":176,"level":2,"province":"湖北","seq":0,"x":114.299,"y":30.5844},{"city":"仙桃","id":177,"level":2,"province":"湖北","seq":0,"x":114.299,"y":30.5844},{"city":"孝感","id":178,"level":2,"province":"湖北","seq":0,"x":114.299,"y":30.5844},{"city":"咸宁","id":179,"level":2,"province":"湖北","seq":0,"x":114.299,"y":30.5844},{"city":"神农架","id":180,"level":2,"province":"湖北","seq":0,"x":114.299,"y":30.5844},{"city":"长沙","id":182,"level":2,"province":"湖南","seq":0,"x":112.982,"y":28.1941},{"city":"岳阳","id":183,"level":2,"province":"湖南","seq":0,"x":112.982,"y":28.1941},{"city":"湘潭","id":184,"level":2,"province":"湖南","seq":0,"x":112.982,"y":28.1941},{"city":"常德","id":185,"level":2,"province":"湖南","seq":0,"x":112.982,"y":28.1941},{"city":"郴州","id":186,"level":2,"province":"湖南","seq":0,"x":112.982,"y":28.1941},{"city":"衡阳","id":187,"level":2,"province":"湖南","seq":0,"x":112.982,"y":28.1941},{"city":"怀化","id":188,"level":2,"province":"湖南","seq":0,"x":112.982,"y":28.1941},{"city":"娄底","id":189,"level":2,"province":"湖南","seq":0,"x":112.982,"y":28.1941},{"city":"邵阳","id":190,"level":2,"province":"湖南","seq":0,"x":112.982,"y":28.1941},{"city":"益阳","id":191,"level":2,"province":"湖南","seq":0,"x":112.982,"y":28.1941},{"city":"永州","id":192,"level":2,"province":"湖南","seq":0,"x":112.982,"y":28.1941},{"city":"株洲","id":193,"level":2,"province":"湖南","seq":0,"x":112.982,"y":28.1941},{"city":"张家界","id":194,"level":2,"province":"湖南","seq":0,"x":112.982,"y":28.1941},{"city":"湘西","id":195,"level":2,"province":"湖南","seq":0,"x":112.982,"y":28.1941},{"city":"长春","id":197,"level":2,"province":"吉林","seq":0,"x":125.325,"y":43.8868},{"city":"吉林","id":198,"level":2,"province":"吉林","seq":0,"x":125.325,"y":43.8868},{"city":"延边","id":199,"level":2,"province":"吉林","seq":0,"x":125.325,"y":43.8868},{"city":"白城","id":200,"level":2,"province":"吉林","seq":0,"x":125.325,"y":43.8868},{"city":"白山","id":201,"level":2,"province":"吉林","seq":0,"x":125.325,"y":43.8868},{"city":"辽源","id":202,"level":2,"province":"吉林","seq":0,"x":125.325,"y":43.8868},{"city":"四平","id":203,"level":2,"province":"吉林","seq":0,"x":125.325,"y":43.8868},{"city":"松原","id":204,"level":2,"province":"吉林","seq":0,"x":125.325,"y":43.8868},{"city":"通化","id":205,"level":2,"province":"吉林","seq":0,"x":125.325,"y":43.8868},{"city":"南京","id":207,"level":2,"province":"江苏","seq":0,"x":118.767,"y":32.0415},{"city":"苏州","id":208,"level":2,"province":"江苏","seq":0,"x":118.767,"y":32.0415},{"city":"常州","id":209,"level":2,"province":"江苏","seq":0,"x":118.767,"y":32.0415},{"city":"连云港","id":210,"level":2,"province":"江苏","seq":0,"x":118.767,"y":32.0415},{"city":"泰州","id":211,"level":2,"province":"江苏","seq":0,"x":118.767,"y":32.0415},{"city":"无锡","id":212,"level":2,"province":"江苏","seq":0,"x":118.767,"y":32.0415},{"city":"徐州","id":213,"level":2,"province":"江苏","seq":0,"x":118.767,"y":32.0415},{"city":"扬州","id":214,"level":2,"province":"江苏","seq":0,"x":118.767,"y":32.0415},{"city":"镇江","id":215,"level":2,"province":"江苏","seq":0,"x":118.767,"y":32.0415},{"city":"淮安","id":216,"level":2,"province":"江苏","seq":0,"x":118.767,"y":32.0415},{"city":"南通","id":217,"level":2,"province":"江苏","seq":0,"x":118.767,"y":32.0415},{"city":"宿迁","id":218,"level":2,"province":"江苏","seq":0,"x":118.767,"y":32.0415},{"city":"盐城","id":219,"level":2,"province":"江苏","seq":0,"x":118.767,"y":32.0415},{"city":"南昌","id":221,"level":2,"province":"江西","seq":0,"x":115.892,"y":28.6765},{"city":"赣州","id":222,"level":2,"province":"江西","seq":0,"x":115.892,"y":28.6765},{"city":"九江","id":223,"level":2,"province":"江西","seq":0,"x":115.892,"y":28.6765},{"city":"景德镇","id":224,"level":2,"province":"江西","seq":0,"x":115.892,"y":28.6765},{"city":"吉安","id":225,"level":2,"province":"江西","seq":0,"x":115.892,"y":28.6765},{"city":"萍乡","id":226,"level":2,"province":"江西","seq":0,"x":115.892,"y":28.6765},{"city":"上饶","id":227,"level":2,"province":"江西","seq":0,"x":115.892,"y":28.6765},{"city":"新余","id":228,"level":2,"province":"江西","seq":0,"x":115.892,"y":28.6765},{"city":"宜春","id":229,"level":2,"province":"江西","seq":0,"x":115.892,"y":28.6765},{"city":"鹰潭","id":230,"level":2,"province":"江西","seq":0,"x":115.892,"y":28.6765},{"city":"抚州","id":231,"level":2,"province":"江西","seq":0,"x":115.892,"y":28.6765},{"city":"沈阳","id":233,"level":2,"province":"辽宁","seq":0,"x":123.429,"y":41.7968},{"city":"大连","id":234,"level":2,"province":"辽宁","seq":0,"x":123.429,"y":41.7968},{"city":"鞍山","id":235,"level":2,"province":"辽宁","seq":0,"x":123.429,"y":41.7968},{"city":"丹东","id":236,"level":2,"province":"辽宁","seq":0,"x":123.429,"y":41.7968},{"city":"抚顺","id":237,"level":2,"province":"辽宁","seq":0,"x":123.429,"y":41.7968},{"city":"锦州","id":238,"level":2,"province":"辽宁","seq":0,"x":123.429,"y":41.7968},{"city":"营口","id":239,"level":2,"province":"辽宁","seq":0,"x":123.429,"y":41.7968},{"city":"本溪","id":240,"level":2,"province":"辽宁","seq":0,"x":123.429,"y":41.7968},{"city":"朝阳","id":241,"level":2,"province":"辽宁","seq":0,"x":123.429,"y":41.7968},{"city":"阜新","id":242,"level":2,"province":"辽宁","seq":0,"x":123.429,"y":41.7968},{"city":"葫芦岛","id":243,"level":2,"province":"辽宁","seq":0,"x":123.429,"y":41.7968},{"city":"辽阳","id":244,"level":2,"province":"辽宁","seq":0,"x":123.429,"y":41.7968},{"city":"盘锦","id":245,"level":2,"province":"辽宁","seq":0,"x":123.429,"y":41.7968},{"city":"铁岭","id":246,"level":2,"province":"辽宁","seq":0,"x":123.429,"y":41.7968},{"city":"呼和浩特","id":248,"level":2,"province":"内蒙古","seq":0,"x":111.671,"y":40.8183},{"city":"包头","id":249,"level":2,"province":"内蒙古","seq":0,"x":111.671,"y":40.8183},{"city":"赤峰","id":250,"level":2,"province":"内蒙古","seq":0,"x":111.671,"y":40.8183},{"city":"鄂尔多斯","id":251,"level":2,"province":"内蒙古","seq":0,"x":111.671,"y":40.8183},{"city":"乌兰察布","id":252,"level":2,"province":"内蒙古","seq":0,"x":111.671,"y":40.8183},{"city":"乌海","id":253,"level":2,"province":"内蒙古","seq":0,"x":111.671,"y":40.8183},{"city":"兴安盟","id":254,"level":2,"province":"内蒙古","seq":0,"x":111.671,"y":40.8183},{"city":"呼伦贝尔","id":255,"level":2,"province":"内蒙古","seq":0,"x":111.671,"y":40.8183},{"city":"通辽","id":256,"level":2,"province":"内蒙古","seq":0,"x":111.671,"y":40.8183},{"city":"阿拉善盟","id":257,"level":2,"province":"内蒙古","seq":0,"x":111.671,"y":40.8183},{"city":"巴彦淖尔","id":258,"level":2,"province":"内蒙古","seq":0,"x":111.671,"y":40.8183},{"city":"锡林郭勒","id":259,"level":2,"province":"内蒙古","seq":0,"x":111.671,"y":40.8183},{"city":"银川","id":261,"level":2,"province":"宁夏","seq":0,"x":106.278,"y":38.4664},{"city":"石嘴山","id":262,"level":2,"province":"宁夏","seq":0,"x":106.278,"y":38.4664},{"city":"固原","id":263,"level":2,"province":"宁夏","seq":0,"x":106.278,"y":38.4664},{"city":"吴忠","id":264,"level":2,"province":"宁夏","seq":0,"x":106.278,"y":38.4664},{"city":"中卫","id":265,"level":2,"province":"宁夏","seq":0,"x":106.278,"y":38.4664},{"city":"西宁","id":267,"level":2,"province":"青海","seq":0,"x":101.779,"y":36.6232},{"city":"黄南","id":268,"level":2,"province":"青海","seq":0,"x":101.779,"y":36.6232},{"city":"玉树","id":269,"level":2,"province":"青海","seq":0,"x":101.779,"y":36.6232},{"city":"果洛","id":270,"level":2,"province":"青海","seq":0,"x":101.779,"y":36.6232},{"city":"海东","id":271,"level":2,"province":"青海","seq":0,"x":101.779,"y":36.6232},{"city":"海西","id":272,"level":2,"province":"青海","seq":0,"x":101.779,"y":36.6232},{"city":"海南","id":273,"level":2,"province":"青海","seq":0,"x":101.779,"y":36.6232},{"city":"海北","id":274,"level":2,"province":"青海","seq":0,"x":101.779,"y":36.6232},{"city":"济南","id":276,"level":2,"province":"山东","seq":0,"x":117.001,"y":36.6758},{"city":"青岛","id":277,"level":2,"province":"山东","seq":0,"x":117.001,"y":36.6758},{"city":"威海","id":278,"level":2,"province":"山东","seq":0,"x":117.001,"y":36.6758},{"city":"烟台","id":279,"level":2,"province":"山东","seq":0,"x":117.001,"y":36.6758},{"city":"潍坊","id":280,"level":2,"province":"山东","seq":0,"x":117.001,"y":36.6758},{"city":"泰安","id":281,"level":2,"province":"山东","seq":0,"x":117.001,"y":36.6758},{"city":"滨州","id":282,"level":2,"province":"山东","seq":0,"x":117.001,"y":36.6758},{"city":"德州","id":283,"level":2,"province":"山东","seq":0,"x":117.001,"y":36.6758},{"city":"东营","id":284,"level":2,"province":"山东","seq":0,"x":117.001,"y":36.6758},{"city":"菏泽","id":285,"level":2,"province":"山东","seq":0,"x":117.001,"y":36.6758},{"city":"济宁","id":286,"level":2,"province":"山东","seq":0,"x":117.001,"y":36.6758},{"city":"聊城","id":287,"level":2,"province":"山东","seq":0,"x":117.001,"y":36.6758},{"city":"临沂","id":288,"level":2,"province":"山东","seq":0,"x":117.001,"y":36.6758},{"city":"莱芜","id":289,"level":2,"province":"山东","seq":0,"x":117.001,"y":36.6758},{"city":"日照","id":290,"level":2,"province":"山东","seq":0,"x":117.001,"y":36.6758},{"city":"淄博","id":291,"level":2,"province":"山东","seq":0,"x":117.001,"y":36.6758},{"city":"枣庄","id":292,"level":2,"province":"山东","seq":0,"x":117.001,"y":36.6758},{"city":"太原","id":294,"level":2,"province":"山西","seq":0,"x":112.549,"y":37.857},{"city":"长治","id":295,"level":2,"province":"山西","seq":0,"x":112.549,"y":37.857},{"city":"大同","id":296,"level":2,"province":"山西","seq":0,"x":112.549,"y":37.857},{"city":"晋城","id":297,"level":2,"province":"山西","seq":0,"x":112.549,"y":37.857},{"city":"晋中","id":298,"level":2,"province":"山西","seq":0,"x":112.549,"y":37.857},{"city":"临汾","id":299,"level":2,"province":"山西","seq":0,"x":112.549,"y":37.857},{"city":"吕梁","id":300,"level":2,"province":"山西","seq":0,"x":112.549,"y":37.857},{"city":"朔州","id":301,"level":2,"province":"山西","seq":0,"x":112.549,"y":37.857},{"city":"忻州","id":302,"level":2,"province":"山西","seq":0,"x":112.549,"y":37.857},{"city":"运城","id":303,"level":2,"province":"山西","seq":0,"x":112.549,"y":37.857},{"city":"阳泉","id":304,"level":2,"province":"山西","seq":0,"x":112.549,"y":37.857},{"city":"西安","id":306,"level":2,"province":"陕西","seq":0,"x":108.948,"y":34.2632},{"city":"安康","id":307,"level":2,"province":"陕西","seq":0,"x":108.948,"y":34.2632},{"city":"宝鸡","id":308,"level":2,"province":"陕西","seq":0,"x":108.948,"y":34.2632},{"city":"汉中","id":309,"level":2,"province":"陕西","seq":0,"x":108.948,"y":34.2632},{"city":"商洛","id":310,"level":2,"province":"陕西","seq":0,"x":108.948,"y":34.2632},{"city":"铜川","id":311,"level":2,"province":"陕西","seq":0,"x":108.948,"y":34.2632},{"city":"渭南","id":312,"level":2,"province":"陕西","seq":0,"x":108.948,"y":34.2632},{"city":"咸阳","id":313,"level":2,"province":"陕西","seq":0,"x":108.948,"y":34.2632},{"city":"延安","id":314,"level":2,"province":"陕西","seq":0,"x":108.948,"y":34.2632},{"city":"榆林","id":315,"level":2,"province":"陕西","seq":0,"x":108.948,"y":34.2632},{"city":"成都","id":317,"level":2,"province":"四川","seq":0,"x":104.066,"y":30.6595},{"city":"绵阳","id":318,"level":2,"province":"四川","seq":0,"x":104.066,"y":30.6595},{"city":"资阳","id":319,"level":2,"province":"四川","seq":0,"x":104.066,"y":30.6595},{"city":"巴中","id":320,"level":2,"province":"四川","seq":0,"x":104.066,"y":30.6595},{"city":"德阳","id":321,"level":2,"province":"四川","seq":0,"x":104.066,"y":30.6595},{"city":"达州","id":322,"level":2,"province":"四川","seq":0,"x":104.066,"y":30.6595},{"city":"广安","id":323,"level":2,"province":"四川","seq":0,"x":104.066,"y":30.6595},{"city":"广元","id":324,"level":2,"province":"四川","seq":0,"x":104.066,"y":30.6595},{"city":"乐山","id":325,"level":2,"province":"四川","seq":0,"x":104.066,"y":30.6595},{"city":"泸州","id":326,"level":2,"province":"四川","seq":0,"x":104.066,"y":30.6595},{"city":"眉山","id":327,"level":2,"province":"四川","seq":0,"x":104.066,"y":30.6595},{"city":"内江","id":328,"level":2,"province":"四川","seq":0,"x":104.066,"y":30.6595},{"city":"南充","id":329,"level":2,"province":"四川","seq":0,"x":104.066,"y":30.6595},{"city":"攀枝花","id":330,"level":2,"province":"四川","seq":0,"x":104.066,"y":30.6595},{"city":"遂宁","id":331,"level":2,"province":"四川","seq":0,"x":104.066,"y":30.6595},{"city":"宜宾","id":332,"level":2,"province":"四川","seq":0,"x":104.066,"y":30.6595},{"city":"雅安","id":333,"level":2,"province":"四川","seq":0,"x":104.066,"y":30.6595},{"city":"自贡","id":334,"level":2,"province":"四川","seq":0,"x":104.066,"y":30.6595},{"city":"阿坝","id":335,"level":2,"province":"四川","seq":0,"x":104.066,"y":30.6595},{"city":"甘孜","id":336,"level":2,"province":"四川","seq":0,"x":104.066,"y":30.6595},{"city":"凉山","id":337,"level":2,"province":"四川","seq":0,"x":104.066,"y":30.6595},{"city":"拉萨","id":339,"level":2,"province":"西藏","seq":0,"x":91.1322,"y":29.6604},{"city":"日喀则","id":340,"level":2,"province":"西藏","seq":0,"x":91.1322,"y":29.6604},{"city":"阿里","id":341,"level":2,"province":"西藏","seq":0,"x":91.1322,"y":29.6604},{"city":"昌都","id":342,"level":2,"province":"西藏","seq":0,"x":91.1322,"y":29.6604},{"city":"林芝","id":343,"level":2,"province":"西藏","seq":0,"x":91.1322,"y":29.6604},{"city":"那曲","id":344,"level":2,"province":"西藏","seq":0,"x":91.1322,"y":29.6604},{"city":"山南","id":345,"level":2,"province":"西藏","seq":0,"x":91.1322,"y":29.6604},{"city":"乌鲁木齐","id":347,"level":2,"province":"新疆","seq":0,"x":87.6177,"y":43.7928},{"city":"石河子","id":348,"level":2,"province":"新疆","seq":0,"x":87.6177,"y":43.7928},{"city":"吐鲁番","id":349,"level":2,"province":"新疆","seq":0,"x":87.6177,"y":43.7928},{"city":"伊犁","id":350,"level":2,"province":"新疆","seq":0,"x":87.6177,"y":43.7928},{"city":"阿克苏","id":351,"level":2,"province":"新疆","seq":0,"x":87.6177,"y":43.7928},{"city":"阿勒泰","id":352,"level":2,"province":"新疆","seq":0,"x":87.6177,"y":43.7928},{"city":"巴音","id":353,"level":2,"province":"新疆","seq":0,"x":87.6177,"y":43.7928},{"city":"博尔塔拉","id":354,"level":2,"province":"新疆","seq":0,"x":87.6177,"y":43.7928},{"city":"昌吉","id":355,"level":2,"province":"新疆","seq":0,"x":87.6177,"y":43.7928},{"city":"哈密","id":356,"level":2,"province":"新疆","seq":0,"x":87.6177,"y":43.7928},{"city":"和田","id":357,"level":2,"province":"新疆","seq":0,"x":87.6177,"y":43.7928},{"city":"喀什","id":358,"level":2,"province":"新疆","seq":0,"x":87.6177,"y":43.7928},{"city":"克拉玛依","id":359,"level":2,"province":"新疆","seq":0,"x":87.6177,"y":43.7928},{"city":"克孜勒","id":360,"level":2,"province":"新疆","seq":0,"x":87.6177,"y":43.7928},{"city":"塔城","id":361,"level":2,"province":"新疆","seq":0,"x":87.6177,"y":43.7928},{"city":"昆明","id":363,"level":2,"province":"云南","seq":0,"x":102.712,"y":25.0406},{"city":"玉溪","id":364,"level":2,"province":"云南","seq":0,"x":102.712,"y":25.0406},{"city":"楚雄","id":365,"level":2,"province":"云南","seq":0,"x":102.712,"y":25.0406},{"city":"大理","id":366,"level":2,"province":"云南","seq":0,"x":102.712,"y":25.0406},{"city":"红河","id":367,"level":2,"province":"云南","seq":0,"x":102.712,"y":25.0406},{"city":"曲靖","id":368,"level":2,"province":"云南","seq":0,"x":102.712,"y":25.0406},{"city":"西双版纳","id":369,"level":2,"province":"云南","seq":0,"x":102.712,"y":25.0406},{"city":"昭通","id":370,"level":2,"province":"云南","seq":0,"x":102.712,"y":25.0406},{"city":"保山","id":371,"level":2,"province":"云南","seq":0,"x":102.712,"y":25.0406},{"city":"德宏","id":372,"level":2,"province":"云南","seq":0,"x":102.712,"y":25.0406},{"city":"迪庆","id":373,"level":2,"province":"云南","seq":0,"x":102.712,"y":25.0406},{"city":"丽江","id":374,"level":2,"province":"云南","seq":0,"x":102.712,"y":25.0406},{"city":"临沧","id":375,"level":2,"province":"云南","seq":0,"x":102.712,"y":25.0406},{"city":"怒江","id":376,"level":2,"province":"云南","seq":0,"x":102.712,"y":25.0406},{"city":"普洱","id":377,"level":2,"province":"云南","seq":0,"x":102.712,"y":25.0406},{"city":"文山","id":378,"level":2,"province":"云南","seq":0,"x":102.712,"y":25.0406},{"city":"杭州","id":380,"level":2,"province":"浙江","seq":0,"x":120.154,"y":30.2875},{"city":"宁波","id":381,"level":2,"province":"浙江","seq":0,"x":120.154,"y":30.2875},{"city":"嘉兴","id":382,"level":2,"province":"浙江","seq":0,"x":120.154,"y":30.2875},{"city":"绍兴","id":383,"level":2,"province":"浙江","seq":0,"x":120.154,"y":30.2875},{"city":"温州","id":384,"level":2,"province":"浙江","seq":0,"x":120.154,"y":30.2875},{"city":"舟山","id":385,"level":2,"province":"浙江","seq":0,"x":120.154,"y":30.2875},{"city":"湖州","id":386,"level":2,"province":"浙江","seq":0,"x":120.154,"y":30.2875},{"city":"金华","id":387,"level":2,"province":"浙江","seq":0,"x":120.154,"y":30.2875},{"city":"丽水","id":388,"level":2,"province":"浙江","seq":0,"x":120.154,"y":30.2875},{"city":"台州","id":389,"level":2,"province":"浙江","seq":0,"x":120.154,"y":30.2875},{"city":"衢州","id":390,"level":2,"province":"浙江","seq":0,"x":120.154,"y":30.2875},{"city":"香港","id":392,"level":2,"province":"香港","seq":0,"x":114.173,"y":22.32},{"city":"澳门","id":394,"level":2,"province":"澳门","seq":0,"x":113.549,"y":22.199},{"city":"台湾","id":396,"level":2,"province":"台湾","seq":0,"x":121.509,"y":25.0443}]}';
        $result = \GuzzleHttp\json_decode($cities, true);
//        var_dump($result);
        foreach($result['tngou'] as $city) {
            TNCity::create($city);
        }
        echo 'finished';
    }

    public function getRecipes() {
        $recipes = 108679;
        $client = new Client();
        for($recipe=103985; $recipe<= $recipes; $recipe++) {
            $url = "http://www.tngou.net/api/cook/show?id=".$recipe;
            $res = $client->request('GET', $url);
            $result = \GuzzleHttp\json_decode($res->getBody(), true);
            if(count($result) > 5)
                TNRecipe::create($result);
        }
        echo 'finished';
    }

    public function getFoods() {
        $foods = 1599;
        $client = new Client();
        for($food=1; $food<= $foods; $food++) {
            $url = "http://www.tngou.net/api/food/show?id=".$food;
            $res = $client->request('GET', $url);
            $result = \GuzzleHttp\json_decode($res->getBody(), true);
            if(count($result) > 5)
                TNFood::create($result);
        }
        echo 'finished';
    }

    public function getLores() {
        $lores = 21049;
        $client = new Client();
        for($lore=1; $lore<= $lores; $lore++) {
            $url = "http://www.tngou.net/api/lore/show?id=".$lore;
            $res = $client->request('GET', $url);
            $result = \GuzzleHttp\json_decode($res->getBody(), true);
            if(count($result) > 5)
                TNLore::create($result);
        }
        echo 'finished';
    }

    public function getAsks() {
        $asks = 2966;
        $client = new Client();
        for($ask=1; $ask<= $asks; $ask++) {
            $url = "http://www.tngou.net/api/ask/show?id=".$ask;
            $res = $client->request('GET', $url);
            $result = \GuzzleHttp\json_decode($res->getBody(), true);
            if(count($result) > 5)
                TNAsk::create($result);
        }
        echo 'finished';
    }

    public function getBooks() {
        $books = 2874;
        $client = new Client();
        for($book=1; $book<= $books; $book++) {
            $url = "http://www.tngou.net/api/book/show?id=".$book;
            $res = $client->request('GET', $url);
            $result = \GuzzleHttp\json_decode($res->getBody(), true);
            if(count($result) > 5) {
                TNBook::create($result);
                $list = $result['list'];
                for($i=count($list)-1; $i>=0; $i--) {
                   TNBookPage::create($list[$i]);
                }
            }

        }
        echo 'finished';
    }

    public function getDownloadImage($url, $fileType)
    {
//        //PDF file is stored under project/public/download/info.pdf
//        $file= public_path(). "/download/info.pdf";
//
//        $headers = array(
//            'Content-Type: application/pdf',
//        );
//
//        $filepath = public_path('uploads/image/')."abc.jpg";
//        return Response::download($filepath);
//
//        return Response::download($file, 'filename.pdf', $headers);

        $client = new Client();
        $mimeTypes = array(
            'image/png' => 'png',
            'image/jpg'=> 'jpeg',
            'image/jpg'=> 'jpg',
            'image/gif'=> 'gif'
        );

        $image = $client->request('GET', $url);
        var_dump($image);
//        $contentType = strtolower($image->getHeader('Content-Type'));
//        $fileExt= $mimeTypes[$contentType];
////
//////        if (array_key_exists($fileType, $mimeTypes) {
//        file_put_contents('image.'. $fileExt, $image->getBody());
//          echo 'Saved Image';
//////        }

    }


}
