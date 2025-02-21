<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ExchangeRate;
use Illuminate\Http\JsonResponse;

class CurrencyConvertController extends Controller
{
    public function convert(Request $request): JsonResponse
    {
        try {
            // Validate input
            $request->validate([
                'amount' => 'required|numeric|min:0.01',
            ]);

            // Fetch exchange rate from database
            $exchangeRate = ExchangeRate::where('from', 'SGD')
                                        ->where('to', 'PLN')
                                        ->first();

            // If rate not found, return error
            if (!$exchangeRate) {
                return response()->json(['error' => 'Exchange rate not available at this moment'], 404);
            }

            // Calculate converted amount
            $convertedAmount = $request->amount * $exchangeRate->rate;

            return response()->json([
                'success' => true,
                'message' => 'Currency converted successfully',
                'data' => [
                    'amount' => $request->amount,
                    'from' => 'SGD',
                    'to' => 'PLN',
                    'exchange_rate' => $exchangeRate->rate,
                    'converted_amount' => round($convertedAmount, 2),
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => "An error occurred while converting currency.",
                'error' => $e->getMessage(),
            ], 422);
        }
    }
}
