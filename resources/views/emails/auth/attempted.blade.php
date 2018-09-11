@component('mail::message')
    # You verification code

    {{ $code->getValue() }}
@endcomponent
