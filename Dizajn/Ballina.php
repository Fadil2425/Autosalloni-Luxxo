    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Luxxo Cars </title>
        <link rel="icon" type="image/png" href="../img/car.png">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    </head>
    <style>
        body{
            margin: 0;
            background-color: rgba(0,0,0,0.9);
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
        background-color: rgba(0,0,0,0.7);  
        z-index: 1000; 
    }

    .header img{
        height: 70px;
    }
    .header .menu{
        
        display: flex;
        align-items: center;
        gap: 25px;
        font-family: Arial, Helvetica, sans-serif;
        
    }
    .header a{

        text-decoration: none;
        color: grey;
        font-size: 16px;
    }
    a:hover{
    color: #DAA520;
    }
    a.B{
        color: #DAA520;
    }
    .hero {
        background-image: url('../img/banner.avif'); 
        background-size: cover;    
        
        height: 600px;             
        display: flex;
        flex-direction: column;
        justify-content: center;    
        align-items: center;        
        color: white;              
        text-align: center;
        position: relative;
    }

    .hero::before {
        content: "";
        position: absolute;
        top: 0; left: 0;
        width: 100%; height: 100%;
        background-color: rgba(0,0,0,0.7); 
        z-index: 1;
    }

    .hero h1, .hero p {
        position: relative;
        z-index: 2; 
    }
    .bannertext{
        font-size: 60px;
        font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif
    }

    .bannertext1{
        font-size: 30px;
        font-family: Georgia, 'Times New Roman', Times, serif;
        text-decoration: underline;

    }
   .mesi {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 20px;
    border-radius: 20px;
    border: 1.5px solid #DAA520;
    width: 90%;
    margin: 50px auto;
    padding: 20px;
}

    #rrethi,#h4{
        padding: 10px;
        color: white;
        font-family: 'Times New Roman', Times, serif;
        font-style: italic;
        font-size: 20px;
    }
    #h4{
        justify-content: center;
        text-align: center;
        align-items: center;
    }
    .hero1 {
    width: 100%;
    height: 350px;
    background-image: url('../img/lambo.jpg');
    background-size: cover;
    background-position: center;
    border-radius: 12px;
    position: relative;
    display: flex;
    justify-content: center;
    align-items: center;
}


    .hero1::before {
        content: "";
        position: absolute;
        top: 0; left: 0;
        width: 100%; height: 100%;
        background-color: rgba(0,0,0,0.7); 
        z-index: 1;
    }

    .hero1 h1, .hero1 p {
        position: relative;
        z-index: 2; 
    }
    .mundesite{
        display: flex;
        flex-wrap:wrap ;
        padding: 10px;
    }
    #ipari:hover{
        transform: scale(1.05);
        background-color: #778899;
    }
    #idyti:hover{
        transform: scale(1.05);
        background-color: #778899;
    }#itreti:hover{
        transform: scale(1.05);
        background-color: #778899;
    }#ikaterti:hover{
        transform: scale(1.05);
        background-color: #778899;
    }
    #ipari{
        padding: 10px;
        text-align: center;
        border: 1.5px solid #DAA520;
        border-radius:10px ;
        width: 24%;
        flex: wrap;
        justify-content: center;
        align-items: center;
        height: 400px;
        font-size: 20px;
    }
       #idyti{
        padding: 10px;
        text-align: center;
        border: 1.5px solid #DAA520;
        border-radius:10px ;
        width: 24%;
        flex: wrap;
        justify-content: center;
        align-items: center;
                font-size: 20px;

    }   #itreti{
        padding: 10px;
        text-align: center;
        border: 1.5px solid #DAA520;
        border-radius:10px ;
        width: 24%;
        flex: wrap;
        justify-content: center;
        align-items: center;
                font-size: 20px;

    }   #ikaterti{
        padding: 10px;
        text-align: center;
        
        border: 1.5px solid #DAA520;
        border-radius:10px ;
        width: 20%;
        flex: wrap;
        justify-content: center;
        align-items: center;
                font-size: 20px;

    }
    #maki:hover{
        color: #DAA520;
        text-decoration: none;
    }
    #maki{
        display: flex;
        text-align: center;
        justify-content: center;
        align-items: center;
        color: white;
    }
    .sh{
        background-image: url('../img/shfletoo.jpg');
        border: 1.5px solid #DAA520;
    }
    .sh h2{
        font-size: 50px;
    }
    .shfleto{
        display: flex;
        
        
        width: 100%;
        height: 400px;

    }
    #Lambo,#Ferrari,#Audi,#Mercedes,#BMW,#Porsche{
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        justify-content: space-between;

        align-items: baseline;
        width: 12%;
        padding: 10px;
    }
    .sh {
    text-align: center;
    margin-top: 30px;
}

