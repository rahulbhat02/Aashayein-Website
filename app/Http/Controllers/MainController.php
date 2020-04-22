<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\File;
use Auth;
use Redirect;
use DB;
use Exception;
use Hash;
use Mail;
use Carbon;

class MainController extends Controller
{
	private $site_info;

	public function __construct()
	{
		$this->site_info = DB::table('site_settings')->first();
	}

	public function home()
	{

		$info =  DB::table('info')->first();
		$top_posts = DB::table('top_posts')->get();
		$carousel = DB::table('carousel')->get();
		$pick = DB::table('editors_pick')->get();
		$trending_posts = DB::table('trending_posts')->get();

		$editors_pick = array();

		foreach ($top_posts as $value) {
			$post_data = DB::table('posts')->where('post_id', $value->post_id)->select('heading', 'intro_text', 'image', 'posted_at')->get();
			foreach ($post_data as $v) {
				$value->heading = $v->heading;
				$value->intro_text = $v->intro_text;
				$value->image = $v->image;

				$post_data2 = DB::table('top_posts')->where('post_id', $value->post_id)->select('posted_at')->first();
				$date1 = $post_data2->posted_at;
				$date2 = $v->posted_at;
				$date1 = strtotime($date1);
				$date2 = strtotime($date2);

				$date1 = date('d M', $date1);
				$date2 = date('d M', $date2);


				if ($date1 >= $date2) {

					$date2 = $date1;
				}

				$date = explode(' ', $date2);
				$value->date = $date[0];
				$value->month = $date[1];
			}
		}
		$x = 0;
		foreach ($carousel as $value) {
			$post_data = DB::table('posts')->where('post_id', $value->post_id)->select('heading', 'intro_text', 'image', 'posted_at')->get();
			foreach ($post_data as $v) {
				$value->heading = $v->heading;
				$value->intro_text = $v->intro_text;
				$value->image = $v->image;
				$value->c = $x;
				$value->update = "Posted";

				$post_data2 = DB::table('carousel')->where('post_id', $value->post_id)->select('posted_at')->first();
				$date1 = $post_data2->posted_at;
				$date2 = $v->posted_at;
				$date1 = strtotime($date1);
				$date2 = strtotime($date2);

				$date1 = date('d M', $date1);
				$date2 = date('d M', $date2);


				if ($date1 >= $date2) {
					$date2 = $date1;
				}

				$date = explode(' ', $date2);
				$value->date = $date[0];
				$value->month = $date[1];
			}

			$x = $x + 1;
		}
		$x = 0;
		foreach ($pick as $value) {
			$post_data = DB::table('posts')->where('post_id', $value->post_id)->select('heading', 'caption', 'image', 'posted_at')->get();
			foreach ($post_data as $v) {
				$value->heading = $v->heading;
				$value->caption = $v->caption;
				$value->image = $v->image;
				$value->c = $x;
				$value->update = "Posted";

				$post_data2 = DB::table('editors_pick')->where('post_id', $value->post_id)->select('posted_at')->first();
				$date1 = $post_data2->posted_at;
				$date2 = $v->posted_at;
				$date1 = strtotime($date1);
				$date2 = strtotime($date2);

				$date1 = date('d M', $date1);
				$date2 = date('d M', $date2);


				if ($date1 >= $date2) {

					$date2 = $date1;
				}

				$date = explode(' ', $date2);
				$value->date = $date[0];
				$value->month = $date[1];

				if ($x == 0) {
					array_push($editors_pick, $value->heading);
					array_push($editors_pick, $value->caption);
					array_push($editors_pick, $value->image);
					array_push($editors_pick, $value->post_id);
					array_push($editors_pick, $value->date);
					array_push($editors_pick, $value->month);
				}
			}
			$x = $x + 1;
		}
		$x = 1;
		foreach ($trending_posts as $value) {
			$post_data = DB::table('posts')->where('post_id', $value->post_id)->select('heading', 'posted_at')->get();
			foreach ($post_data as $v) {
				$value->heading = $v->heading;
				$value->c = $x;
				$value->update = "Posted";
			}
			$x = $x + 1;
		}
		return view('home')
			->with('top_posts', $top_posts)
			->with('carousel', $carousel)
			->with('pick', $pick)
			->with('trending', $trending_posts)
			->with('editors_pick', $editors_pick)
			->with('info', $info)
			->with('site_info', $this->site_info);
	}


