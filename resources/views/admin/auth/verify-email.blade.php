<p>Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.</p>

    @if (session('status') == 'verification-link-sent')
    <div class="alert alert-info">
        <strong>A new verification link has been sent to the email address you provided during registration.</strong>
    </div>
    @endif

    <div class="">
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf
            <button type="submit" class="btn btn-info">Resend Verification Email</button>
        </form>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="btn btn-info">Log Out</button>
        </form>
    </div>
