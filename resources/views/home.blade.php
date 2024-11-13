<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Who is Watching?</title>
    <style>
        /* General Styles */
        body {
            margin: 0;
            font-family: Arial, sans-serif;
        }

        .container {
            background: url('https://wallpapers.com/images/file/netflix-background-gs7hjuwvv2g0e9fj.jpg') no-repeat center center;
            background-size: cover;
            min-height: 100vh;
            padding-top: 50px;
            color: white;
            text-align: center;
        }

        .row {
            display: flex;
            justify-content: center;
            gap: 30px;
            flex-wrap: wrap;
        }

        .card {
            background-color: rgba(0, 0, 0, 0.7);
            color: white;
            border: none;
            margin: 20px;
            width: 200px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.3);
            cursor: pointer;
            transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
        }

        .card:hover {
            transform: scale(1.1);
            box-shadow: 0 8px 15px rgba(0, 0, 0, 0.5);
        }

        .card img {
            border-radius: 10px 10px 0 0;
            width: 100%;
            height: auto;
        }

        .card-body {
            padding: 15px;
        }

        .card-title {
            font-size: 18px;
            font-weight: bold;
        }

        h2 {
            font-size: 36px;
            font-weight: bold;
            margin-bottom: 40px;
        }

        /* Mobile Responsiveness */
        @media (max-width: 768px) {
            .row {
                flex-direction: column;
                align-items: center;
            }

            .card {
                width: 250px;
            }
        }
        a {
      text-decoration: none;
    }
    </style>
</head>
<body>
    <div class="container">
        <h2>Who is watching?</h2>
        <div class="row">
            <a href="{{ route('main') }}">
            <div class="card" onclick="selectProfile('Rabin')" href="">
                <img src="https://th.bing.com/th/id/OIP.tqPcJF0m1HqBclka9GwaGwAAAA?rs=1&pid=ImgDetMain" alt="Rabin">
                <div class="card-body">
                    <h5 class="card-title">Rabin</h5>
                </div>
            </div>
            </a>
            <div class="card" onclick="selectProfile('Stranger')">
                <img src="https://png.pngtree.com/png-vector/20240407/ourmid/pngtree-cactus-plant-3d-transparent-background-png-image_12271701.png" alt="Stranger">
                <div class="card-body">
                    <h5 class="card-title">Stranger</h5>
                </div>
            </div>
            <!-- You can add more cards here -->
        </div>
    </div>

    <script>
        // JavaScript to handle profile selection
        function selectProfile(profile) {
            alert(profile + " is selected! Now you can start watching.");
            // You can redirect to another page or do something else here
            // For example: window.location.href = "/home";
        }
    </script>
</body>
</html>