	public function doLogin(Request $request)
	{
		$userdata = array(
			'username'     => $request->username,
			'password'  => $request->password
		);


		if (Auth::attempt($userdata)) {
			$user = Auth::user();
			$request->session()->put('key', $user);


			return redirect()->route('posts');
		} else {
			return Redirect::to('admin')
				->withErrors(['invalid' => 'Invalid Username or Password!']);
		}
	}

	public function unauthorized(Request $request)
	{
		return Redirect::to('admin')
			->withErrors(['invalid' => 'Please Login to continue']);
	}



	public function edit_posts()
	{
		$posts = DB::table('posts')->select('id', 'heading', 'posted_at')->get();
		foreach ($posts as $value) {
			$datetime = explode(" ", $value->posted_at);
			$date = $datetime[0];
			$value->posted_at = $date;
		}

		return view('edit_posts')->with('posts', $posts);
	}

	public function new_post()
	{
		return view('new_post');
	}

	public function add_post(Request $request)
	{
		$request->validate([
			'image' => 'required|image|mimes:jpeg,jpg|max:2048',
		]);

		$imageName = time() . '.' . $request->image->getClientOriginalExtension();

		request()->image->move(public_path('img'), $imageName);

		$str = rand();
		$post_id = md5(time() . '.' . $str);


		$data = array(
			'heading'     => $request->heading,
			'caption'  => $request->caption,
			'intro_text'  => $request->intro,
			'body'  => $request->body,
			'image'  => $imageName,
			'post_id'  => $post_id

		);

		DB::table('posts')->insert($data);
		return redirect('/admin/posts');
	}

	public function delete_post(Request $request)
	{
		$id = $request->id;

		$img = DB::table('posts')->where('id', $id)->pluck('image')->first();
		\File::delete(public_path('img/' . $img . ''));

		$post_id = DB::table('posts')->where('id', $id)->pluck('post_id')->first();
		DB::delete('delete from top_posts where post_id = ?', [$post_id]);
		DB::delete('delete from carousel where post_id = ?', [$post_id]);
		DB::delete('delete from trending_posts where post_id = ?', [$post_id]);
		DB::delete('delete from editors_pick where post_id = ?', [$post_id]);

		DB::delete('delete from posts where id = ?', [$id]);
		return redirect('/admin/posts');
	}

	public function update_post(Request $request)
	{
		$id = $request->id;
		$post = DB::table('posts')->where('id', $id)->first();

		return view('update_post')->with('post', $post);
	}

	public function update_post_insert(Request $request)
	{
		$data = array(
			'heading'     => $request->heading,
			'caption'  => $request->caption,
			'intro_text'  => $request->intro,
			'body'  => $request->body

		);

		$id = $request->id;
		DB::table('posts')
			->where('id', $id)
			->update($data);

		if ($request->has('img_view')) {
			/*$request->validate([
				'img_view' => 'required|image|mimes:jpeg,jpg|max:2048'
			]);*/

			$img_view = time() . '.' . $request->img_view->getClientOriginalExtension();

			$img = DB::table('posts')->where('id', $id)->pluck('image')->first();
			\File::delete(public_path('img/' . $img . ''));

			request()->img_view->move(public_path('img'), $img_view);
			$data = array(
				'image'  => $img_view
			);
			DB::table('posts')->where('id', $id)->update($data);
		}

		return redirect('/admin/posts');
	}

	public function top_posts()
	{
		$posts = DB::table('top_posts')->select('id', 'post_id')->orderBy('id', 'asc')->get();
		$posts2 = DB::table('posts')->select('id', 'heading')->get();

		foreach ($posts as $value) {
			$id = $value->post_id;
			$title = DB::table('posts')->where('post_id', $id)->value('heading');
			$value->title = $title;
		}


		return view('top_posts')->with(['posts' => $posts, 'posts2' => $posts2]);
	}

	public function add_top_post(Request $request)
	{
		$id = $request->id;
		$post_id = DB::table('posts')->where('id', $id)->value('post_id');
		$data = array(
			'post_id'     => $post_id

		);
		try {
			DB::table('top_posts')->insert($data);
		} catch (Exception $e) {
		}
		return redirect()->back()->with("success", "Data Updated Successfully !");
	}

	public function remove_top_post(Request $request)
	{
		$id = $request->id;
		DB::delete('delete from top_posts where post_id = ?', [$id]);
		return redirect()->back()->with("success", "Data Updated Successfully !");
	}

