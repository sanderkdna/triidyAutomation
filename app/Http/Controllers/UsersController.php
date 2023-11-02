<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\UsersFormRequest;
use Illuminate\Auth\Events\PasswordReset;

use App\Models\User;
use Exception;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use Hash;


class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the users.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $users = User::paginate(15);
        $auth = Auth::user();

        return view('users.index', compact('users', 'auth'));
    }

    /**
     * Show the form for creating a new user.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $auth = Auth::user();
        
        return view('users.create', compact('auth'));
    }

    /**
     * Store a new user in the storage.
     *
     * @param App\Http\Requests\UsersFormRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse | \Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        try {


            $passwod = \Hash::make($request->password);
            // $passwod = $request->password;

            $caracteres_permitidos = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $longitud = 16;
            $rand =  md5($request->email);

            $tokencode = $rand;
            
            $funcionarioId = DB::table('users')->insertGetId( array(    'name' => $request->name,
                                                                        'email' => $request->email,
                                                                        'password' => $passwod ,
                                                                        'token_code' => $tokencode,
                                                                        'commerse_code' => $request->commerse_code,
                                                                        'shop_name' => $request->shop_name,
                                                                        'phone_number' => $request->phone_number,
                                                                        'status' => "1",
                                                                        'tipo_usuario' => $request->tipo_usuario,
                                                                        'whatsapp_token' => $request->whatsapp_token,
                                                                        'url_api_shopify' => $request->url_api_shopify,
                                                                        'url_wordpress' => $request->url_wordpress,
                                                                        'triidyPass' => $request->triidyPass,
                                                                        'triidyUser' => $request->triidyUser
                                                                    ));

            $flows = DB::table('flows')->where("type","=","1")->get();


            $newFlow = DB::table('flows')->insertGetId( array(  'title' => 'Tablero de Comuncaciones Triidy - '.$request->shop_name,
                                                                    'type' => '0',
                                                                    'userId' => $funcionarioId));


            $flowMessages = DB::table('flow_messages')->where('id','=',$flows[0]->id)->get();

            // CREO EL NODO PRINCIPAL
            $Message = DB::table('flow_messages')->insertGetId( array(  'userid' => $funcionarioId,
                                                                        'flowid' => $newFlow,
                                                                        'message' => 'hello_world',
                                                                        'type_element' => 'template',
                                                                        'node_parent' => '0',
                                                                        'node_answer' => '0',
                                                                        'end_pointid' => '1',
                                                                    ));


            $messageTemplate = 'Hola [nombreComprador], te escribimos de la tienda [comercioNombre].hemos recibido una solicitud de compra de un producto [nombreProducto] por un valor de [precioProducto]. <br>Por favor queremos verificar si tus datos son correctos<br>Nombre Comprador: [nombreComprador]Departamento: [departamentoComprador]<br>Municipio: [municipioComprador]<br>Direccion: [direccionComprador]<br>Teléfono: [telefonoComprador]<br>';

            $Message2 = DB::table('flow_messages')->insertGetId( array(  'userid' => $funcionarioId,
                                                                         'flowid' => $newFlow,
                                                                        'message' => $messageTemplate,
                                                                        'type_element' => 'interactive',
                                                                        'node_parent' => $Message,
                                                                        'node_answer' => '',
                                                                        'end_pointid' => '1',
                                                                    ));

            $data = array('node_answer' => $Message2);
            $update = DB::table('flow_messages')
                                    ->where('id', $Message)
                                    ->update($data);
            
            return redirect()->route('users.user.index')
                ->with('success_message', 'User was successfully added.');

        } catch (Exception $exception) {

            $errors = array();
            $errors['unexpected_error'] = 'Unexpected error occurred while trying to process your request.';

            if ($request->shop_name == '') {
                $errors['shop_name'] = 'Falta por ingresar el nombre de la tienda';
            }
            if ($request->email == '') {
                $errors['email'] = 'Falta por ingresar la dirección de correo electrónico';
            }else{
    
                 $user = DB::table('users')
                                ->where("email", '=', $request->email)
                                ->get();

                if ($user[0]->id != '') {
                    $errors['email'] = 'La dirección de correo ingresada ya se encuentra regsitrada';   
                }   

            }
            if ($request->name == '') {
                $errors['name'] = 'Falta por ingresar nombre del contacto';
            }
            if ($request->commerse_code == '') {
                $errors['commerse_code'] = 'Falta por ingresar el código del comercio de Triidy';
            }
            if ($request->whatsapp_token == '') {
                $errors['whatsapp_token'] = 'Falta por ingresar el Token de Whatsapp';
            }
            if ($request->phone_number == '') {
                $errors['phone_number'] = 'Falta por ingresar el Número de verificación de Whatsapp';
            }

            if ($request->url_wordpress == '' && $request->url_api_shopify == '') {
                $errors['url_api_shopify'] = 'Debe ingresar la url del comercio en Wordpress o del comercion en Shopify (alguno de los dos)';
                $errors['url_wordpress'] = 'Debe ingresar la url del comercio en Wordpress o del comercion en Shopify (alguno de los dos)';
                
            }

            


            return back()->withInput()
                ->withErrors($errors);
        }
    }

    /**
     * Display the specified user.
     *
     * @param int $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $auth = Auth::user();
        $user = User::findOrFail($id);

        $flow = DB::table('flows')->where("userId","=",$user->id)->get();

        return view('users.show', compact('user', 'flow', 'auth'));
    }

    /**
     * Show the form for editing the specified user.
     *
     * @param int $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $user = User::find($id);
        $auth = Auth::user();
        

        return view('users.edit', compact('user', 'auth'));
    }

    /**
     * Update the specified user in the storage.
     *
     * @param int $id
     * @param App\Http\Requests\UsersFormRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse | \Illuminate\Routing\Redirector
     */
    public function update($id, UsersFormRequest $request)
    {
        try {
            
            $data = $request->getData();

            $user = User::find($id);
     
            if ($request->password == '') {
                $data['password'] = $user->password;
            }else{
                // $passwod = \Hash::make($user->password);
                $passwod = \Hash::make($request->password);
                echo $data['password'] = $passwod;
                echo '<br>';

                event(new PasswordReset($user));
                // /$user->save();


            }
            // unset($data['password']);
            $user->update($data);


            // print_r($data);
            // exit;
            return redirect()->route('users.user.index')
                ->with('success_message', 'Usuario Actualizado correctamente');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }        
    }

    /**
     * Remove the specified user from the storage.
     *
     * @param int $id
     *
     * @return \Illuminate\Http\RedirectResponse | \Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        try {
            $user = User::findOrFail($id);
            $user->delete();

            return redirect()->route('users.user.index')
                ->with('success_message', 'User was successfully deleted.');
        } catch (Exception $exception) {

            return back()->withInput()
                ->withErrors(['unexpected_error' => 'Unexpected error occurred while trying to process your request.']);
        }
    }

    public function dashboard(){
        $auth = Auth::user();

        return view('pages.dashboard-overview-1', compact('auth'));

    }

    public function getProductos(Request $request){
        $auth = $user = User::findOrFail($request->userId);
        $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => $auth->url_api_shopify.'products.json',
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'GET',
          CURLOPT_HTTPHEADER => array(
            'X-Shopify-Access-Token: '.$auth->token_shopify,
            'Cookie: _secure_admin_session_id=24335605c9f24d7a0c9a91d599f0c56d; _secure_admin_session_id_csrf=24335605c9f24d7a0c9a91d599f0c56d'
          ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return $response;

    }
    public function getProductoSimple(Request $request){
        $auth = $user = User::findOrFail($request->userId);
        $curl = curl_init();

        // echo $auth->url_api_shopify;
        curl_setopt_array($curl, array(
          CURLOPT_URL => $auth->url_api_shopify.'products/'.$request->id.'.json',
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'GET',
          CURLOPT_HTTPHEADER => array(
            'X-Shopify-Access-Token: '.$auth->token_shopify,
            'Cookie: _secure_admin_session_id=24335605c9f24d7a0c9a91d599f0c56d; _secure_admin_session_id_csrf=24335605c9f24d7a0c9a91d599f0c56d'
          ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);

        $data = json_decode($response, true);

        //print_r($data);
        
        $product_type = $data['product']['product_type'];
        $height = '0';
        $width  = '0';
        $length = '0';
        $weight = '0';

        $invima = ($data['product']['variants'][0]['sku'] == '')?$data['product']['variants'][0]['id']:$data['product']['variants'][0]['sku'];

        $params_array['user'] =      $auth->triidyUser;
        $params_array['password'] =  md5($auth->triidyPass);
        $params_array['name'] = $data['product']['title'];
        $params_array['cost'] = $data['product']['variants'][0]['price'];
        $params_array['sale_price'] = $data['product']['variants'][0]['price'];
        $params_array['product_type'] = "1";
        $params_array['height'] = $height;
        $params_array['width'] =  $width;
        $params_array['depth'] =  $length;
        $params_array['volume'] = $weight;
        $params_array['color'] = "N/A";
        $params_array['packaging'] = "N/A";
        $params_array['content'] = $data['product']['body_html'];
        $params_array['invima'] = "$invima";
        $params_array['net_weight'] = "N/A";
        $params_array['country_phone_code'] = "57";
        $params_array['shopify_product_id'] = "'".$data['product']['variants'][0]['id']."'";
        $params_array['woocommerce_product_id'] = "0";
        $params_array['description'] = $data['product']['body_html'];

        $params = json_encode($params_array);            
        $curl = curl_init();
        curl_setopt_array($curl, array(
          CURLOPT_URL => 'https://devopstriidy.com/Automations/api/Triidy/product',
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'POST',
          CURLOPT_POSTFIELDS => $params,
          CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json'
          ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return $response;

    }
    public function getPedidos(Request $request){
        $auth = $user = User::findOrFail($request->userId);
        $curl = curl_init();

        // echo $auth->url_api_shopify;
        curl_setopt_array($curl, array(
          CURLOPT_URL => $auth->url_api_shopify.'orders.json',
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'GET',
          CURLOPT_HTTPHEADER => array(
            'X-Shopify-Access-Token: '.$auth->token_shopify,
            'Cookie: _secure_admin_session_id=24335605c9f24d7a0c9a91d599f0c56d; _secure_admin_session_id_csrf=24335605c9f24d7a0c9a91d599f0c56d'
          ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return $response;
    }
    public function getPedidoSimple(Request $request){
        $auth = $user = User::findOrFail($request->userId);
        $curl = curl_init();

        // echo $auth->url_api_shopify;
            curl_setopt_array($curl, array(
            CURLOPT_URL => $auth->url_api_shopify.'orders/'.$request->id.'.json',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'X-Shopify-Access-Token: '.$auth->token_shopify,
                'Cookie: _secure_admin_session_id=24335605c9f24d7a0c9a91d599f0c56d; _secure_admin_session_id_csrf=24335605c9f24d7a0c9a91d599f0c56d'
            ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);

      //  echo $response;
        
        $data = json_decode($response, true);
        $params_array = array();

        $email = (($data['order']['customer']['email']) != '')?$data['order']['customer']['email']:'nomail@nomail.com';

        $producto = $data['order']['line_items'][0]['product_id'];
        $cantidad = $data['order']['line_items'][0]['quantity'];
        $documento = $data['order']['customer']['id'];

        $params_array['user'] =      $auth->triidyUser;
        $params_array['password'] =  md5($auth->triidyPass);
        $params_array['customer']['country_phone_code'] = "57";
        $params_array['customer']['neighborhood'] = $data['order']['billing_address']['city'];
        $params_array['customer']['document'] =  "$documento";
        $params_array['customer']['email'] =  $email;
        $params_array['customer']['gender'] = "M";
        $params_array['customer']['name'] =  $data['order']['billing_address']['name'];
        $params_array['customer']['phone'] =  str_replace("+57", '', $data['order']['customer']['phone']);
        $params_array['customer']['address'] =  $data['order']['customer']['default_address']['address1'];
        $params_array['customer']['location_id'] = "1";
        $params_array['sale']['height'] = "1";
        $params_array['sale']['width'] = "1";
        $params_array['sale']['length'] = "1";
        $params_array['sale']['payment_method'] = 'Pago Anticipado'; //$data['order']['payment_gateway_names'][0];
        $params_array['sale']['phone'] = str_replace("+57", '', $data['order']['phone']);
        $params_array['sale']['declared_value'] = $data['order']['current_subtotal_price'];
        $params_array['sale']['is_against_delivery'] = true;
        $params_array['sale']['collected_value'] = "0";
        $params_array['sale']['details'][0]['product_id'] = "$producto";
        $params_array['sale']['details'][0]['quantity'] =   "$cantidad";

        $params = json_encode($params_array);

       // echo $params;   
        $curl = curl_init();

            curl_setopt_array($curl, array(
              CURLOPT_URL => "https://devopstriidy.com/Automations/api/Triidy/sale",
              CURLOPT_RETURNTRANSFER => true,
              CURLOPT_ENCODING => '',
              CURLOPT_MAXREDIRS => 10,
              CURLOPT_TIMEOUT => 0,
              CURLOPT_FOLLOWLOCATION => true,
              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
              CURLOPT_CUSTOMREQUEST => 'POST',
              CURLOPT_POSTFIELDS => $params,
              CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json'
              ),
            ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

/*

*/

        return $response;
    }



}
