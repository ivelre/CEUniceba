<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
class ExcelController extends Controller
{
	private $exporterService = null;
	private $importerService = null;

	public function __construct()
    {
		$this->exporterService = new \App\Services\Excel\FastExcelExporter();
		$this->importerService = new \App\Services\Excel\FastExcelImporter();
    }


	public function index()
	{
		return view('private.admin.excel.index');
	}

	public function export()
	{
		$model = Input::get('model');
		return $this->exporterService->export($model);
	}

	public function import(Request $request)
	{
		$model = $request->model;
		$file = $request->excel;
		$result = $this->importerService->import($model, $file);
		
		return response()->json($result, 200);
	}
}