	public function arrange_top_post(Request $request)
	{
		$id = $request->id;
		$id = json_decode($id, true);

		DB::table('top_posts')->truncate();

		for ($x = 1; $x <= count($id); $x++) {
			$data = array(
				'post_id'     => $id[$x]

			);
			DB::table('top_posts')->insert($data);
		}


		return redirect()->back()->with("success", "Data Updated Successfully !");
	}

	public function carousel()
	{
		$posts = DB::table('carousel')->select('id', 'post_id')->orderBy('id', 'asc')->get();
		$posts2 = DB::table('posts')->select('id', 'heading')->get();

		foreach ($posts as $value) {
			$id = $value->post_id;
			$title = DB::table('posts')->where('post_id', $id)->value('heading');
			$value->title = $title;
		}


		return view('carousel')->with(['posts' => $posts, 'posts2' => $posts2]);
	}

	public function add_carousel(Request $request)
	{
		$id = $request->id;
		$post_id = DB::table('posts')->where('id', $id)->value('post_id');
		$data = array(
			'post_id'     => $post_id

		);
		try {
			DB::table('carousel')->insert($data);
		} catch (Exception $e) {
		}
		return redirect()->back()->with("success", "Data Updated Successfully !");
	}

	public function remove_carousel(Request $request)
	{
		$id = $request->id;
		DB::delete('delete from carousel where post_id = ?', [$id]);
		return redirect()->back()->with("success", "Data Updated Successfully !");
	}

	public function arrange_carousel(Request $request)
	{
		$id = $request->id;
		$id = json_decode($id, true);

		DB::table('carousel')->truncate();

		for ($x = 1; $x <= count($id); $x++) {
			$data = array(
				'post_id'     => $id[$x]

			);
			DB::table('carousel')->insert($data);
		}


		return redirect()->back()->with("success", "Data Updated Successfully !");
	}

	public function info()
	{
		$data = DB::table('info')->first();
		return view('info', ['data' => $data]);
	}



	public function update_info(Request $request)
	{
		$data = array(
			'about_us'     => $request->abt,
			'mission'  => $request->mission,
			'who_are_we'  => $request->who_are_we,
			'vision'  => $request->vision
		);

		DB::table('info')->update($data);

		return redirect()->back()->with("success", "Data Updated Successfully !");
	}

	public function site_settings()
	{
		$data = DB::table('site_settings')->first();
		return view('site_settings', ['data' => $data]);
	}



	public function update_site_settings(Request $request)
	{
		$data = array(
			'website_name'     	=> $request->website_name,
			'website_email'  	=> $request->website_email,
			'insta_link'  		=> $request->insta_link,
			'address'  			=> $request->address
		);

		DB::table('site_settings')->update($data);

		return redirect()->back()->with("success", "Data Updated Successfully !");
	}

	public function trend_posts()
	{
		$posts = DB::table('trending_posts')->select('id', 'post_id')->orderBy('id', 'asc')->get();
		$posts2 = DB::table('posts')->select('id', 'heading')->get();

		foreach ($posts as $value) {
			$id = $value->post_id;
			$title = DB::table('posts')->where('post_id', $id)->value('heading');
			$value->title = $title;
		}


		return view('trending')->with(['posts' => $posts, 'posts2' => $posts2]);
	}

	public function add_trend_posts(Request $request)
	{
		$id = $request->id;
		$post_id = DB::table('posts')->where('id', $id)->value('post_id');
		$data = array(
			'post_id'     => $post_id

		);
		try {
			DB::table('trending_posts')->insert($data);
		} catch (Exception $e) {
		}
		return redirect()->back()->with("success", "Data Updated Successfully !");
	}

	public function remove_trend_posts(Request $request)
	{
		$id = $request->id;
		DB::delete('delete from trending_posts where post_id = ?', [$id]);
		return redirect()->back()->with("success", "Data Updated Successfully !");
	}

	public function arrange_trend_posts(Request $request)
	{
		$id = $request->id;
		$id = json_decode($id, true);

		DB::table('trending_posts')->truncate();

		for ($x = 1; $x <= count($id); $x++) {
			$data = array(
				'post_id'     => $id[$x]

			);
			DB::table('trending_posts')->insert($data);
		}


		return redirect()->back()->with("success", "Data Updated Successfully !");
	}

