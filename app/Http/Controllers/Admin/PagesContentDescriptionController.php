<?php

namespace App\Http\Controllers\Admin;


use App\Model\BdtdcPageContentCategory;
use Illuminate\Http\Request;
use App\Model\BdtdcPageContentDescription;
use App\Model\BdtdcPage;
use App\Http\Requests\ContentDescriptionRequest;
use Validator;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use DB;

class PagesContentDescriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function __construct()
    {
        ini_set('memory_limit', '9999999M');
    }
    public function index()
    {
//        $descriptions = DB::table('bdtdc_pages as P')
//                        ->join('bdtdc_page_content_descriptions as PCD', 'P.id', '=', 'PCD.page_id')
//                        ->join('bdtdc_page_content_categories as PC', 'PCD.content_category_id', '=', 'PC.id')
//                        ->get();
        $descriptions = BdtdcPageContentDescription::with('bdtdc_category')->get();
        return view('protected.admin.content_descriptions.description-lists',compact('descriptions'));
//        return($descriptions);
//        return $descriptions[0]->bdtdc_page->name;

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $pages = BdtdcPage::all();
        $categories = BdtdcPageContentCategory::whereNotIn('parent_id',[0])->get();
        // dd($categories);
        return view('protected.admin.content_descriptions.description-add',compact('pages', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request)
    {
        $rules = ['desc_name' => 'required',
            'page_category_id' => 'required',
            'content_category_id' => 'required'];
        $validator = Validator::make($request->all(),$rules);
        if ($validator->fails())
        {
            return redirect::back()
                        ->withErrors($validator);
        }

        $insert_data = [
            'description' => $request->desc_name,
            'meta_key' => $request->meta_key,
            'meta_description' => $request->meta_description,
            'content_category_id' => $request->content_category_id,
            'page_id' => $request->page_category_id,
        ];
       // dd($insert_data);
        DB::table('bdtdc_page_content_descriptions')->insert($insert_data);
        return redirect()->route('admin.description-manage')->with('flash_message', 'Description Added');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit(Request $request, $id)
    {
        $description = BdtdcPageContentDescription::with('bdtdc_category')
                            ->where('id', $id)
                            ->get();
        $pages = BdtdcPage::all();
        $contents = BdtdcPageContentCategory::all();
        //return $description[0]->bdtdc_page->id;
        return view('protected.admin.content_descriptions.description-edit',compact('description','pages','contents'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $rules = ['desc_name' => 'required',
            'page_category_id' => 'required',
            'content_category_id' => 'required'];
        $validator = Validator::make($request->all(),$rules);
        if ($validator->fails())
        {
            return redirect::back()
                        ->withErrors($validator);
        }
        $update_data = [
            'description' => $request->desc_name,
            'meta_key' => $request->page_category_id,
            'meta_description' => $request->meta_description,
            'content_category_id' => $request->content_category_id,
            'page_id' => $request->page_category_id,
        ];
        //dd($update_data);
        DB::table('bdtdc_page_content_descriptions')->where('id', $id)->update($update_data);
        return redirect()->route('admin.description-manage')->with('flash_message', 'Updated!!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function delete($id)
    {
        BdtdcPageContentDescription::find($id)->delete();
        return redirect()->route('admin.description-manage')->with('flash_message', 'Description Information deleted');
    }
}
