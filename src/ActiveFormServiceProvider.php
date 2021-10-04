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
    public function register()
    {
        $this->publishes([
            __DIR__.'/../js' => base_path('public/js'),
        ]);

        $this->mergeConfigFrom(
            __DIR__ . '/../config/active-form.php', 'active-form'
        );

        $this->app->alias('ActiveForm', ActiveFormBuilder::class);

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

    /**
     * Register the form builder instance.
     *
     * @return void
     */
    protected function registerFormBuilder()
    {
        $this->app->singleton('form', function ($app) {
            $form = new ActiveFormBuilder($app['html'], $app['url'], $app['view'], $app['session.store']->token(), $app['request']);

            return $form->setSessionStore($app['session.store']);
        });
    }
}