	public function pick_posts()
	{
		$posts = DB::table('editors_pick')->select('id', 'post_id')->orderBy('id', 'asc')->get();
		$posts2 = DB::table('posts')->select('id', 'heading')->get();

		foreach ($posts as $value) {
			$id = $value->post_id;
			$title = DB::table('posts')->where('post_id', $id)->value('heading');
			$value->title = $title;
		}


		return view('editorsPick')->with(['posts' => $posts, 'posts2' => $posts2]);
	}

	public function add_pick_posts(Request $request)
	{
		$id = $request->id;
		$post_id = DB::table('posts')->where('id', $id)->value('post_id');
		$data = array(
			'post_id'     => $post_id

		);
		try {
			DB::table('editors_pick')->insert($data);
		} catch (Exception $e) {
		}
		return redirect()->back()->with("success", "Data Updated Successfully !");
	}

	public function remove_pick_posts(Request $request)
	{
		$id = $request->id;
		DB::delete('delete from editors_pick where post_id = ?', [$id]);
		return redirect()->back()->with("success", "Data Updated Successfully !");
	}

	public function arrange_pick_posts(Request $request)
	{
		$id = $request->id;
		$id = json_decode($id, true);

		DB::table('editors_pick')->truncate();

		for ($x = 1; $x <= count($id); $x++) {
			$data = array(
				'post_id'     => $id[$x]

			);
			DB::table('editors_pick')->insert($data);
		}


		return redirect()->back()->with("success", "Data Updated Successfully !");
	}

	public function post($id)
	{
		$postData = DB::table('posts')->where('post_id', $id)->select('heading', 'image', 'body', 'caption', 'posted_at')->first();
		$trending_posts = DB::table('trending_posts')->get();

		$x = 1;
		foreach ($trending_posts as $value) {
			$post_data = DB::table('posts')->where('post_id', $value->post_id)->select('heading', 'posted_at')->get();
			foreach ($post_data as $v) {
				$value->heading = $v->heading;
				$value->c = $x;
				$value->update = "Posted";

				$post_data2 = DB::table('trending_posts')->where('post_id', $value->post_id)->select('posted_at')->first();
				$date1 = $post_data2->posted_at;
				$date2 = $v->posted_at;
				$date1 = strtotime($date1);
				$date2 = strtotime($date2);

				$date1 = date('d M', $date1);
				$date2 = date('d M', $date2);


				if ($date1 >= $date2) {

					$date2 = $date1;
				}

				$date = explode(' ', $date2);
				$value->date = $date[0];
				$value->month = $date[1];
			}
			$x = $x + 1;
		}

		$date1 = $postData->posted_at;
		$date1 = strtotime($date1);

		$date1 = date('d M', $date1);



		$date = explode(' ', $date1);
		$postData->date = $date[0];
		$postData->month = $date[1];



		return view('post')->with('post_data', $postData)
			->with('trending', $trending_posts)
			->with('site_info', $this->site_info);
	}

	public function categories()
	{
		$posts = DB::table('posts')->paginate(10);

		$trending_posts = DB::table('trending_posts')->get();

		foreach ($posts as $value) {
			$post_data = DB::table('posts')->where('post_id', $value->post_id)->select('heading', 'intro_text', 'image', 'posted_at')->get();
			foreach ($post_data as $v) {
				$post_data2 = DB::table('top_posts')->where('post_id', $value->post_id)->select('posted_at')->first();
				$date1 = $post_data2->posted_at;
				$date2 = $v->posted_at;
				$date1 = strtotime($date1);
				$date2 = strtotime($date2);

				$date1 = date('d M', $date1);
				$date2 = date('d M', $date2);


				if ($date1 >= $date2) {

					$date2 = $date1;
				}

				$date = explode(' ', $date2);
				$value->date = $date[0];
				$value->month = $date[1];
			}
		}

		$x = 1;
		foreach ($trending_posts as $value) {
			$post_data = DB::table('posts')->where('post_id', $value->post_id)->select('heading', 'posted_at')->get();
			foreach ($post_data as $v) {
				$value->heading = $v->heading;
				$value->c = $x;

				$post_data2 = DB::table('top_posts')->where('post_id', $value->post_id)->select('posted_at')->first();
				$date1 = $post_data2->posted_at;
				$date2 = $v->posted_at;
				$date1 = strtotime($date1);
				$date2 = strtotime($date2);

				$date1 = date('d M', $date1);
				$date2 = date('d M', $date2);


				if ($date1 >= $date2) {

					$date2 = $date1;
				}

				$date = explode(' ', $date2);
				$value->date = $date[0];
				$value->month = $date[1];
			}
			$x = $x + 1;
		}

		return view('categories')->with('posts', $posts)
			->with('trending', $trending_posts)
			->with('site_info', $this->site_info);
	}

