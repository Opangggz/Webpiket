<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PILIH</title>
    <link rel="stylesheet" href="style/styles.css">
    <link rel="shortcut icon" type="image/icon" href="img/smk.png"/>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Arial', sans-serif;
            background: linear-gradient(135deg, #2980b9, #6dd5fa);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            padding: 20px;
        }

        .container {
            background-color: #fff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
            text-align: center;
            animation: fadeIn 1s ease-in-out;
        }

        form {
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
        }

        form h2 {
            margin: 0;
            font-size: 24px;
            font-weight: bold;
            color: #333;
            line-height: 1;
            position: relative;
        }

        form a {
            position: absolute;
            left: 0; /* Letakkan ikon di paling kiri */
            top: 50%;
            transform: translateY(-50%); /* Pastikan ikon sejajar secara vertikal */
        }

        form i.bx-arrow-back {
            font-size: 24px;
            cursor: pointer;
            color: #333;
        }

        button {
            width: 100%;
            padding: 12px;
            background-color: #3498db;
            color: #fff;
            border: none;
            border-radius: 8px;
            font-size: 18px;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.3s;
            margin-top: 10px;
        }

        button:hover {
            background-color: #2980b9;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
    <script>
        function redirectToPulang(event) {
            event.preventDefault(); 
            window.location.href = 'formpulang.php'; // Arahkan ke halaman form pulang
        }

        function redirectToKeluar(event) {
            event.preventDefault(); 
            window.location.href = 'formkeluar.php'; // Arahkan ke halaman form keluar
        }
    </script>
</head>
<body>
    <div class="container">
        <form>
            <a href="dash.php"><i class='bx bx-arrow-back'></i></a>
            <h2>PILIH FORM</h2>
        </form>
        <button type="submit" onclick="redirectToPulang(event)">Form Pulang</button>
        <button type="submit" onclick="redirectToKeluar(event)">Form Keluar</button>
    </div>
</body>
</html>
