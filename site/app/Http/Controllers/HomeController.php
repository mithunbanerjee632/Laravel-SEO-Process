<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\VisitorModel;
use App\Models\ServicesModel;
use App\Models\CourseModel;
use App\Models\ProjectModel;
use App\Models\ContactModel;
use App\Models\ReviewModel;
use App\Models\SeoHomeModel;

use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\TwitterCard;
use Artesaos\SEOTools\Facades\JsonLd;

class HomeController extends Controller
{
    function HomeIndex(){

        $HomeSeo = SeoHomeModel::all();
        SEOMeta::setTitle($HomeSeo[0]['title']);
        SEOMeta::setDescription($HomeSeo[0]['description']);
        SEOMeta::setCanonical('https://mithun.com');

        OpenGraph::setDescription($HomeSeo[0]['share_title']);
        OpenGraph::setTitle($HomeSeo[0]['description']);
        OpenGraph::setUrl('https://mithun.com');
        OpenGraph::addProperty('type', 'articles');

        TwitterCard::setTitle($HomeSeo[0]['share_title']);
        TwitterCard::setSite('@mithunbanerjee62');

        JsonLd::setTitle($HomeSeo[0]['share_title']);
        JsonLd::setDescription($HomeSeo[0]['description']);
        JsonLd::addImage($HomeSeo[0]['page_img']);






        $UserIP =$_SERVER['REMOTE_ADDR'];
        date_default_timezone_set("Asia/Dhaka");
        $timeDate =date("Y-m-d h:i:sa");

        VisitorModel::insert(['ip_address'=>$UserIP,'visit_time'=> $timeDate]);

        $servicesData = json_decode(ServicesModel::all());
        $courseData = json_decode(CourseModel::orderBy('id','desc')->limit('6')->get());
        $ProjectData=json_decode(ProjectModel::orderBy('id','desc')->limit('10')->get());
        $ReviewData = json_decode(ReviewModel::all());

        return view('Home',[
            'servicesData'=>$servicesData,
            'courseData'=>$courseData,
            'ProjectData'=>$ProjectData,
            'ReviewData'=>$ReviewData
        ]);
    }


    function ContactSend(Request $request){
       $contact_name =  $request->input('contact_name');
       $contact_mobile =  $request->input('contact_mobile');
       $contact_email =  $request->input('contact_email');
       $contact_msg =  $request->input('contact_msg');

       $result = ContactModel::insert([

           'contact_name'=> $contact_name,
           'contact_mobile'=> $contact_mobile,
           'contact_email'=> $contact_email,
           'contact_msg'=> $contact_msg
       ]);

       if($result == true){
           return 1;
       }else{
           return 0;
       }
    }
}
