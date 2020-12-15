<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Gym</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header>
        <a href="#" class="logo">My Gym<span>.</span></a>
        <div class="menuToggle" onclick="toggleMenu();"></div>
        <ul class="navigation">
            <li><a href="#banner" onclick="toggleMenu();">Home</a></li>
            <li><a href="#about" onclick="toggleMenu();">About</a></li>
            <li><a href="#facilities" onclick="toggleMenu();">Facilities</a></li>
            <li><a href="#expert" onclick="toggleMenu();">Expert</a></li>
            <li><a href="#testimonials" onclick="toggleMenu();">Testimonials</a></li>
            <li><a href="#contact" onclick="toggleMenu();">Contact</a></li>
        </ul>
    </header>
    <section class="banner" id="banner">
        <div class="content">
            @foreach ($banner as $banner)
            <h2>{{ $banner->title }}</h2>
            <p>{{ $banner->body }}</p>
            @endforeach
            <a href="#facilities" class="btn">Our Facilities</a>
        </div>
    </section>

    <section class="about" id="about">
        <div class="row">
            @foreach ($about as $about)
                <div class="col50">
                    <h2 class="titleText"><span>A</span>bout Us</h2>
                    <p>{{ $about->body }}</p><br><br>
                </div>
                <div class="col50">
                    <div class="imgBox">
                        <img src="{{ $about->image }}">
                    </div>
                </div>
            @endforeach
        </div>
    </section>

    <section class="facilities" id="facilities">
        <div class="title">
            <h2 class="titleText"><span>O</span>ur Facilities</h2>
            <p>Some equipments that will make your body shape greater</p>
        </div>
        <div class="content">
            @foreach ($galleries as $gallery)
                <div class="box">
                    <div class="imgBox">
                        <img src="{{ $gallery->image }}">
                    </div>
                    <div class="text">
                        <h3>{{ $gallery->name }}</h3>
                    </div>
                </div>
            @endforeach
            
        </div>
        <div class="title">
            <a href="#" class="btn">View All</a>
        </div>
    </section>

    <section class="expert" id="expert">
        <div class="title">
            <h2 class="titleText"><span>O</span>ur Expert Trainer</h2>
            <p>Someone that will help you to reach your body goal.</p>
        </div>
        <div class="content">
            @foreach ($trainers as $trainer)
                <div class="box">
                    <div class="imgBox">
                        <img src="{{ $trainer->image }}">
                    </div>
                    <div class="text">
                        <h3>{{ $trainer->name }}</h3>
                    </div>
                </div>
            @endforeach
        </div>
    </section>

    <section class="testimonials" id="testimonials">
        <div class="title white">
            <h2 class="titleText"><span>T</span>estimonials</h2>
            <p>They said about us.</p>
        </div>
        <div class="content">
            <div class="box">
                <div class="imgBox">
                    <img src="images/testi1.jpg">
                </div>
                <div class="text">
                    <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Facere rerum accusamus quos blanditiis molestias veritatis porro excepturi adipisci odit eos.</p>
                    <h3>Someone Famous</h3>
                </div>
            </div>
            <div class="box">
                <div class="imgBox">
                    <img src="images/testi2.jpg">
                </div>
                <div class="text">
                    <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Facere rerum accusamus quos blanditiis molestias veritatis porro excepturi adipisci odit eos.</p>
                    <h3>Someone Famous</h3>
                </div>
            </div>
            <div class="box">
                <div class="imgBox">
                    <img src="images/testi3.jpg">
                </div>
                <div class="text">
                    <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Facere rerum accusamus quos blanditiis molestias veritatis porro excepturi adipisci odit eos.</p>
                    <h3>Someone Famous</h3>
                </div>
            </div>
        </div>
    </section>

    <section class="contact" id="contact">
        <div class="title">
            <h2 class="titleText"><span>C</span>ontact</h2>
            <p>You know how to reach us.</p>
        </div>
        <form action="/" method="POST">
            @csrf
            <div class="contactForm">
                <h3>Send Message</h3>
                <div class="inputBox">
                    <input type="text" name="name" placeholder="Name">
                </div>
                <div class="inputBox">
                    <input type="text" name="email" placeholder="Email">
                </div>
                <div class="inputBox">
                    <textarea name="message" placeholder="Message"></textarea>
                </div>
                <div class="inputBox">
                    <input type="submit" value="Send">
                </div>
            </div>
        </form>
    </section>

    <div class="copyrightText">
        <p>Copyright 2020 <a href="#">Bima Aria Radjasa</a>. All Right Reserved</p>
    </div>

    <script src="js/script.js"></script>
</body>
</html>