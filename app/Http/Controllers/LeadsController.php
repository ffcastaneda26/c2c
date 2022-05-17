<?php

namespace App\Http\Controllers;

use App\Models\Lead;


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
            'phone'         => $phone,
            'email'         => $email
        ]);

        $this->send_to_neo($lead);
        return true;

    }


    /*+----------------------------------------+
      | Envía a NEO y marca como enviado       |
      +----------------------------------------+
    */
    private function send_to_neo(Lead $lead){
       $lead->updateSent_To_Neo();
    }
}
