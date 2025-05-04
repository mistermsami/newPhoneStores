<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use PhpOffice\PhpSpreadsheet\IOFactory;

class ProductImportController extends Controller
{
    public function create()
    {
        return view('products.import');
    }

    public function store(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:xls,xlsx',
        ]);

        $the_file = $request->file('file');

        try {
            $spreadsheet = IOFactory::load($the_file->getRealPath());
            $sheet        = $spreadsheet->getActiveSheet();
            $row_limit    = $sheet->getHighestDataRow();
            $row_range    = range(2, $row_limit);
            $startcount = 2;
            $data = array();
            foreach ($row_range as $row) {
                $data[] = [
                    'name'          => $sheet->getCell('A' . $row)->getValue(),
                    'cost_price'          => $sheet->getCell('B' . $row)->getValue(),
                    'whole_sale_price'   => $sheet->getCell('C' . $row)->getValue(),
                    'sale_price'       => $sheet->getCell('D' . $row)->getValue(),
                    'quantity'          => $sheet->getCell('E' . $row)->getValue(),
                    'sku'      => $sheet->getCell('F' . $row)->getValue(),
                    "bar_code" => $sheet->getCell('G' . $row)->getValue(),
                    'item_type'  => $sheet->getCell('H' . $row)->getValue(),
                    'product_image' => $sheet->getCell('J' . $row)->getValue(),
                    'user_id' => auth()->id(),
                    'uuid' => Str::uuid(),
                ];
                $startcount++;
            }
            // foreach ($data as $product) {
            //     $data = Product::firstOrCreate([ 
            //         "sku" => $product["sku"],
            //     ], $product); 
            // }
            foreach ($data as $product) {
                $data = Product::updateOrCreate(
                    [
                        "sku" => $product["sku"],  // Condition to find existing record
                    ],
                    $product  // Data to update or create
                );
            }
        } catch (Exception $e) {
            throw $e;
            // $error_code = $e->errorInfo[1];
            return redirect()
                ->route('products.index')
                ->with('error', $e->getMessage());
        }

        return redirect()
            ->route('products.index')
            ->with('success', 'Data product has been imported!');
    }
}
