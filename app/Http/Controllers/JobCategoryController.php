<?php

namespace App\Http\Controllers;

use App\Models\JobCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class JobCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
       $this->middleware(['auth', 'admin']);
    }


    public function index()
    {
        $categories = DB::table('job_category')->get();
        // $categories = JobCategory::all();
        // dd($categories);
        return view('admin.jobcategories.index', compact('categories'))->with('i');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.jobcategories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validation = $request->validate([
            'code'      =>'required|unique:job_category|max:4',
            'order_id'  =>'nullable|integer',
            'total_post' =>'nullable|integer',
            'active_post' =>'nullable|integer',

        ]);


        $logo = $request->file('logo');
        $icon = $request->file('icon');
        $banner = $request->file('banner');

        if ($logo) {
            $logo_name      = hexdec(uniqid()). '.' .strtolower($logo->getClientOriginalExtension());
            $upload_path    = 'media/jobcategory/';
            $logo_url       = $upload_path.$logo_name;
            $uploaded       = $logo->move($upload_path,$logo_name);
            $jobcategory['logo']   = $logo_url;
        }
        if ($icon) {
            $icon_name      = hexdec(uniqid()). '.' .strtolower($icon->getClientOriginalExtension());
            $upload_path    = 'media/jobcategory/';
            $icon_url       = $upload_path.$icon_name;
            $uploaded       = $icon->move($upload_path,$icon_name);
            $jobcategory['icon']   = $icon_url;
        }
        if ($banner) {
            $banner_name      = hexdec(uniqid()). '.' .strtolower($banner->getClientOriginalExtension());
            $upload_path    = 'media/jobcategory/';
            $banner_url       = $upload_path.$banner_name;
            $uploaded       = $banner->move($upload_path,$banner_name);
            $jobcategory['banner']   = $banner_url;
        }


        $jobcategory['name']              = $request->name;
        $jobcategory['code']            = $request->code;
        $jobcategory['description']        = $request->description;
        $jobcategory['url_slug']           = $request->url_slug ;
        $jobcategory['seo_des']                = $request->seo_des;
        $jobcategory['is_top']            = $request->is_top;
        $jobcategory['is_new']          = $request->is_new;
        $jobcategory['is_feature']            = $request->is_feature;
        $jobcategory['comments']               = $request->comments;
        $jobcategory['total_post']   = $request->total_post;
        $jobcategory['active_post']           = $request->active_post;
        $jobcategory['order_id']         = $request->order_id;
        // dd($jobcategory);
        DB::table('job_category')->insert($jobcategory);
        return redirect()->route('jobcategories.index')->with('success', 'Added Successfully');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $jobcategory = DB::table('job_category')->where('pk_no', $id)->first();
        return view('admin.jobcategories.show', compact('jobcategory'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $jobcategory = DB::table('job_category')->where('pk_no', $id)->first();
        return view('admin.jobcategories.edit', compact('jobcategory'));

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
        $validation = $request->validate([
            'code' =>'required',
            'order_id' =>'nullable|integer',
            'total_post' =>'nullable|integer',
            'active_post' =>'nullable|integer',

        ]);

        $logo = $request->file('logo');
        $icon = $request->file('icon');
        $banner = $request->file('banner');

        if ($logo) {
            $logo_name      = hexdec(uniqid()). '.' .strtolower($logo->getClientOriginalExtension());
            $upload_path    = 'media/jobcategory/';
            $logo_url       = $upload_path.$logo_name;
            $uploaded       = $logo->move($upload_path,$logo_name);
            $jobcategory['logo']   = $logo_url;
        }
        if ($icon) {
            $icon_name      = hexdec(uniqid()). '.' .strtolower($icon->getClientOriginalExtension());
            $upload_path    = 'media/jobcategory/';
            $icon_url       = $upload_path.$icon_name;
            $uploaded       = $icon->move($upload_path,$icon_name);
            $jobcategory['icon']   = $icon_url;
        }
        if ($banner) {
            $banner_name      = hexdec(uniqid()). '.' .strtolower($banner->getClientOriginalExtension());
            $upload_path    = 'media/jobcategory/';
            $banner_url       = $upload_path.$banner_name;
            $uploaded       = $banner->move($upload_path,$banner_name);
            $jobcategory['banner']   = $banner_url;
        }


        $jobcategory['name']              = $request->name;
        $jobcategory['code']            = $request->code;
        $jobcategory['description']        = $request->description;
        $jobcategory['url_slug']           = $request->url_slug ;
        $jobcategory['seo_des']                = $request->seo_des;
        $jobcategory['is_top']            = $request->is_top;
        $jobcategory['is_new']          = $request->is_new;
        $jobcategory['is_feature']            = $request->is_feature;
        $jobcategory['comments']               = $request->comments;
        $jobcategory['total_post']   = $request->total_post;
        $jobcategory['active_post']           = $request->active_post;
        $jobcategory['order_id']         = $request->order_id;
        // dd($jobcategory);
        DB::table('job_category')->where('pk_no', $id)->update($jobcategory);
        return redirect()->route('jobcategories.index')->with('success', 'Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // $data = DB::table('job_category')->where('pk_no', $id)->first();
        // $logo = $data->logo;
        // if ($logo != '') {
        //     unlink($logo);
        // }
        // $icon = $data->icon;
        // if ($icon) {
        //     unlink($icon);
        // }
        // $banner = $data->banner;
        // if ($banner) {
        //     unlink($banner);
        // }

        $jobcategory = DB::table('job_category')->where('pk_no', $id)->delete();
        return redirect()->route('jobcategories.index')->with('success', 'Deleted Successfully');
    }

    public function inactive($id)
    {
        DB::table('job_category')->where('pk_no', $id)->update(['is_active'=>0]);

        return redirect()->back()->with('success', 'Job Status Inactivated');
    }

    public function active($id)
    {
        DB::table('job_category')->where('pk_no', $id)->update(['is_active'=>1]);

        return redirect()->back()->with('success', 'Job Status Activated');
    }
}
