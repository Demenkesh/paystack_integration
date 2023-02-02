<form method="POST" action="{{ route('pay') }}" accept-charset="UTF-8" class="form-horizontal d-none" role="form">


    <input type="text" name="metadata" value="{{ json_encode($array = ['invoiceId' => 1]) }}">

    <input type="text" name="first_name" value="umeh">
    <input type="text" name="last_name" value="onyedika">
    <input type="text" name="email" value="umehonyedika@gmsil.com"> {{-- required --}}
    <input type="text" name="phone" value="09032491755">
    <input type="text" name="orderID" value="345">


    <input type="text" name="amount" value="200.00"> {{-- required in kobo --}}

    <input type="text" name="currency" value="NGN">

    <input type="text" name="reference" value="{{ Paystack::genTranxRef() }}">
    {{ csrf_field() }}


    <button class="btn btn-success btn-lg btn-block" type="submit" value="Pay Now!">

        <i class="fa fa-plus-circle fa-lg"></i> Pay Now!</button>
</form>
