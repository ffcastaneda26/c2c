<?php

namespace App\Http\Controllers;


use App\Models\Lead;
use Illuminate\Support\Facades\Http;

use GuzzleHttp\Exception\RequestException;

class LeadsController extends Controller
{
    /*+---------------------------------------------------------+
      | Recibe datos de prospectos y los graba en tabla leads   |
      +---------------------------------------------------------+
     */

    public function receive_leads(){

        $campaign_name  = isset($_POST['campaign_name'])    ? $_POST['campaign_name'] : null;
        $name           = isset($_POST['name'])             ? $_POST['name'] : null;
        $last_name      = isset($_POST['last_name'])        ? $_POST['last_name'] : null;
        $phone          = isset($_POST['phone'])            ? $_POST['phone'] : null;
        $email          = isset($_POST['email'])            ? $_POST['email'] : null;


        $lead = Lead::create([
            'campaign_name' => $campaign_name,
            'name'          => $name,
            'last_name'     => $last_name,
            'email'         => $email,
            'phone'         => $phone
        ]);

        return $this->send_to_neo($lead);

    }

    /*+----------------------------------------+
      | Envía a NEO y marca como enviado       |
      +----------------------------------------+
    */
    public function send_to_neo(Lead $lead=Null){

      try {
            $response = Http::withHeaders([
                'Connection' => 'keep-alive',
                'Access-Token' => 'dRfgmuyehzDmagMcz62wrRiqa',
                'Content-Type' => 'application/json',
                'Accept' => 'application/json'])
            ->post('https://api.neoverify.com/v1/add_lead/', [
                        "referral_source"     => "Ahava",
                        "campaign"            => $lead->campaign_name,
                        "applicant" => [
                            "first_name"        => $lead->name,
                            "last_name"         => $lead->last_name,
                            "email_address"     => $lead->email,
                            "cell_phone_number" => $lead->phone,
                            "home_phone_number" => $lead->phone,
                            "work_phone_number" => $lead->phone,
                    ]

                ]);
        $lead->updateSent_To_Neo();
        return $response->json();
        } catch (RequestException $ex) {
            $this->lead->updateSent_To_Neo(false);
            return response()->json(['error' => $ex->getMessage()], 500);
        }

    }



}
