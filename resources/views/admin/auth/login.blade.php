<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>ShopInKarts Login</title>

<style>
*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:'Segoe UI', Arial, sans-serif;
}

body{
    min-height:100vh;
    display:flex;
    justify-content:center;
    align-items:center;
    background:#ffffff;
}

/* CARD */
.mobile-container{
    width:100%;
    max-width:380px;
    padding:45px 30px;
    background:#f7f7f7;
    border-radius:22px;
    box-shadow:0 20px 45px rgba(0,0,0,0.15);
    display:flex;
    flex-direction:column;
}

/* LOGO */
.logo{
    text-align:center;
    margin-bottom:35px;
}

.logo img{
    width:95px;
    border-radius:14px;
}

/* ERROR */
.error-box{
    background:#ffe5e5;
    color:#c62828;
    padding:12px 15px;
    border-radius:12px;
    font-size:14px;
    margin-bottom:18px;
    text-align:center;
}

/* INPUTS */
.input-field{
    margin-bottom:22px;
}

.input-field label{
    font-size:14px;
    color:#333;
    margin-bottom:6px;
    display:block;
}

.input-field input{
    width:100%;
    padding:14px 15px;
    border-radius:12px;
    border:1px solid #dcdcdc;
    font-size:15px;
    outline:none;
    transition:0.3s;
}

.input-field input:focus{
    border-color:#3769ca;
    box-shadow:0 0 0 3px rgba(55,105,202,0.15);
}

/* BUTTON */
.login-btn{
    width:100%;
    padding:15px;
    margin-top:15px;
    background:#5f88da;
    color:#fff;
    border:none;
    border-radius:30px;
    font-size:17px;
    font-weight:600;
    cursor:pointer;
    transition:0.3s;
}

.login-btn:hover{
    background:#2f58a8;
    transform:translateY(-2px);
    box-shadow:0 8px 20px rgba(55,105,202,0.35);
}
</style>
</head>

<body>

<div class="mobile-container">

    <div class="logo">
        <img src="{{ asset('images/1.jpg') }}" alt="ShopInKarts Logo">
    </div>

    {{-- Backend error (same as your old code) --}}
    @if(session('error'))
        <div class="error-box">
            {{ session('error') }}
        </div>
    @endif

    <form method="POST" action="/admin/login">
        @csrf

        <div class="input-field">
            <label>Username</label>
            <input type="email"
                   name="email"
                   placeholder="Enter E-mail or Mobile"
                   required>
        </div>

        <div class="input-field">
            <label>Password</label>
            <input type="password"
                   name="password"
                   placeholder="Enter Password"
                   required>
        </div>

        <button type="submit" class="login-btn">Login</button>
    </form>

</div>

</body>
</html>
