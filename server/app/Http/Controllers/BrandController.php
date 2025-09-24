<?php
namespace App\Http\Controllers;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class BrandController extends Controller
{
    public function index(Request $request)
    {
        // Get CF-IPCountry header set by Cloudflare based on user's IP
        $country = $request->header('CF-IPCountry', null);
        Log::info('CF-IPCountry header received for toplist filtering', ['country' => $country]);

        // Validate ISO-2 code (two uppercase letters)
        $validCountry = $country && preg_match('/^[A-Z]{2}$/', strtoupper($country));
        if (!$validCountry) {
            Log::info('Invalid or missing CF-IPCountry, returning default toplist');
        }

        $countryBrands = $validCountry
            ? Brand::where('country_code', strtoupper($country))->orderBy('rating', 'desc')->get()
            : collect([]);

        $otherBrands = $validCountry
            ? Brand::where(function ($query) use ($country) {
                $query->whereNull('country_code')
                      ->orWhere('country_code', '!=', strtoupper($country));
            })->orderBy('rating', 'desc')->get()
            : Brand::orderBy('rating', 'desc')->get();

        $brands = $countryBrands->merge($otherBrands);

        $brands = $brands->values()->map(function ($brand, $index) {
            $brand->rank = $index + 1;
            if (!filter_var($brand->brand_image, FILTER_VALIDATE_URL)) {
                $brand->brand_image = asset('images/brands/' . $brand->brand_image);
            }
            return $brand;
        });

        return response()->json($brands);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'brand_name' => 'required|string',
            'brand_image' => 'required|string',
            'rating' => 'required|integer|min:1|max:5',
            'country_code' => 'nullable|string|regex:/^[A-Z]{2}$/',
            'bonus' => 'nullable|string',
            'terms' => 'nullable|string',
            'link' => 'nullable|url',
        ]);

        if ($validated['country_code']) {
            $validated['country_code'] = strtoupper($validated['country_code']);
        }

        $brand = Brand::create($validated);
        if (!filter_var($brand->brand_image, FILTER_VALIDATE_URL)) {
            $brand->brand_image = asset('images/brands/' . $brand->brand_image);
        }
        return response()->json($brand, 201);
    }

    public function show($id)
    {
        $brand = Brand::findOrFail($id);
        if (!filter_var($brand->brand_image, FILTER_VALIDATE_URL)) {
            $brand->brand_image = asset('images/brands/' . $brand->brand_image);
        }
        return response()->json($brand);
    }

    public function update(Request $request, $id)
    {
        $brand = Brand::findOrFail($id);
        $validated = $request->validate([
            'brand_name' => 'string',
            'brand_image' => 'string',
            'rating' => 'integer|min:1|max:5',
            'country_code' => 'nullable|string|regex:/^[A-Z]{2}$/',
            'bonus' => 'nullable|string',
            'terms' => 'nullable|string',
            'link' => 'nullable|url',
        ]);

        if (isset($validated['country_code'])) {
            $validated['country_code'] = strtoupper($validated['country_code']);
        }

        $brand->update($validated);
        if (!filter_var($brand->brand_image, FILTER_VALIDATE_URL)) {
            $brand->brand_image = asset('images/brands/' . $brand->brand_image);
        }
        return response()->json($brand);
    }

    public function destroy($id)
    {
        Brand::findOrFail($id)->delete();
        return response()->json(null, 204);
    }
}