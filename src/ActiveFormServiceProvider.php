<?php

namespace Laravel\ActiveForm;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class ActiveFormServiceProvider  extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../config/active-form.php' => config_path('active-form.php'),
        ], 'config');
    }


    /**
     * Register any application services.
     * @return void
     */
    public function register(): void
    {
        $this->publishes([
            __DIR__.'/views' => base_path('public/js'),
        ]);

        $this->mergeConfigFrom(
            __DIR__ . '/../config/active-form.php', 'active-form'
        );

        $this->app->bind('ActiveForm', function (){
            return new \Laravel\ActiveForm\ActiveForm;
        });



        Route::post(config('active-form.route'), function (Request $request) {
            $class = $request->class;
            $class = str_replace('/', '\\', $class);

            $request_class = new $class();
            $request_class->setMethod(Request::METHOD_OPTIONS);

            $validator = Validator::make($request->all(), $request_class->rules(), $request_class->messages());
            $validator->setAttributeNames($request_class->attributes());

            if ($request->ajax()) {
                if ($validator->fails()) {
                    return response()->json([
                        'success' => false,
                        'errors' => $validator->getMessageBag()->toArray()
                    ]);
                }
                return response()->json([
                    'success' => true,
                ]);
            }
        });

        Route::post(config('active-form.route'), function(Request $request){
            $class = $request->class;
            $class = str_replace('/','\\',$class);
            $my_request = new $class();
            $validator = Validator::make($request->all(),$my_request->rules(),$my_request->messages());
            $validator->setAttributeNames($my_request->attributes());
            if($request->ajax()){
                if ($validator->fails())
                {
                    return response()->json(array(
                        'success' => false,
                        'errors' => $validator->getMessageBag()->toArray()

                    ));
                }else{
                    return response()->json(array(
                        'success' => true,
                    ));
                }
            }
        });
    }
}