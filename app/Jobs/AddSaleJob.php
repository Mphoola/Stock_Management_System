<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Sale;

class AddSaleJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(Request $request)
    {
        echo "job has been dispatched";
        $sale = Sale::create([
            'user_id' => auth()->id(),
            'total' => $request->total,
            'customer_name' => $request->customer_name,
            'customer_email' => $request->customer_email,
            'customer_phone' => $request->customer_phone,
            'customer_address' => $request->customer_address,
        ]);

        $sale->saleItems()->createMany($request->saleItems);

        foreach ($request->saleItems as $saleItem) {

            $product = Product::find($saleItem['product_id']);

            $product->decrement('stock', $saleItem['quantity']);

        }
        echo "job has been completed";
    }
}