.sh h2 {
    color: #DAA520;
    margin-bottom: 20px;
}

.shfleto {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    align-items: center;
    gap: 30px;
    margin-top: 20px;
}

.shfleto img {
    width: 100px;
    height: auto;
    object-fit: contain;
    transition: transform 0.3s ease; 
}

.shfleto img:hover {
    transform: scale(1.2); 
}

.footer {
    margin-top: 0;
    background-image: url("../img/shfletoo.jpg");
    background-size: cover;
    background-position: center;
    padding: 50px 0;
    color: #fff;
    text-align: center;
    margin-bottom: 0;
}

.social-container {
    display: flex;
    justify-content: space-around;
    align-items: center;
    width: 90%;
    margin: auto;
    border-top: 2px solid #ffffff22;
    border-bottom: 2px solid #ffffff22;
    padding: 30px 0;
}

.social-box {
    width: 30%;
    text-align: center;
}

.social i {
    font-size: 50px;
    margin-bottom: 10px;
    transition: 0.4s ease;
    color: #fff;
}

.social p {
    font-size: 18px;
    margin-top: 5px;
}


.fb:hover i {
    color: #1877F2;  
    transform: scale(1.2);
}

.ig:hover i {
    background: linear-gradient(45deg,#feda75,#fa7e1e,#d62976,#962fbf,#4f5bd5);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    transform: scale(1.2);
}

.tt:hover i {
    color: #ffffff;
    transform: scale(1.2);
}

.copyright {
    margin-top: 35px;
    font-size: 14px;
    color: #ddd;
}
footer p{
    color: white;
    
}
footer a{
    text-decoration: none;
}
footer p:hover{
    color: #DAA520;
}
.end{
    
    height: 100%px;
    display: flex;
    justify-content: center;
    align-items: center;

}
.end p{
    color: white;
    font-size: 20px;
}
.end p:hover{
    color: white;

}


@media (max-width: 768px) {
    .header {
        position: relative;
        width: 100%;
        flex-direction: column;
        padding: 10px 0;
    }
    .header .menu {
        gap: 10px;
        flex-wrap: wrap;
        justify-content: center;
        margin-top: 10px;

    }

    .bannertext { font-size: 30px; }
    .bannertext1 { font-size: 18px; }
    .hero { height: 350px; }

    .mesi, .social-container {
        flex-direction: column;
        text-align: center;
    }

    #ipari, #idyti, #itreti, #ikaterti {
        width: 95%;
        margin-bottom: 10px;
    }

    .hero1 { width: 100%; height: 200px; }

    .shfleto {
        gap: 15px;
        height: auto;
    }
    .shfleto img { width: 60px; }
}


    </style>
    <body>
        <nav>
            <div class="header" >
            <img src="../img/car.png" alt="" >
            <div class="menu">
                <a class="B" href="Ballina.php">Ballina</a>
                <a  href="makinat.php">Makinat</a>
                <a  href="rrethNesh.php">Rreth Nesh</a>
                <a href="Kontakti.php">Kontakti</a>
                <a href="profili.php">Profili</a>
            </div>
            </div>
        </nav>
        <div class="hero">
        <b><i><h1 class="bannertext" style="color: #DAA520;">Luxxo Cars</h1></i></b>
        <b><i><p class="bannertext1" style="color: #DAA520;">Drive with passion</p></i></b>
        </div>

   <div class="mesi">
    <div class="tekst">
        <h4 id="h4">Përkushtimi ynë ndaj Përsosmërisë Automobilistike</h4>
        <p id="rrethi">
           Mirë se vini në Auto Sallon Luxxo—destinacioni juaj i parë për përvojën e blerjes së makinave luksoze dhe premium në Kosove. Që nga themelimi ynë, ne kemi pasur një vizion të thjeshtë: të ofrojmë një koleksion të pa rival, të kombinuar me një nivel shërbimi që tejkalon pritshmëritë. 
           <h3><a style="text-decoration: none;" id="maki" href="makinat.php">Makinat</a></h3>
        </p>
    </div>

    <div class="hero1">
        <p  style="color: #DAA520;"></p>
    </div>
