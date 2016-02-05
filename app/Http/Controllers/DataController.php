<?php

namespace App\Http\Controllers;


use App\Http\RepositoryDB;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request;

class DataController extends Controller {


	public function setData() {
		$humidity = Request::input("h");
        $temperature = Request::input("t");
        $slaveName = Request::input("s");
        $addedOn = date("Y-m-d H:i:s");
        $methane = Request::input("m");
        $carbonMon = Request::input("cm");

        try {
            DB::insert("insert into humidities (slave_name, humidity, added_on) values (?,?,?)",[
                $slaveName,
                $humidity,
                $addedOn,
            ]);
            DB::insert("insert into temperatures (slave_name, temperature, added_on) values (?,?,?)",[
                $slaveName,
                $temperature,
                $addedOn,
            ]);
            if(isset($methane)) {
                DB::insert("insert into methane (methane_value, added_on) values (?,?)",[
                    $methane,
                    $addedOn,
                ]);
            }
            if(isset($carbonMon)) {
                DB::insert("insert into carbon_monoxide (carbon_value, added_on) values (?,?)",[
                    $carbonMon,
                    $addedOn,
                ]);
            }
            $data = array(
                "status" => "success"
            );
            header("Access-Control-Allow-Origin: *");
            return json_encode($data);
            }catch (QueryException $e) {
                $data = array(
                    "status" => $e->getMessage()
                );
                header("Access-Control-Allow-Origin: *");
                return json_encode($data);
            }

	}

	public function getHumidities() {
        $date = Request::input("date");
		$data = array();
        $query = "select slave_name, TRUNCATE(avg(humidity),1) as humidity, hour(added_on) as added_on, count(*) as numberOfLogs from humidities where added_on between '" . $date . "' and '" . $date . " 23:59:59' group by hour(added_on), slave_name";
        try {
            $res = DB::select($query);
            //$res = DB::table('humidities')->whereBetween('added_on', ["'".$date."'","'".$date." 23:59:59'"])->get();
            //var_dump($res);
            for ($i=0; $i<count($res); $i++) {
            	//var_dump($res[$i]->humidity);
            	//var_dump($res[$i]);
            	$row = array (
            		"humidity"=>$res[$i]->humidity,
            		"slave_name"=>$res[$i]->slave_name,
            		"added_on"=>$res[$i]->added_on,
                    "numberOfLogs"=>$res[$i]->numberOfLogs
            	);
            	array_push($data, $row);
            }
            header("Access-Control-Allow-Origin: *");
            return json_encode($data);
        }
        catch(QueryException $e) {
            $data = array(
                "status" => $e.getMessage()
            );
            header("Access-Control-Allow-Origin: *");
            return json_encode($data);
        }
    }

    public function getMethane() {
        $date = Request::input("date");
        $data = array();
        $query = "select TRUNCATE(avg(methane_value),1) as methane_value, hour(added_on) as added_on, count(*) as numberOfLogs from methane where added_on between '" . $date . "' and '" . $date . " 23:59:59' group by hour(added_on)";
        try {
            $res = DB::select($query);
            //$res = DB::table('humidities')->whereBetween('added_on', ["'".$date."'","'".$date." 23:59:59'"])->get();
            //var_dump($res);
            for ($i=0; $i<count($res); $i++) {
                //var_dump($res[$i]->humidity);
                //var_dump($res[$i]);
                $row = array (
                    "methane_value"=>$res[$i]->methane_value,
                    "added_on"=>$res[$i]->added_on,
                    "numberOfLogs"=>$res[$i]->numberOfLogs
                );
                array_push($data, $row);
            }
            header("Access-Control-Allow-Origin: *");
            return json_encode($data);
        }
        catch(QueryException $e) {
            $data = array(
                "status" => $e.getMessage()
            );
            header("Access-Control-Allow-Origin: *");
            return json_encode($data);
        }
    }

    public function getTemperatures() {
        $date = Request::input("date");
        $data = array();
        $query = "select slave_name, TRUNCATE(avg(temperature),1) as temperature, hour(added_on) as added_on, count(*) as numberOfLogs from temperatures where added_on between '" . $date . "' and '" . $date . " 23:59:59' group by hour(added_on), slave_name";
		$data = array();
        try {
            $res = DB::select($query);
            for ($i=0; $i<count($res); $i++) {
            	$row = array (
            		"temperature"=>$res[$i]->temperature,
            		"slave_name"=>$res[$i]->slave_name,
            		"added_on"=>$res[$i]->added_on,
                    "numberOfLogs"=>$res[$i]->numberOfLogs
            	);
            	array_push($data, $row);
            }
            header("Access-Control-Allow-Origin: *");
            return json_encode($data);
        }
        catch(QueryException $e) {
            $data = array(
                "status" => $e.getMessage()
            );
            header("Access-Control-Allow-Origin: *");
            return json_encode($data);
        }
    }
}