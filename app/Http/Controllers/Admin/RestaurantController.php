<?php

namespace App\Http\Controllers\Admin;

use App\Restaurant;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\RestaurantImage;
use Illuminate\Support\Facades\Validator;

class RestaurantController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $restaurants=Restaurant::with("restaurantImage")->get();
        return view("admin.restaurants.index",compact('restaurants'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


       $validator=Validator::make($request->all(),[
        'restaurant_name'=> 'required',
        'restaurant_code'=> 'required',
        'restaurant_desc'=> 'required',
        'phone_number'=> 'required|numeric',
        'email'=>'required',
        'image' => 'required|image'
       ]);

       if ($validator->fails()) {
           return response()->json($validator->errors(),402);
       }


        $restaurant=new Restaurant();
        $restaurant->restaurant_name=$request->restaurant_name;
        $restaurant->restaurant_code=$request->restaurant_code;
        $restaurant->email=$request->email;
        $restaurant->phone_number=$request->phone_number;
        $restaurant->restaurant_desc=$request->restaurant_desc;
        if($restaurant->save()){
            if($request->hasFile('image')){
                  $image=new RestaurantImage();
                  $image->restaurant_id=$restaurant->id;
                  $upload = $request->file('image');
                    $fileformat = time() . '.' . $upload->getClientOriginalName();
                    if ($upload->move('uploads/restaurant/images', $fileformat)) {
                        $image->image = $fileformat;
                        $image->save();
                    }
        }
        return response()->json([
            "status" => "S",
            "message" => "Resturant Added succesfully"
        ]);
    }else{
        return response()->json([
            "status" => "F",
            "message" => "oops.! something went wrong"
        ]);
    }

}



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Restaurant  $restaurant
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $validator=Validator::make($request->all(),[
            'restaurant_name_edit'=> 'required',
            'restaurant_code_edit'=> 'required',
            'restaurant_desc_edit'=> 'required',
            'phone_number_edit'=> 'required',
            'email_edit'=>'required',
           ]);

           if ($validator->fails()) {
               return response()->json($validator->errors(),402);
           }

        $restaurant=Restaurant::where('id', $id)->first();
        $restaurant->restaurant_name=$request->restaurant_name_edit;
        $restaurant->restaurant_code=$request->restaurant_code_edit;
        $restaurant->email=$request->email_edit;
        $restaurant->phone_number=$request->phone_number_edit;
        $restaurant->restaurant_desc=$request->restaurant_desc_edit;
        if($restaurant->update()){
            if($request->hasFile('image_edit')){

                    $image=new RestaurantImage();
                    $image->restaurant_id=$restaurant->id;
                    $upload = $request->file('image_edit');
                      $fileformat = time() . '.' . $upload->getClientOriginalName();
                      if ($upload->move('uploads/restaurant/images', $fileformat)) {
                          $image->image = $fileformat;
                          $image->save();
                      }

          }
        return response()->json("Restaurant Update");
    }else{
        return redirect()->json('unsuccess','Failed try again.');
    }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Restaurant  $restaurant
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $restaurant=Restaurant::findOrFail($id);
        if($restaurant::where('id',$id)->delete()){
            return redirect()->back()->with("success","Restaurant Deleted");
        }
        else{
            return redirect()->back()->with('unsuccess','Failed try again.');
        }
    }


    public function getRestuarant($id)
    {
        //return $id;
        $restaurant=Restaurant::where('id',$id)->with("restaurantImage")->first();

        if ($restaurant) {
            return response()->json([
                "status" => "S",
                "message" => "Restuarant Details",
                "restuarant" => $restaurant
            ]);
        }else{
            return response()->json([
                "status" => "F",
                "errors" => "Unable to find restuarant"
            ]);
        }

    }

}
