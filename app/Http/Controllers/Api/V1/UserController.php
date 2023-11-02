<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Flow;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;


class UserController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try {
            $topic = DB::table('users')
                ->where('triidyPass', '=', $request->triidyPass)
                ->where('triidyUser', '=', $request->triidyUser)
                ->get();
                // ->where('commerse_code', '=', $request->ecommerceId)

            $array = array();
            if (!isset($topic)) {
                $array['status'] = '0';
                $array['status'] = 'Error al inciar sesión';
                
            }else{
                // echo $request->triidyPass.' - ';
                // echo $request->triidyUser.' - ';
                // exit;
                $array['status'] = '1';
                // $array['data'] = $topic;

                $flow = DB::table('flows')->where('userId', '=', $topic[0]->id)->get();
                $user = $topic[0];
                // print_r($user);
                $message = DB::table('flow_messages')
                                        ->where('flowid','=',$flow[0]->id)
                                        ->where('node_parent','=',$request->currentStatus)
                                        ->get();
                $type_element = $message[0]->type_element;
                $currentStatus = $message[0]->id;
                $message = $message[0]->message;

                $curl = curl_init();

                $variables['messaging_product'] = "whatsapp";
                $variables['to'] = "57".$request->telefonoComprador;

                $vector = array();
                $vectorwap = '';

                if ($type_element == 'template') {
                    $variables['type'] = "template";
                    $variables['template']['name'] = $message;
                    $variables['template']['language']['code'] = "es";

                    $vector['shop_name'] = $user->shop_name;
                    $vector['nombreProducto'] = $request->nombreProducto;
                    $vector['precioProducto'] = $request->precioProducto;
                    $vector['nombreComprador'] = $request->nombreComprador;
                    $vector['departamentoComprador'] = $request->departamentoComprador;
                    $vector['municipioComprador'] = $request->municipioComprador;
                    $vector['direccionComprador'] = $request->direccionComprador;
                    $vector['telefonoComprador'] = $request->telefonoComprador;

                    $vectorwap = json_encode($vector);

                }else{
                    $message = str_replace('[comercioNombre]', $user->shop_name, $message);
                    $message = str_replace('[nombreProducto]', $request->nombreProducto, $message);
                    $message = str_replace('[precioProducto]', $request->precioProducto, $message);
                    $message = str_replace('[nombreComprador]', $request->nombreComprador, $message);
                    $message = str_replace('[departamentoComprador]', $request->departamentoComprador, $message);
                    $message = str_replace('[municipioComprador]', $request->municipioComprador, $message);
                    $message = str_replace('[direccionComprador]', $request->direccionComprador, $message);
                    $message = str_replace('[telefonoComprador]', $request->telefonoComprador, $message);

                    $variables['recipient_type'] = "individual";
                    $variables['type'] = "interactive";
                    $variables['interactive']['type'] = 'button';
                    $variables['interactive']['body']['text'] = $message;
                    $variables['interactive']['action']['buttons'][0]['type'] = 'reply';
                    $variables['interactive']['action']['buttons'][0]['reply']['id'] = 'confirm_si';
                    $variables['interactive']['action']['buttons'][0]['reply']['title'] = 'Si, Confirmo';
                    $variables['interactive']['action']['buttons'][1]['type'] = 'reply';
                    $variables['interactive']['action']['buttons'][1]['reply']['id'] = 'confirm_no';
                    $variables['interactive']['action']['buttons'][1]['reply']['title'] = 'No, No solicitado';
                }

                $array['bodywap'] = $variables;
                $variables = json_encode($variables);

                // echo $user->phone_number;
                curl_setopt_array($curl, array(
                    CURLOPT_URL => 'https://graph.facebook.com/v16.0/'.$user->phone_number.'/messages',
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_ENCODING => '',
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 0,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                    CURLOPT_CUSTOMREQUEST => 'POST',
                    CURLOPT_POSTFIELDS =>$variables,
                    CURLOPT_HTTPHEADER => array(
                        'Content-Type: application/json',
                        'Authorization: Bearer '.$user->whatsapp_token
                    ),
                ));

                $response = curl_exec($curl);

                curl_close($curl);
                $array['whatsapp_response'] =  $response;


                $caracteres_permitidos = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                $longitud = 10;
                $rand =  substr(str_shuffle($caracteres_permitidos), 0, $longitud);

                $TICKET = DB::table('tickets')->insertGetId( array(    'userid' => $user->id,
                                                                        'flowid' => $flow[0]->id,
                                                                        'ticketid' => $rand ,
                                                                        'last_message' => date("Y-m-d H:i:s"),
                                                                        'current_node' => $currentStatus,
                                                                        'contact_name' => $request->nombreComprador,
                                                                        'phone_number' => '57'.$request->telefonoComprador,
                                                                        'status' => '0',
                                                                        'triidy_ordenId' => $request->triidyOrdenId
                                                                    ));

                $mesage = DB::table('messages')->insertGetId( array(    'ticketid' => $rand,
                                                                        'contact_name' => 'WEBBOT',
                                                                        'message' => $message ,
                                                                        'node' => $currentStatus,
                                                                        'temp' => $vectorwap
                                                                    ));

            }
            // return $array;
            return response()->json([$array], 200);

        } catch (Exception $e) {
            return response()->json([$e], 500);
        }

    }

    public function createProduct(Request $request){


        try {


            $topic = DB::table('users')
                ->where('triidyPass', '=', $request->password)
                ->where('triidyUser', '=', $request->user)
                ->get();
                // ->where('commerse_code', '=', $request->ecommerceId)

            $array = array();
            if (!isset($topic)) {
                $array['status'] = '0';
                $array['data'] = 'Usuario no encontrado';
                
            }else{
                $array['status'] = '1';
                
                if ($topic[0]->url_wordpress != '') {
                    // code...

                    $curl = curl_init();
                    $arraydata = array();

                    $arraydata["user"] = $request->user;
                    $arraydata["password"] = $request->password;
                    $arraydata["name"] = $request->name;
                    $arraydata["cost"] = $request->cost;
                    $arraydata["sale_price"] = $request->sale_price;
                    $arraydata["product_type"] = $request->product_type;
                    $arraydata["height"] = $request->height;
                    $arraydata["width"] = $request->width;
                    $arraydata["depth"] = $request->depth;
                    $arraydata["volume"] = $request->volume;
                    $arraydata["color"] = $request->color;
                    $arraydata["packaging"] = $request->packaging;
                    $arraydata["content"] = $request->content;
                    $arraydata["invima"] = $request->triidy_product_id;
                    $arraydata["net_weight"] = $request->net_weight;
                    $arraydata["country_phone_code"] = $request->country_phone_code;
                    $arraydata["shopify_product_id"] = $request->shopify_product_id;
                    $arraydata["woocommerce_product_id"] = $request->woocommerce_product_id;;
                    $arraydata["description"] = $request->description;
                    $arraydata["inventory"] = $request->inventory;
                    

                    $arraydata = json_encode($arraydata);
                    

                    curl_setopt_array($curl, array(
                      CURLOPT_URL => $topic[0]->url_wordpress.'/wp-content/plugins/Triidy_Automation/createProduct.php',
                      CURLOPT_RETURNTRANSFER => true,
                      CURLOPT_ENCODING => '',
                      CURLOPT_MAXREDIRS => 10,
                      CURLOPT_TIMEOUT => 0,
                      CURLOPT_FOLLOWLOCATION => true,
                      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                      CURLOPT_CUSTOMREQUEST => 'POST',
                      CURLOPT_POSTFIELDS => $arraydata,
                      CURLOPT_HTTPHEADER => array(
                        'Content-Type: application/json'
                      ),
                    ));

                    $response = curl_exec($curl);

                    curl_close($curl);
                    $array['ecommerce_status'] = 'producto enviado a Woocommerce';
                    //$array['data'] = 'Producto recibido en Automations, listo para ser enviado a Comercio en '.$platform;

                    $array['data'] = $response;

                    $platform = 'WOOCOMMERCE';


                }elseif ($topic[0]->url_api_shopify != '') {
                    
                    $platform = 'SHOPIFY';  
                    $array['ecommerce'] = 'Producto recibido en Automations, listo para ser enviado a Comercio en '.$platform;              
                    $array['data'] = 'Pendiente de Sincronización para generar ID en Shopify';

                }else{
                    $array['status'] = '0';
                    $array['is_success'] = false;
                    $array['data'] = 'COMERCIO NO ENCONTRADO';

                    $platform = false;
                }
                if ($platform) {
                    // code...
                
                    $array_status_str = json_encode($array);

                    $responseText = array();
                    $responseText = [   "user" => $request->user,
                                        "password" => $request->password,
                                        "name" => $request->name,
                                        "cost" => $request->cost,
                                        "sale_price" => $request->sale_price,
                                        "product_type" => $request->product_type,
                                        "height" => $request->height,
                                        "width" => $request->width,
                                        "depth" => $request->depth,
                                        "volume" => $request->volume,
                                        "color" => $request->color,
                                        "packaging" => $request->packaging,
                                        "content" => $request->content,
                                        "triidy_product_id" => $request->triidy_product_id,
                                        "net_weight" => $request->net_weight,
                                        "country_phone_code" => $request->country_phone_code,
                                        "shopify_product_id" => $request->shopify_product_id,
                                        "woocommerce_product_id" => $request->woocommerce_product_id,
                                        "description" => $request->description,
                                        "inventory" => $request->inventory,
                                        "platform" => $request->platform];
                                
                    $responseText = json_encode($responseText);

                    $DataExists = DB::table('transportedData')
                                ->where('triidyId' ,'=', $request->triidy_product_id)
                                ->where('userId' ,'=', $topic[0]->id)
                                ->where('platform' ,'=', $platform)
                                ->where('typeElement' ,'=', 'product')
                                ->get();

                    if($DataExists->count() <= 0){

                        DB::table('transportedData')->updateOrInsert([
                                        'created_at' => date('Y-m-d H:i:s'),
                                        'userId' => $topic[0]->id,
                                        'elementId' => '0',
                                        'triidyId' => $request->triidy_product_id,
                                        'typeElement' => 'product',
                                        'status' => 'Creacion de Producto desde Triidy',
                                        'title' => $request->name,
                                        'response' => $array_status_str,
                                        'bodyRequest' => $responseText,
                                        'platform' => $platform,
                                        'status_creacion' => '1'],
                                        ['triidyId' => $request->triidy_product_id, 'userId' => $topic[0]->id, 'typeElement' => 'product']);

                    }else{
                        $data = array();
                        $data['updated_at'] = date('Y-m-d H:i:s');
                        $data['title'] = $request->name;
                        $data['status'] = 'Actualizacion de Producto desde Triidy';
                        $data['response'] = $array_status_str;
                        $data['triidyId'] = $request->triidy_product_id;
                        $data['bodyRequest'] = $responseText;

                        $update = DB::table('transportedData')
                                            ->where('id', $DataExists[0]->id)
                                            ->update($data);
                    }

                }
            }

            return response()->json([$array], 200);

        } catch (Exception $e) {
            return response()->json([$e], 500);
        }

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function callBack(Request $request)
    {
        $array = array();
        $array['success'] = true;

        $array['origin'] = $request->origin;
        $array['contactName'] = $request->contactName;
        $array['contactNumber'] = $request->contactNumber;
        $array['message'] = $request->message;

        $user = DB::table('users')
                ->where('phone_number', '=', $request->origin)
                ->get();

        if (count($user) > 0) {

            $ticket = DB::table('tickets')
                    ->where('phone_number', '=', $request->contactNumber)
                    ->orderBy('id','desc')
                    ->limit(1)
                    ->get();

            if (count($ticket) > 0) {
                // code...
                $array['user'] = $user[0];
                $array['ticket'] = $ticket[0];

                $currentFlow = DB::table('flow_messages')
                                        ->where('id','=', $ticket[0]->current_node)
                                        ->get();

                $currentMessage =  DB::table('messages')
                                        ->where('ticketid','=', $ticket[0]->ticketid)
                                        ->orderBy('id','desc')
                                        ->limit(1)                                        
                                        ->get();
                
                $node_answer = ($currentFlow[0]->node_answer != '')?$currentFlow[0]->node_answer:15;

                $nextFlow = DB::table('flow_messages')
                                        ->where('id','=', $node_answer)
                                        ->get();

                $variablesMensaje = json_decode($currentMessage[0]->temp);

                // echo $currentMessage[0]->temp;

                $mesage = DB::table('messages')->insertGetId( array( 'ticketid' => $ticket[0]->ticketid,
                                                                'contact_name' => $ticket[0]->contact_name,
                                                                'message' => $request->message,
                                                                'node' => $currentFlow[0]->id,
                                                                'temp' => $currentMessage[0]->temp ));
                $response = '';
                if ($request->message == 'Si, Confirmo') {

                    $sale = array('sale_id' => $ticket[0]->triidy_ordenId);
                    $saleArray = json_encode($sale);            

                    $curl = curl_init();

                    curl_setopt_array($curl, array(
                      CURLOPT_URL => 'https://devopstriidy.com/Automations/api/Triidy/authorize-sale',
                      CURLOPT_RETURNTRANSFER => true,
                      CURLOPT_ENCODING => '',
                      CURLOPT_MAXREDIRS => 10,
                      CURLOPT_TIMEOUT => 0,
                      CURLOPT_FOLLOWLOCATION => true,
                      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                      CURLOPT_CUSTOMREQUEST => 'POST',
                      CURLOPT_POSTFIELDS =>$saleArray,
                      CURLOPT_HTTPHEADER => array(
                        'Content-Type: application/json'
                      ),
                    ));

                    $response = curl_exec($curl);

                    curl_close($curl);
                    #echo $response;
                }

                if ($node_answer != 15) {
                    $array['wpsend'] = $this->pushMessage($ticket[0]->phone_number, $variablesMensaje, $nextFlow[0]->message.$response, $user[0], $ticket[0], $nextFlow[0], $currentMessage[0]->temp);
                }else{

                    $array['wpsend'] = $this->pushMessage($ticket[0]->phone_number, $variablesMensaje, $nextFlow[0]->message.$response, $user[0], $ticket[0], $nextFlow[0], $currentMessage[0]->temp);

                }


                        // ->where('commerse_code', '=', $request->ecommerceId)
                $variables = $array;
                return response()->json([$variables], 200);
            }else{
                $variables = $array;
                $variables['status'] = 'Ticket not Found';
                return response()->json([$variables], 400);    
            }
        }else{
            $variables = $array;
            $variables['status'] = 'User Not Found';
            return response()->json([$variables], 400);
        }
    }

    public function pushMessage($phoneNumber, $variablesMensaje, $message, $user, $ticket, $currentNode, $vectorwap = ''){

        $curl = curl_init();

        $variables['messaging_product'] = "whatsapp";
        $variables['to'] = $phoneNumber;

        $message = str_replace('[comercioNombre]', $variablesMensaje->shop_name, $message);
        $message = str_replace('[nombreProducto]', $variablesMensaje->nombreProducto, $message);
        $message = str_replace('[precioProducto]', $variablesMensaje->precioProducto, $message);
        $message = str_replace('[nombreComprador]', $variablesMensaje->nombreComprador, $message);
        $message = str_replace('[departamentoComprador]', $variablesMensaje->departamentoComprador, $message);
        $message = str_replace('[municipioComprador]', $variablesMensaje->municipioComprador, $message);
        $message = str_replace('[direccionComprador]', $variablesMensaje->direccionComprador, $message);
        $message = str_replace('[telefonoComprador]', $phoneNumber, $message);

        if ($currentNode->id == 15) {
            $variables['recipient_type'] = "individual";
            $variables['type'] = "text";
            $variables['text']['body'] = $message;
            
            // code...
        }else{
            $variables['recipient_type'] = "individual";
            $variables['type'] = "interactive";
            $variables['interactive']['type'] = 'button';
            $variables['interactive']['body']['text'] = $message;
            $variables['interactive']['action']['buttons'][0]['type'] = 'reply';
            $variables['interactive']['action']['buttons'][0]['reply']['id'] = 'confirm_si';
            $variables['interactive']['action']['buttons'][0]['reply']['title'] = 'Si, Confirmo';
            $variables['interactive']['action']['buttons'][1]['type'] = 'reply';
            $variables['interactive']['action']['buttons'][1]['reply']['id'] = 'confirm_no';
            $variables['interactive']['action']['buttons'][1]['reply']['title'] = 'No, No solicitado';
        }

        $array['bodywap'] = $variables;
        $variables = json_encode($variables);

        // echo $user->phone_number;
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://graph.facebook.com/v16.0/'.$user->phone_number.'/messages',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS =>$variables,
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                'Authorization: Bearer '.$user->whatsapp_token
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        $array['whatsapp_response'] =  $response;


        $mesage = DB::table('messages')->insertGetId( array(    'ticketid' => $ticket->ticketid,
                                                                'contact_name' => 'WEBBOT',
                                                                'message' => $message ,
                                                                'node' => $currentNode->id,
                                                                'temp' => $vectorwap
                                                            ));

        $dataTicket = array(    'current_node' => $currentNode->id,
                                'status' => '0' );


        $updateTicket = DB::table('tickets')
               ->where('ticketid', $ticket->ticketid)
               ->update($dataTicket);

        return $array;

    }

}
