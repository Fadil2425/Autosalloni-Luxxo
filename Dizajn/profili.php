<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profili Im - Luxxo Cars</title>
    <link rel="icon" type="image/png" href="../img/car.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            margin: 0;
            background-color: rgba(0,0,0,0.9);
            font-family: Arial, sans-serif;
            color: white;
            height: 1000px;
        }

        .header {
            position: fixed;
            top: 0;
            left: 0;
            width: 97%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 30px;
            background-color: rgba(0,0,0,0.8);
            z-index: 1000;
        }
        .header img { 
            height: 70px; 
        }
        .menu {
            display: flex;
            align-items: center;
            gap: 25px;
        }

        .menu a { 
            text-decoration: none; 
            color: grey; 
        }

        .menu a:hover, .menu a.m { 
            color: #DAA520; 
        }

        .profile-container {
            margin-top: 120px;
            display: flex;
            justify-content: center;
            padding: 20px;
        }

        .profile-card {
            background-color: #111;
            width: 400px;
            border: 1px solid #DAA520;
            border-radius: 15px;
            padding: 30px;
            text-align: center;
            box-shadow: 0 0 20px rgba(218, 165, 32, 0.2);
        }

        .profile-img {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            border: 3px solid #DAA520;
            margin-bottom: 15px;
        }

        .profile-info h2 { 
            color: #DAA520; 
            margin-bottom: 5px; 
        }
        .profile-info p { 
            color: #ccc; 
            margin: 10px 0; 
            font-size: 16px; 
        }
        
        .stats {
            display: flex;
            justify-content: space-around;
            margin-top: 25px;
            border-top: 1px solid #333;
            padding-top: 20px;
        }

        .stat-box b { 
            color: #DAA520; 
            display: block; 
            font-size: 18px; 
        }

        .btn-edit {
            margin-top: 25px;
            display: inline-block;
            background-color: #DAA520;
            color: black;
            padding: 10px 25px;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
            transition: 0.3s;
        }

        .btn-edit:hover { 
            background-color: white; 
        }
    </style>
</head>
<body>

    <header class="header">
        <img src="../img/car.png" alt="Logo">
        <div class="menu">
            <a href="Ballina.php">Ballina</a>
            <a href="makinat.php">Makinat</a>
            <a href="rrethNesh.php">Rreth Nesh</a>
            <a href="Kontakti.php">Kontakti</a>
            <a href="profili.php" class="m"></i> Profili</a>
        </div>
    </header>

    <div class="profile-container">
        <div class="profile-card">
            <img src="../img/car.png" alt="Logo">
            <div class="profile-info">
                <h2>Filan Fisteku</h2>
                <p class="email"><i class="fa-solid fa-envelope"></i> filan.fisteku@email.com</p>
                <p><i class="fa-solid fa-location-dot"></i> Prishtine, Kosove</p>
                <p><i class="fa-solid fa-phone"></i> +383 44 123 456</p>
            </div>

            <div class="stats">
                <div class="stat-box">
                    <b>5</b>
                    <span>Te preferuara</span>
                </div>
            </div>

            <a href="#" class="btn-edit">Edito Profilin</a>
            <br>
            <a href="index.php" style="color: red; font-size: 13px; text-decoration: none; display: block; margin-top: 15px;">Çkyçu (Log Out)</a>
        </div>
    </div>
    <script>
        function shfaqFavoritet() {
            const user = JSON.parse(localStorage.getItem("userKycur"));
            if (!user) return;

            let favKey = "fav_" + user.email;
            let favoritet = JSON.parse(localStorage.getItem(favKey)) || [];

            document.querySelector('.stat-box b').innerText = favoritet.length;

            let listaHTML = "";

            for (let i = 0; i < favoritet.length; i++) {
                listaHTML += `
                    <div style="display: flex; justify-content: space-between; padding: 10px; border-bottom: 1px solid #333;">
                        <span>${favoritet[i]}</span>
                        <button onclick="largoNgaFavoritet(${i})" style="color: red; background: none; border: none; cursor: pointer;">Largo</button>
                    </div>
                `;
            }

            if (favoritet.length === 0) {
                listaHTML = "<p>Nuk keni asnje makine favorite.</p>";
            }

            let divLista = document.getElementById('lista-fav-pastro');
            if (!divLista) {
                divLista = document.createElement('div');
                divLista.id = 'lista-fav-pastro';
                document.querySelector('.profile-card').appendChild(divLista);
            }
            divLista.innerHTML = listaHTML;
        }

        function largoNgaFavoritet(index) {
            const user = JSON.parse(localStorage.getItem("userKycur"));
            let favKey = "fav_" + user.email;
            let favoritet = JSON.parse(localStorage.getItem(favKey)) || [];

            favoritet.splice(index, 1);

            localStorage.setItem(favKey, JSON.stringify(favoritet));

            shfaqFavoritet();
        }

        window.onload = shfaqFavoritet;
    </script>
</body>
</html>