	public function about_us()
	{
		$data = DB::table('info')->first();
		$pick = DB::table('editors_pick')->get();
		$trending_posts = DB::table('trending_posts')->get();
		$editors_pick = array();

		$x = 0;
		foreach ($pick as $value) {
			$post_data = DB::table('posts')->where('post_id', $value->post_id)->select('heading', 'caption', 'image', 'posted_at')->get();
			foreach ($post_data as $v) {
				$value->heading = $v->heading;
				$value->caption = $v->caption;
				$value->image = $v->image;
				$value->c = $x;
				$value->update = "Posted";

				$post_data2 = DB::table('editors_pick')->where('post_id', $value->post_id)->select('posted_at')->first();
				$date1 = $post_data2->posted_at;
				$date2 = $v->posted_at;
				$date1 = strtotime($date1);
				$date2 = strtotime($date2);

				$date1 = date('d M', $date1);
				$date2 = date('d M', $date2);


				if ($date1 >= $date2) {

					$date2 = $date1;
				}

				$date = explode(' ', $date2);
				$value->date = $date[0];
				$value->month = $date[1];

				if ($x == 0) {
					array_push($editors_pick, $value->heading);
					array_push($editors_pick, $value->caption);
					array_push($editors_pick, $value->image);
					array_push($editors_pick, $value->post_id);
					array_push($editors_pick, $value->date);
					array_push($editors_pick, $value->month);
				}
			}
			$x = $x + 1;
		}
		$x = 1;
		foreach ($trending_posts as $value) {
			$post_data = DB::table('posts')->where('post_id', $value->post_id)->select('heading', 'posted_at')->get();
			foreach ($post_data as $v) {
				$value->heading = $v->heading;
				$value->c = $x;
				$value->update = "Posted";
			}
			$x = $x + 1;
		}

		return view('aboutUs')->with('about_us', $data)
			->with('trending', $trending_posts)
			->with('pick', $pick)
			->with('editors_pick', $editors_pick)
			->with('site_info', $this->site_info);
	}

	public function contact_us()
	{
		return view('contactUs')
			->with('site_info', $this->site_info);
	}


	public function send_mail(Request $request)
	{
		$site = DB::table('site_settings')->first();
		$mytime = Carbon\Carbon::now();
		$to_name = $site->website_name;
		$to_email = $site->website_email;
		$data = array(
			'fname'     => $request->fname,
			'lname'  => $request->lname,
			'eaddress'  => $request->eaddress,
			'tel'  => $request->tel,
			'messages'  => $request->message,
			'time'	=>	$mytime->toDateTimeString()
		);
		$from_email = $request->eaddress;
		$from_name = $request->fname;


		Mail::send('mail', $data, function ($message) use ($to_name, $to_email, $from_email) {
			$message->to($to_email, $to_name)
				->subject('Customer Message');

			$message->from($from_email, 'Customer Mail');
		});

		$request->session()->put('thankyou', 'Thank You');

		if (Mail::failures()) {
			return redirect()->back()->with("err", "Thank You");
		} else {
			return redirect()->back()->with("success", "Thank You");
		}
	}

	public function logout(Request $request)
	{
		Auth::logout();
		$request->session()->forget('key');
		return Redirect::to('admin')
			->withErrors(['out' => 'Successfully Logged out']);
	}

	public function change_pass()
	{
		return view('changePassword');
	}

	public function changePassword(Request $request)
	{

		$password = DB::table('admin')->select('password')->first();
		$pass =  $password->password;

		if (!(Hash::check($request->get('current-password'), $pass))) {
			// The passwords matches
			return redirect()->back()->with("error", "Your current password does not matches with the password you provided. Please try again.");
		}

		if (strcmp($request->get('current-password'), $request->get('new-password')) == 0) {
			//Current password and new password are same
			return redirect()->back()->with("error", "New Password cannot be same as your current password. Please choose a different password.");
		}

		$validatedData = $request->validate([
			'current-password' => 'required',
			'new-password' => 'required|string|min:4|confirmed',
		]);

		//Change Password
		$password = Hash::make($request->get('new-password'));
		DB::table('admin')
			->where('username', 'admin')
			->update(['password' => $password]);


		return redirect()->back()->with("success", "Password changed successfully !");
	}
}