</div>

        <div class="mundesite">
            <div id="ipari">
                <h3 style="color: #DAA520;">Superbrand</h3>
                <p style="color: white;">Nje nga kompanite qe ka fituar 3 here radhazi çmimin “Superbrand” ne Kosove eshte Luxxo Cars.</p>
            </div>
            <div id="idyti">
                <h3 style="color: #DAA520;">Nderro Veturen</h3>
                <p style="color: white;">Bleni një veturë të re nga inventari ynë duke paguar vetëm diferencën e vlerës midis veturës së re dhe veturës tuaj aktuale.</p>
                <br>
                <br><br>
                <p style="color: white;">Për të siguruar që çmimi i veturës tuaj të vlerësohet saktë, ne do t'i kryejmë një vlerësim të plotë të veturës tuaj aktuale.</p>
            </div>
            <div id="itreti">
                <h3 style="color: #DAA520;">Leasing</h3>
                <p style="color: white;">Vetura me lizing nga banka të njohura në Kosovë. Kjo mundësi e jashtëzakonshme ju lejon të blini një veturë të re në një kohë më të shpejtë dhe më të lehtë, pa nevojën për të paguar të gjithë shumën e veturës në një herë.</p>
            </div>
            <div id="ikaterti">
                <h3 style="color: #DAA520;">Blej me garancion</h3>
               <p style="color: white;"> Të gjitha automjetet tona vijnë me garancion të plotë pas shitjes, në përputhje me standardet evropiane. Luxxo Cars garanton cilësinë, sigurinë dhe besueshmërinë për çdo veturë të importuar. Blerja juaj është e mbrojtur – sepse garancioni nuk është luks, por domosdoshmëri.</p>
            </div>
        </div>
<div class="sh"><h2 style="color: #DAA520; display: flex;text-align: center;justify-content: center;align-items: center;">Shfleto sipas markes </h2>
       <div class="shfleto">
    <a href="makinat.php#lamborghiniLogo"><img src="../img/lamborghini-logo.png.webp" alt="Lamborghini"></a>
    <a href="makinat.php#ferrariLogo"><img src="../img/2025.png.webp" alt="Ferrari"></a>
    <a href="makinat.php#mercedesLogo"><img src="../img/mercedes-benz-logo.png.webp" alt="Mercedes"></a>
    <a href="makinat.php#audiLogo"><img src="../img/alogo.png" alt="Audi"></a>
    <a href="makinat.php#bmwLogo"><img src="../img/bmw-logo.png.webp" alt="BMW"></a>
    <a href="makinat.php#porscheLogo"><img src="../img/porsche-logo.png.webp" alt="Porsche"></a>
</div>
    <footer class="footer">
    <div class="social-container">

        <div class="social-box">
            <a href="https://www.facebook.com/" target="_blank" class="social fb">
                <i class="fa-brands fa-facebook-f"></i>
                <p>Like us on <strong>Facebook</strong></p>
            </a>
        </div>

        <div class="social-box">
            <a href="https://www.instagram.com/" target="_blank" class="social ig">
                <i class="fa-brands fa-instagram"></i>
                <p>Follow us on <strong>Instagram</strong></p>
            </a>
        </div>

        <div class="social-box">
            <a href="https://www.tiktok.com/" target="_blank" class="social tt">
                <i class="fa-brands fa-tiktok"></i>
                <p>Follow us on <strong>TikTok</strong></p>
            </a>
        </div>

    </div>
    <div class="lokacioni">
        <img src="../img/car.png" alt="">
        <p style="color: white; font-size: 20px;"> Magj. Prishtine-Ferizaj,
        Çagllavicë 10010
        Kosovë</p>
    </div>

    <div class="end">
        <p class="copyright">© 2025 Luxxo Cars - All rights reserved</p>
    </div>
    </footer>
    </div>
    
    <script>
        window.onscroll = function() {
            const header = document.querySelector(".header");
            if (window.scrollY > 50) {
                header.style.backgroundColor = "rgba(0,0,0,0.85)";
                header.style.borderBottom = "1px solid #DAA520";
            } else {
                header.style.backgroundColor = "rgba(0,0,0,0.7)";
                header.style.borderBottom = "none";
            }
        };



        let imazhet = ['../img/banner.avif', '../img/lambo.jpg', '../img/makinat1.jpg'];
        let koha = 3000;
        let i = 0;

        function ndryshoImazhin() {
            const hero = document.querySelector('.hero');
            hero.style.backgroundImage = `url('${imazhet[i]}')`;

            if (i < imazhet.length - 1) {
                i++;
            } else {
                i = 0;
            }
            setTimeout(ndryshoImazhin, koha);
        }
        window.onload = ndryshoImazhin;
    </script>
</body>
</html>