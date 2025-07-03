<?php

namespace App\Http\Controllers;

use App\Models\AttendedQuizAnswers;
use App\Models\AttendedQuizzes;
use App\Models\Blog;
use App\Models\Category;
use App\Models\Course;
use App\Models\Inquiry;
use App\Models\Newsletter;
use App\Models\Plan;
use App\Models\Quiz;
use App\Models\Quizoption;
use App\Models\Quizquestion;
use App\Models\Review;
use App\Models\Subscribtion;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use SellingPartnerApi\Model\NotificationsV1\Subscription;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class IndexController extends Controller
{

    public function index()
    {
        return view('home');
    }

    public function about()
    {
        return view('about');
    }
    public function contact()
    {
        return view('contact');
    }
    public function services()
    {
        return view('services');
    }
    public function services_boilers()
    {
        return view('services-boilers');
    }
    public function services_freezers_coolers()
    {
        return view('services-freezers-coolers');
    }
    public function services_heating()
    {
        return view('services-heating');
    }
    public function services_acinstallation()
    {
        return view('services-acinstallation');
    }
    public function memberships()
    {
        $plans = Plan::where('status',1)->get();
        $user = Auth::user();
        return view('memberships' , compact('plans','user'));
    }
    public function plan_subscribe($id)
    {
     
        $plan = Plan::where('id', $id)->first();
        // $subscription = Subscribtion::create([
        //     'plan_id'=> $plan->id,
        //     'user_id'=> $user->id,
        //     'price' => $plan->price,
        //     'date' => Carbon::now(),
        //     'expire_date' => Carbon::now()->addMonth(),
        // ]);
        return view('subscribe-page' , compact('plan'));
        // return redirect()->route('subscribe-page',compact('plan'));
    }
    public function subscribtion_form(Request $request){
      
        $validated = $request->validate([
            'name' => 'required|string|max:50',
            'phone' => 'required|max:255',
            'email' => 'required|max:255',
            'address' => 'required|string',
            'state' => 'required|string',
            'zip' => 'required|string',
        ]);
        $plan = Plan::where('id', $request->plan)->first();
        $subscription = Subscribtion::create([
            'plan_id'=> $request->plan,
            'name'=> $request->name,
            'email'=> $request->email,
            'phone'=> $request->phone,
            'address'=> $request->address,
            'state'=> $request->state,
            'zip'=> $request->zip,
            'message'=> $request->message,
            'price' => $plan->price,
            'status' => 0,
            'date' => Carbon::now(),
            'expire_date' => Carbon::now()->addMonth(),
        ]);
        return view('price-page' , compact('subscription'));
    }
    public function contact_submit(Request $request){
      
        $validated = $request->validate([
            'name' => 'required|string|max:50',
            'phone' => 'required|max:255',
            'email' => 'required|max:255',
            'message' => 'sometimes|string',
        ]);
        $inquiry = Inquiry::create([
            'name'=> $request->name,
            'email'=> $request->email,
            'phone'=> $request->phone,
            'message'=> $request->message,
        ]);
        return redirect()->back()->with('notify_success', 'Inquiry Submited');
    }

    
    public function payment_index($order_number)
    {
        $order = Subscribtion::where('id', $order_number)->where('payment_status', 0)->first();
        if($order)
        {
            return view('payment')->with('total', $order->price)->with('order_number', $order->id)->with('order', $order);
        }
        else
        {
            return redirect('/');
        }
    }

    // for paypal Start
    public function paypal_now(Request $request)
	{
		$order = Subscribtion::find($request->id);
        if($order->payment_status != 1)
        {
            $order->payment_status = 1;
            $order->save();

            Session::flash('success', 'Payment successful!');
            $request->session()->put('thankyou', 'thankyou');

            return response()->json([
                'status' => 'success',
                'order_id' =>  $order->id,
            ]);
        }
        else
        {
            return redirect('/');
        }
    }
    public function paypal_thankyou(Request $request, $order_id)
	{
        if ($request->session()->has('thankyou')) {
            Session::forget('thankyou');
            return view('thank-you');
        }
        else
        {
            return redirect('/');
        }
    }
    // for paypal End
    
    
    public function blogs()
    {
        return view('blogs');
    }

    public function login()
    {
        return view('sign-in');
    }
    public function signup()
    {
        return view('signup');
    }

    public function user_signup(Request $request){
        $validated = $request->validate([
            'name' => 'required|string|max:50',
            'phone' => 'required|max:255',
            'email' => 'required|unique:users|max:255',
            'password' => 'required|min:6|max:16',
        ]);
        

        $user = User::create([
            'name' => $request->name,
            'role_id' => 2,
            'email' => $request->email,
            'contact' => $request->phone,
            'password' => bcrypt($request->password)
        ]);

        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            return redirect()->route('profile')->with('notify_success', 'You have Successfully loggedin');
        }

        return redirect(app()->getLocale() . '/login');
    }
    
    public function profile()
    {
        $user = Auth::user();
        if($user){
            return view('profile')->with(compact('user'));

        }else{ 
            return redirect()->route('login')->with('error','Oppes! You Need to Login First');
         }
    }
    
    public function submit_newsletter(Request $request)
    {
      
        $validiate = $request->validate([
            'email' => 'required|unique:newsletters|max:255',
        ]);
        $review = Newsletter::create([
            'email' => $request->email,
        ]);

        return redirect()->back()->with('notify_success', 'Newsletter Subscribed Successfully');
    }


    public function course_review_submission(Request $request)
    {
        $user = Auth::user();
        $validiate = $request->validate([
            'name' => 'required|string|max:100',
            'message' => 'required|string',
            'rating' => 'required',
            'course' => 'required',

        ]);
        $review = Review::create([
            'course_id' => $request->course,
            'user_id' => $user->id,
            'rating' => $request->rating,
            'email' => $user->email,
            'name' => $request->name,
            'comment' => $request->message,
        ]);

        return redirect()->back()->with('notify_success', 'Review Is Uploaded it will be Published once it is Approved');
    }
    public function blog_detail($slug){
        $blog = Blog::where('slug',$slug)->first();
        $popularPosts = Blog::where('popular',1 )
        ->orderBy('created_at', 'desc')
        ->take(4)
        ->get();
        return view('blog-detail',compact('blog','popularPosts'));
    }
    public function categories(Request $request, $slug = null)
    {
        $tag = $request->query('tag');
        if($slug != null){
            $category = Category::where('slug',$slug)->first();
            $categories = [];
        }else{
            $categories = Category::where('is_active',1)->get();
            $category = null;
        }
        if($tag != null){
            $blogs = Blog::withAnyTags([$tag])->get();

        }else{
            $blogs = null;
        }
        return view('category-page',compact('categories','category','tag','blogs'));
    }
 
}
