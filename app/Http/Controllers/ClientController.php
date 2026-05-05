<?php
namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use App\Models\Website;
use App\Mail\WebsiteDownMail;
class ClientController extends Controller
{
    public function index()
    {
        return Client::all();
    }

    public function checkWebsites()
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

    public function websites($id)
    {
        return Client::with('websites')->findOrFail($id);
    }
}