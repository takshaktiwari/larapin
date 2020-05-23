<?php

namespace App\Http\Controllers;

use Storage;
use App\Exports\ProductsExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;

class ExportController extends Controller
{

	public function exports()
	{
	    $files = Storage::allFiles('exports');
	    return view('admin/exports')->with('files', $files);
	}

	public function export_products()
	{
	    set_time_limit(0);
	    (new ProductsExport)->store('exports/products-'.date('d-M-Y H:i:s').'.xlsx');
	    return back()->withErrors('Export started!');
	}

    public function download(Request $request)
    {
    	return Storage::download($request->input('file'));
    }

    public function destroy(Request $request)
    {
    	Storage::delete($request->input('file'));
    	return back()->withErrors('DELETED !! File is successfully deleted');
    }

}
