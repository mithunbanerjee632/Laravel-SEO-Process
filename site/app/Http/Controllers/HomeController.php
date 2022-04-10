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

        $actual_link = "http:://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        $homeLink = "http:://$_SERVER[HTTP_HOST]";
        $homeTitle = $HomeSeo[0]['title'];
        $homeShareTitle = $HomeSeo[0]['share_title'];
        $homeDescription = $HomeSeo[0]['description'];
        $homeKeywords = $HomeSeo[0]['keywords'];
        $homeImage = $homeLink."/".$HomeSeo[0]['page_img'];

       //google
        SEOMeta::setTitle($homeTitle);
        SEOMeta::setDescription($homeDescription);
        //SEOMeta::addMeta('article:published_time', $post->published_date->toW3CString(), 'property');
        //SEOMeta::addMeta('article:section', $post->category, 'property');
        SEOMeta::addKeyword($homeKeywords);
        SEOMeta::setCanonical($actual_link);
       
        //facebook

       // OpenGraph::addProperty($key, $value); // value can be string or array
        OpenGraph::addImage($homeImage); // add image url
        //OpenGraph::addImages($url); // add an array of url images
        OpenGraph::setTitle($homeTitle); // define title
        OpenGraph::setDescription($homeDescription);  // define description
        OpenGraph::setUrl($actual_link); // define url
        OpenGraph::setSiteName($homeShareTitle); //define site_name

        //twitter

        //TwitterCard::addValue($key, $value); // value can be string or array
        //TwitterCard::setType($type); // type of twitter card tag
        TwitterCard::setTitle($homeTitle); // title of twitter card tag
        TwitterCard::setSite($homeLink); // site of twitter card tag
        TwitterCard::setDescription($homeDescription); // description of twitter card tag
        TwitterCard::setUrl($actual_link); // url of twitter card tag
        TwitterCard::setImage($homeImage); // add image url




        //json ld
       // JsonLd::addValue($key, $value); // value can be string or array
        //JsonLd::setType($type); // type of twitter card tag
        JsonLd::setTitle($homeTitle); // title of twitter card tag
        JsonLd::setSite($actual_link); // site of twitter card tag
        JsonLd::setDescription($homeDescription); // description of twitter card tag
        JsonLd::setUrl($actual_link); // url of twitter card tag
        JsonLd::setImage($homeImage); // add image ur




        // SEOMeta::setTitle($HomeSeo[0]['title']);
        // SEOMeta::setDescription($HomeSeo[0]['description']);
        // SEOMeta::setCanonical('https://mithun.com');

        // OpenGraph::setDescription($HomeSeo[0]['share_title']);
        // OpenGraph::setTitle($HomeSeo[0]['description']);
        // OpenGraph::setUrl('https://mithun.com');
        // OpenGraph::addProperty('type', 'articles');

        // TwitterCard::setTitle($HomeSeo[0]['share_title']);
        // TwitterCard::setSite('@mithunbanerjee62');

        // JsonLd::setTitle($HomeSeo[0]['share_title']);
        // JsonLd::setDescription($HomeSeo[0]['description']);
        // JsonLd::addImage($HomeSeo[0]['page_img']);



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
