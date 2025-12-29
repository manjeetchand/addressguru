<!DOCTYPE html>
<html lang="en">
<head>
@extends('layouts.app')
    <title>Email Verification | Address Guru</title>
    <meta name="description" content="">
    <meta name="keywords" content="">
    <link rel="canonical" href="">
@section('content')
<style>
    .height-100 {
    height: 80vh
}

.card {
    width: 600px;
    border: none;
    height: 400px;
    box-shadow: 0px 5px 20px 0px #d2dae3;
    z-index: 1;
}

.card h4 {
    color: #3c76e5;
    font-size: 24px
}

.inputs input {
    width: 40px;
    height: 40px
}

input[type=number]::-webkit-inner-spin-button,
input[type=number]::-webkit-outer-spin-button {
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
    margin: 0
}

.card-2 {
    background-color: #fff;
    padding: 10px;
    width: 500px;
    height: 200px;
    bottom: -50px;
    left: 20px;
    position: absolute;
    border-radius: 5px
}

.card-2 .content {
    margin-top: 50px
}

.card-2 .content a {
    color: #3c76e5;
}

.form-control:focus {
    box-shadow: none;
    border: 2px solid #3c76e5
}

.validate {
    border-radius: 20px;
    height: 40px;
    background-color: #3c76e5;
    border: 1px solid #3c76e5;
    width: 140px
}
/* .modal-backdrop.show {
    backdrop-filter: blur(8px);
} */
</style>

@if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @if (session('danger'))
                        <div class="alert alert-danger" role="alert">
                            {{ session('danger') }}
                        </div>
                    @endif
                    <div class="container height-100 d-flex justify-content-center align-items-center">
    <div class="position-relative">
        <div id="message">
        </div>
        <div class="card p-4 text-center">
            <h4 class="mt-5">Please enter the one-time password <br> to verify your account</h4>
            <div> <span>A code has been sent to</span> <small id="maskedNumber"><b>{{$user->email}}</b></small> </div>

            <!-- OTP Inputs -->
            <div id="otp" class="inputs d-flex flex-row justify-content-center mt-2">
                <input class="m-2 text-center form-control rounded" type="text" maxlength="1" />
                <input class="m-2 text-center form-control rounded" type="text" maxlength="1" />
                <input class="m-2 text-center form-control rounded" type="text" maxlength="1" />
                <input class="m-2 text-center form-control rounded" type="text" maxlength="1" />
                <input class="m-2 text-center form-control rounded" type="text" maxlength="1" />
                <input class="m-2 text-center form-control rounded" type="text" maxlength="1" />
            </div>

            <!-- Validate Button -->
            <div class="my-4"> 
                <button id="validateBtn" class="btn btn-primary px-4 validate">Validate</button> 
            </div>

            <!-- Resend OTP -->
            <p class="m-0">
                Didn't get the code? 
                <button id="resendOtp" class="btn btn-link px-2 py-1" disabled>Resend OTP (1:00)</button>
            </p>
        </div>
    </div>
</div>
<script>


document.addEventListener("DOMContentLoaded", function() {
    function OTPInput() {
        const inputs = document.querySelectorAll('#otp > input');

        for (let i = 0; i < inputs.length; i++) {
            inputs[i].addEventListener('input', function() {
                if (this.value.length > 1) {
                    this.value = this.value[0]; // Allow only 1 digit
                }
                if (this.value !== '' && i < inputs.length - 1) {
                    inputs[i + 1].focus(); // Move to next field
                }
            });

            inputs[i].addEventListener('keydown', function(event) {
                if (event.key === 'Backspace') {
                    this.value = '';
                    if (i > 0) {
                        inputs[i - 1].focus(); // Move to previous field
                    }
                }
            });
        }
    }
    OTPInput();

    // Validate OTP
    $('#validateBtn').click(function() {
        let otp = '';
        $('#otp input').each(function() {
            otp += $(this).val();
        });

        var url = "{{ route('verify.otp', $user->id) }}"; 
        if (otp.length === 6) {
            $.ajax({
                url: url,
                type: 'POST',
                data: { otp: otp, email: '{{$user->email}}', _token: '{{ csrf_token() }}' },
                success: function(response) {
                    if (response.status === 'success') {
                        $('#message').empty();
                        $('#message').append(`
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                           ${response.message}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    `);
                        setTimeout(() => {
                            window.location.href = response.redirect_url;
                        }, 1500);
                    } else {  
                        $('#message').empty();
                        $('#message').append(`
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                           ${response.message}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    `);
                    }
                },
                error: function() {
                    $('#message').empty();
                    $('#message').append(`
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            Something went wrong! Please try again.
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    `);
                }
            });
        } else { 
            $('#message').empty();
            $('#message').append(`
                <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    Please enter a 6-digit OTP.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            `);

        }
    });


    
    let timer = 60;
    const resendBtn = $('#resendOtp');

    function startResendTimer() {
        resendBtn.prop('disabled', true);
        let interval = setInterval(function() {
            timer--;
            resendBtn.text(`Resend OTP (0:${timer < 10 ? '0' : ''}${timer})`);

            if (timer <= 0) {
                clearInterval(interval);
                resendBtn.prop('disabled', false).text('Resend OTP');
            }
        }, 1000);
    }
    startResendTimer();

    // Resend OTP AJAX
    $resendurl = "{{route('send.otp',$user->id)}}";
        resendBtn.click(function() {
        $.ajax({
            url:$resendurl ,
            type: 'POST',
            data: { email: '{{$user->email}}', _token: '{{ csrf_token() }}' },
            success: function(response) {
                // toastr.success(response.message);
                $('#message').empty();
                $('#message').append(`
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        ${response.message}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                `);
                timer = 60;
                startResendTimer();
            },
            error: function() {
                $('#message').empty();
                $('#message').append(`
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        Failed to resend OTP, please try again.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>   
                `);
            }
        });
    });
});
</script>
@endsection