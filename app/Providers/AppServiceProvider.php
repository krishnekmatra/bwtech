<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;
use Auth;
use App\Models\Category;
use App\Models\FeatureAttribute;
use App\Models\Occasions;
use App\Models\ContactUs;

class AppServiceProvider extends ServiceProvider
{
	/**
	 * Register any application services.
	 *
	 * @return void
	 */
	public function register()
	{
		//
	}

	/**
	 * Bootstrap any application services.
	 *
	 * @return void
	 */
	public function boot()
	{
		//
		/* @description validation for check valid vendor email
		 * @return type boolean
		 */
		  

		$category = Category::where('status',1)->orderBy('sorting','desc')->get();;
		//$allFeature = FeatureAttribute::get();
		$occasions = Occasions::orderBy('created_at','desc')->get();
		$contact = ContactUs::pluck('phone')->first();
		
		\View::share('category', $category);
		//\View::share('allFeature', $allFeature);
		\View::share('occasions', $occasions);
		\View::share('contact', $contact);

		Validator::extend('email_valid', function ($attribute, $value, $parameters, $validator){
			$role_id = getRole('admin');
			$users = \DB::table('users')->where('email', $value)->where('role_id','!=', $role_id)->first(['id']);
			if (!empty($users)) {
				return true;
			} else {
				return false;
			}
		}); 
		// Validator::extend('vendor_email_valid', function ($attribute, $value, $parameters, $validator){
		// 	$role_id = getRole('Vendor');
		// 	$users = \DB::table('users')->where(['email' => $value, 'role_id' => $role_id])
		// 			//->where('status', '!=', 'deleted')
		// 			->first(['id']);
		// 	if (!empty($users)) {
		// 		return true;
		// 	} else {
		// 		return false;
		// 	}
		// }); 
		Validator::extend('admin_email_valid', function ($attribute, $value, $parameters, $validator) {
			$role_id = getRole('admin');
			$users = \DB::table('users')->where(['email' => $value, 'role_id' => $role_id])
					//->where('status', '!=', 'deleted')
					->first(['id']);
			if (!empty($users)) {
				return true;
			} else {
				return false;
			}
		}); 
	}
}

