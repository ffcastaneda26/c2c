<?php

namespace App\Http\Controllers;

use Throwable;
use App\Models\Lead;
use App\Imports\LeadsImport;



use App\Imports\InventoryImport;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Maatwebsite\Excel\Facades\Excel;
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


        switch ($campaign_name) {
            case '12093493':
                $campaign_name = 'landing_Ads_0Interest';
                break;

            case '2578627':
                $campaign_name = 'Fathers Day Promo';
                break;

            case '12146491':
                $campaign_name = 'Fathers-Day-Astros';
                break;

            case '12147205':
                $campaign_name = 'Día del Padre';
                break;

            case '12093493':
                $campaign_name = '0% English';
                break;

            case '12147187':
                $campaign_name = '0% Español';
                break;

            case '12146491':
                $campaign_name = 'Astros';
                break;

            case '12147390':
                $campaign_name = 'Fathers Day';
                break;

            case '12147453':
                $campaign_name = 'Skipe Line';
                break;

            case '12150753':
                $campaign_name = 'Salta La Fila';
                break;

        }



        $lead = Lead::create([
            'campaign_name' => $campaign_name,
            'name'          => $name,
            'last_name'     => $last_name,
            'email'         => $email,
            'phone'         => $phone
        ]);

        // return response()->json([
        //     'campaign_name' => $lead->campaign_name,
        //     'name'          => $lead->name,
        //     'last_name'     => $lead->last_name,
        //     'email'         => $lead->email,
        //     'phone'         => $lead->phonephp
        // ]);

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
                        "advertising_source"    => $lead->campaign_name,
                        "referral_source"       => "Ahava",
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

        $lead->neo_id = $response;
        $lead->save();
        return $response->json();
        } catch (RequestException $ex) {
            $this->lead->updateSent_To_Neo(false);
            return response()->json(['error' => $ex->getMessage()], 500);
        }

    }

    /*+----------------------------------------+
      | Consulta de Leads x Fecha              |
      +----------------------------------------+
    */

    public function query_leads(){
        $records =DB::table('leads')
        ->select(DB::raw('DATE(created_at) as date'), DB::raw('count(*) as total'))
        ->groupBy('date')
        ->get();
        return view('leads.form', [
                'records' => $records,
        ]);
    }

    public function test_api(){
        return $_POST;
    }

    /*+----------------------------------------+
      | Envía a Neo Registros Pendientes       |
      +----------------------------------------+
    */

    public function send_to_neo_pending_records(){
        $leads = Lead::PendingSendToNeo('sent_to_neo','0')->get();

        if($leads->count()){
            foreach($leads as $lead){
                $this->send_to_neo($lead);
            }
            return 'Se han enviado ' . $leads->count() . ' Registros a Neo';
        }else{
            return 'No hay Registros Pendientes de Enviar a Neo';
        }

    }

    /*+----------------------------------------+
      | Formulario para subir archivo Excel    |
      +----------------------------------------+
    */

    public function leads_import_view(){
        $records = Lead::PendingSendToNeo()->paginate(10);
        return view('leads.leads_import',compact('records'));
    }


    public function leads_import_file(){

        try {
            Excel::import(new LeadsImport,request()->file('file'));


            $records = Lead::PendingSendToNeo()->paginate(10);
            return view('leads_import',compact('records'))->with('message',__('Leads have been Imported'));


        } catch (Throwable $e) {
            report($e);
            return back()->with(['error',__('Leads were not Imported'),]);
        }
    }
}
