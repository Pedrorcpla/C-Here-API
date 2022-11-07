<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CustomerLayout;
use Illuminate\Support\Facades\Storage;

class CustomerLayoutController extends Controller
{
    public function getAllCustomersLayout(){
        //lista todos os layout dos customers
        $customersLayout = CustomerLayout::get()->toJson(JSON_PRETTY_PRINT);
        return response($customersLayout, 200);
    }

    public function createCustomerLayout(Request $request){
        //criar um customer
        $customerLayout = new CustomerLayout;
        $customerLayout->cd_background              =   $request->cd_background;
        $customerLayout->cd_fontColor               =   $request->cd_fontColor;
        $customerLayout->cd_backgroundSecondary     =   $request->cd_backgroundSecondary;
        $customerLayout->id_customer                =   $request->id_customer;

        $customerLayout->save();

        return response()->json([
            "message" => "Layout do Customer criado com sucesso!"
        ], 201);
    }

    public function getCustomerLayout($id){
        //pega o layout do customer pelo id
        if(CustomerLayout::where('id_customer', $id)->exists()){
            $customerLayout = CustomerLayout::where('id_customer', $id)->get()->toJson(JSON_PRETTY_PRINT);
            return response($customerLayout, 200);
        } 
        else{
            return response()->json([
                "message" => "Falha ao buscar Layout do Customer"
            ], 404);
        }
    }

    public function updateCustomerLayout(Request $request, $id){
        //atualizar dados do customer
        if(CustomerLayout::where('id_customer', $id)->exists()){
            $customerLayout = CustomerLayout::find($id);
            $customerLayout->cd_background              =       is_null($request->cd_background)            ?   $customerLayout->cd_background          : $request->cd_background;
            $customerLayout->cd_fontColor               =       is_null($request->cd_fontColor)             ?   $customerLayout->cd_fontColor           : $request->cd_fontColor;
            $customerLayout->cd_backgroundSecondary     =       is_null($request->cd_backgroundSecondary)   ?   $customerLayout->cd_backgroundSecondary : $request->cd_backgroundSecondary;
            $customerLayout->id_customer                =       is_null($request->id_customer)              ?   $customerLayout->id_customer            : $request->id_customer;
            $customerLayout->save();

            return response()->json([
                "message" => "Dados atualizados com sucesso!"
            ], 200);
        }
        else{
            return response()->json([
                "message" => "Falha ao encontrar Layout do Customer"
            ], 404);
        }
    }

    public function deleteCustomerLayout($id){
        //apaga o layout do customer
        if(CustomerLayout::where('id_customer', $id)->exists()){
            $customerLayout = CustomerLayout::find($id);
            $customerLayout->delete();

            return response()->json([
                "message" => "Layout do Customer apagado com sucesso!"
            ], 404);
        }
        else{
            return response()->json([
                "message" => "Falha ao encontrar layout do customer"
            ], 404);
        }
    }
}

