<?php

namespace App\Http\Controllers;

use App\Http\Requests;

use App\Models\Payment;
use Illuminate\Http\Request;
use Paystack; // Paystack package
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
// use Auth;
// use App\Student; // Student Model
// use App\Payment; // Payment Model
// use App\User; // User model
class PaymentController extends Controller
{

    // public function pay()
    // {
    //     return view('pay');
    // }

    /**
     * Redirect the User to Paystack Payment Page
     * @return Url
     */
    public function redirectToGateway(Request $request)
    {
        try {
            return Paystack::getAuthorizationUrl()->redirectNow();
        } catch (\Exception $e) {
            return Redirect::back()->withMessage(['msg' => 'The paystack token has expired. Please refresh the page and try again.', 'type' => 'error']);
        }
    }

    /**
     * Obtain Paystack payment information
     * @return void
     */
    public function handleGatewayCallback(Request $request)
    {
        // pass in the id of auth user
        // Getting the specific student and his details
        //    $student = Student::where('user_id',$id)->first();
        //    $class_id = $student->class_id;
        //    $section_id = $student->section_id;
        //    $level_id = $student->level_id;
        $student_id = 'umeh';
        //    { examlpe of value i will call in student when pass real user value $customeraddress->name =  $user->name;
        // in the $student_id get the user model and use it to call out in the studentid that will help to pass the value once the payment is done}

        $paymentDetails = Paystack::getPaymentData();

        $inv_id = $paymentDetails['data']['metadata']['invoiceId']; // Getting InvoiceId I passed from the form
        $status = $paymentDetails['data']['status']; // Getting the status of the transaction
        $amount = $paymentDetails['data']['amount']; //Getting the Amount
        $number = $randnum = rand(1111111111, 9999999999); // this one is specific to application
        $number = 'year' . $number;
        if ($status == "success") { //Checking to Ensure the transaction was succesfull
            $payment = new Payment;
            $payment->user_id = '1';
            $payment->first_name = $student_id;
            $payment->last_name = 'onyedika';
            $payment->email = 'umehonyedika@gmsil.com';
            $payment->phone = '09032491755';
            $payment->amount = $amount;
            $payment->inv_id = $inv_id;
            $payment->status = $status;
            $payment->ref = 'paystack';
            $payment->save();
            return redirect('/')->with('Successfully');


            // dd($paymentDetails);
        }
    }
}
