<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Netflix Signup</title>
    <link href="https://fonts.googleapis.com/css2?family=Netflix+Sans:wght@300;400;500&display=swap" rel="stylesheet">
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: 'Netflix Sans', sans-serif;
            background: url('https://springboard-cdn.appadvice.com/wp-content/appadvice-v2-media/2016/11/Netflix-background_860c8ece6b34fb4f43af02255ca8f225.jpg') no-repeat center center fixed;
            background-size: cover;
            height: 100vh;
            color: white;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .signup-container {
            background-color: rgba(0, 0, 0, 0.7);
            padding: 40px 50px;
            border-radius: 8px;
            width: 400px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.6);
        }

        .signup-container h1 {
            text-align: center;
            margin-bottom: 30px;
            font-size: 36px;
            font-weight: 600;
            color: #e50914;
        }

        .input-field {
            width: 90%;
            padding: 14px 20px;
            margin: 10px 0;
            border-radius: 8px;
            border: none;
            font-size: 16px;
            background-color: rgba(255, 255, 255, 0.2);
            color: white;
            transition: 0.3s;
        }

        .input-field:focus {
            background-color: rgba(255, 255, 255, 0.4);
            outline: none;
        }

        .btn {
            width: 100%;
            padding: 14px;
            background-color: #e50914;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            cursor: pointer;
            transition: 0.3s;
        }

        .btn:hover {
            background-color: #f40612;
        }

        .sign-in {
            margin-top: 15px;
            text-align: center;
        }

        .sign-in a {
            color: #b3b3b3;
            text-decoration: none;
            font-size: 14px;
        }

        .sign-in a:hover {
            text-decoration: underline;
        }

        .input-group {
            position: relative;
        }

        .input-group i {
            position: absolute;
            top: 50%;
            left: 10px;
            transform: translateY(-50%);
            color: white;
            font-size: 18px;
        }

        .input-field {
            padding-left: 40px; /* Adjust for icon spacing */
        }

        .input-wrapper {
            margin-bottom: 20px;
        }

        /* Added more contrast to the 'Sign Up' button */
        .btn-signup {
            background-color: #b81c1c;
        }

        .btn-signup:hover {
            background-color: #e50914;
        }
    </style>
</head>
<body>
    <div class="signup-container">
        <h1>Create Account</h1>
        <form method="POST" action="{{ route('register') }}">
            @csrf
        
            <!-- Full Name -->
            <div class="input-wrapper">
                <input type="text" name="name" class="input-field" placeholder="Full Name" required value="{{ old('name') }}">
                @error('name')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        
            <!-- Email -->
            <div class="input-wrapper">
                <input type="email" name="email" class="input-field" placeholder="Email" required value="{{ old('email') }}">
                @error('email')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        
            <!-- Password -->
            <div class="input-wrapper">
                <input type="password" name="password" class="input-field" placeholder="Password" required>
                @error('password')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        
            <!-- Confirm Password -->
            <div class="input-wrapper">
                <input type="password" name="password_confirmation" class="input-field" placeholder="Confirm Password" required>
            </div>
        
            <!-- Signup Button -->
            <button type="submit" class="btn btn-signup">Sign Up</button>
        
            <!-- Already have an account? -->
            <div class="sign-in">
                <span>Already have an account? </span><a href="{{ route('logins') }}">Sign In</a>
            </div>
        </form>
    </div>
</body>
</html>
