<?php
namespace App\Jobs;

use App\Models\Website;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use App\Mail\WebsiteDownMail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class CheckWebsiteStatus implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function handle()
    {
        $websites = Website::all();
        Log::info('Starting website status check for ' . $websites->count() . ' websites');

        foreach ($websites as $website) {
           $wasUp = $website->is_up;
           
           try {
                $response = Http::timeout(5)->get($website->url);

                if ($response->successful()) {
                    $website->update(['is_up' => true]);
                } else {
                    throw new \Exception("HTTP status: " . $response->status());
                }

            } catch (\Exception $e) {
                
                $website->update(['is_up' => false]);
               
                if ($wasUp == 0) {
                   
                    Mail::to($website->client->email)
                        ->send(new WebsiteDownMail($website));   
                //     Mail::to($website->client->email)
                // ->queue(new WebsiteDownMail($website));                
                }

                Log::error("Website down: {$website->url} | {$e->getMessage()}");
            }
        }
        Log::info('Website status check completed');
    }
}