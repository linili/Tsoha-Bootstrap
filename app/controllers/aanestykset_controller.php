<?php
class AanestysController extends BaseController{
    public static function index(){
        $aanestykset = Aanestys::kaikki();
        View::make('aanestys/aanestys_list.html', array('aanestykset' => $aanestykset));
    }
    public static function show($id){
        $aanestys = Aanestys::etsi($id);
        View::make('aanestys/aanestys_list.html', array('aanestys' => $aanestys));
    }
}
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

