<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>3D Coverflow - One Page Portfolio</title>
    <link href="css/templatemo-3d-coverflow.css" rel="stylesheet">
 
</head>

<body>
    <!-- Header -->
    <header class="header" id="header">
        <a href="#home" class="logo-container">
            <div class="logo">
                <img src="ImagesAcceso/logo.png" alt="">
            </div>
        </a>

        <nav class="main-menu" id="mainMenu">
            <a href="#home" class="menu-item active">Inicio</a>
            <a href="#about" class="menu-item">Sobre nosotros</a>
            <a href="#contact" class="menu-item">Contacto</a>
            <a href="#LogIn" class="menu-item">LogIn</a>
            <a href="https://github.com" target="_blank" rel="noopener noreferrer" class="menu-item external">GitHub</a>
        </nav>

        <div class="menu-toggle" id="menuToggle">
            <span></span>
            <span></span>
            <span></span>
        </div>
    </header>

    <!-- Home Section -->
    <section id="home" class="section">
        <div class="coverflow-wrapper">
            <div class="info">
                <h2 id="current-title">Cuentanos tus ideas</h2>
                <p id="current-description">Sube o crea tus propios planos y cotiza tus mejores opciones</p>
            </div>

            <div class="coverflow-container" tabindex="0">
                <div class="coverflow" id="coverflow">
                    <div class="coverflow-item" data-index="0">
                        <div class="cover image-loading">
                            <img src="images/Construccion01.jpg" alt="Mountain Landscape" loading="lazy">
                        </div>
                        <div class="reflection"></div>
                    </div>
                    <div class="coverflow-item" data-index="1">
                        <div class="cover image-loading">
                            <img src="images/Construccion02.jpg" alt="Forest Path" loading="lazy">
                        </div>
                        <div class="reflection"></div>
                    </div>
                    <div class="coverflow-item" data-index="2">
                        <div class="cover image-loading">
                            <img src="images/Construccion03.jpg" alt="Lake Reflection" loading="lazy">
                        </div>
                        <div class="reflection"></div>
                    </div>
                    <div class="coverflow-item" data-index="3">
                        <div class="cover image-loading">
                            <img src="images/Construccion04.avif" alt="Ocean Sunset" loading="lazy">
                        </div>
                        <div class="reflection"></div>
                    </div>
                    <div class="coverflow-item" data-index="4">
                        <div class="cover image-loading">
                            <img src="images/Construccion05.jpg" alt="Desert Dunes" loading="lazy">
                        </div>
                        <div class="reflection"></div>
                    </div>
                    <div class="coverflow-item" data-index="5">
                        <div class="cover image-loading">
                            <img src="images/Construccion06.jpg" alt="Starry Night" loading="lazy">
                        </div>
                        <div class="reflection"></div>
                    </div>
                    <div class="coverflow-item" data-index="6">
                        <div class="cover image-loading">
                            <img src="images/Construccion07.png" alt="Waterfall" loading="lazy">
                        </div>
                        <div class="reflection"></div>
                    </div>
                </div>

                <button class="nav-button prev" onclick="navigate(-1)">‹</button>
                <button class="nav-button next" onclick="navigate(1)">›</button>

                <div class="dots-container" id="dots"></div>

                <!-- Play/Pause Button -->
                <button class="play-pause-button" id="playPauseBtn" onclick="toggleAutoplay()">
                    <span class="play-icon">▶</span>
                    <span class="pause-icon" style="display: none;">❚❚</span>
                </button>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section id="about" class="section">
        <div class="about-content">
            <div class="about-header">
                <h2>Quiénes somos</h2>
                <p>Somos la herramienta ideal para profesionales y usuarios que buscan precisión, eficiencia y control en cada etapa de su proyecto.</p>
            </div>

            <div class="about-main">
                <div class="about-visual">
                    <div class="showcase-display">
                        <div class="showcase-main">
                            <div class="corner-decoration top-left"></div>
                            <div class="corner-decoration bottom-right"></div>

                            <div class="showcase-logo">
                                <img src="ImagesAcceso/vision.png" alt="">
                            </div>

                            <h3 class="showcase-title">Vision</h3>
                            <p class="showcase-subtitle">Transformar la gestión de proyectos en una experiencia eficiente, accesible y colaborativa.</p>
                        </div>
                    </div>

                    <div class="showcase-display">
                        <div class="showcase-main">
                            <div class="corner-decoration top-left"></div>
                            <div class="corner-decoration bottom-right"></div>

                            <div class="showcase-logo">
                                <img src="ImagesAcceso/mision.png" alt="">
                            </div>

                            <h3 class="showcase-title">Misión</h3>
                            <p class="showcase-subtitle">Facilitar la planeación y gestión de proyectos, ayudando a las personas a ahorrar tiempo y dinero de forma eficiente y accesible.</p>

                            <div class="showcase-badges"></div>
                        </div>
                    </div>

                    <div class="showcase-display">
                        <div class="showcase-main">
                            <div class="corner-decoration top-left"></div>
                            <div class="corner-decoration bottom-right"></div>

                            <div class="showcase-logo">
                                <img src="ImagesAcceso/valores.png" alt="">
                            </div>

                            <h3 class="showcase-title">Valores</h3>
                            <p class="showcase-subtitle">Innovación, precisión, transparencia y compromiso con el usuario.</p>
                        </div>
                    </div>
                </div>

                <div class="about-info">
                    <h3>Optimiza Cada Etapa de Tu Proyecto</h3>
                    <p>OptiConstruct es la plataforma diseñada para transformar la forma en que profesionales y usuarios gestionan sus proyectos de construcción.</p>
                    <p>Desde la planeación hasta la ejecución, podrás visualizar recursos, analizar planos, y tomar decisiones informadas con herramientas que te brindan claridad en cada paso.</p>

                    <ul class="feature-list">
                        <li>Encuentra sucursales cercanas con geolocalización inteligente</li>
                        <li>Compara precios de materiales y proveedores en un solo lugar</li>
                        <li>Organiza tus recursos, planos y avances del proyecto</li>
                        <li>Reduce tiempos, costos y errores de planificación</li>
                        <li>Información centralizada y accesible desde cualquier dispositivo</li>
                    </ul>

                    <a href="#contact" class="cta-button">
                        Inicia tu proyecto
                        <svg viewBox="0 0 24 24" fill="currentColor">
                            <path d="M5 12h14m-7-7l7 7-7 7" stroke="currentColor" stroke-width="2" fill="none"/>
                        </svg>
                    </a>
                </div>
            </div>

            <div class="stats-section">
                <div class="stat-item">
                    <div class="stat-number">DXF</div>
                    <div class="stat-label">Soporte de archivos</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number">Precisión</div>
                    <div class="stat-label">Geolocalización confiable</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number">Organiza</div>
                    <div class="stat-label">Ideal para gestionar proyectos</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number">Seguro</div>
                    <div class="stat-label">Mantenemos tus datos privados</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="section">
        <div class="contact-content">
            <div class="contact-header">
                <h2>Contacto</h2>
                <p>Obtén más información mediante contacto directo con nosotros.</p>
            </div>

            <div class="contact-container">
                <div class="contact-info-section">
                    <h3>Contáctanos</h3>
                    <p>Nuestro objetivo es brindarte la mejor experiencia en la planificación y gestión de tus proyectos de construcción. Si necesitas orientación, deseas integrar nuestra plataforma en tu empresa o tienes alguna duda, estamos listos para
                        ayudarte.
                    </p>

                    <div class="contact-details">
                        <div class="contact-item">
                            <div class="contact-icon">
                                <svg viewBox="0 0 24 24">
                                    <path d="M20 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z"/>
                                </svg>
                            </div>
                            <div class="contact-text">
                                <h4>Correo</h4>
                                <p>OptiConstruct@outlook.com</p>
                            </div>
                        </div>

                        <div class="contact-item">
                            <div class="contact-icon">
                                <svg viewBox="0 0 24 24">
                                    <path d="M6.62 10.79c1.44 2.83 3.76 5.14 6.59 6.59l2.2-2.2c.27-.27.67-.36 1.02-.24 1.12.37 2.33.57 3.57.57.55 0 1 .45 1 1V20c0 .55-.45 1-1 1-9.39 0-17-7.61-17-17 0-.55.45-1 1-1h3.5c.55 0 1 .45 1 1 0 1.25.2 2.45.57 3.57.11.35.03.74-.25 1.02l-2.2 2.2z"/>
                                </svg>
                            </div>
                            <div class="contact-text">
                                <h4>Teléfono</h4>
                                <p>+1 (555) 123-4567</p>
                            </div>
                        </div>
                    </div>

                    <div class="social-links">
                        <h4>Síguenos</h4>
                        <div class="social-buttons">
                            <a href="#" class="social-btn" title="Facebook">
                                <svg viewBox="0 0 24 24">
                                    <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                                </svg>
                            </a>
                            <a href="#" class="social-btn" title="Twitter">
                                <svg viewBox="0 0 24 24">
                                    <path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z"/>
                                </svg>
                            </a>
                            <a href="#" class="social-btn" title="LinkedIn">
                                <svg viewBox="0 0 24 24">
                                    <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/>
                                </svg>
                            </a>
                            <a href="#" class="social-btn" title="Instagram">
                                <svg viewBox="0 0 24 24">
                                    <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zM5.838 12a6.162 6.162 0 1112.324 0 6.162 6.162 0 01-12.324 0zM12 16a4 4 0 110-8 4 4 0 010 8zm4.965-10.405a1.44 1.44 0 112.881.001 1.44 1.44 0 01-2.881-.001z"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="contact-form-section">
                    <form class="contact-form" onsubmit="handleSubmit(event)">
                        <div class="form-group">
                            <label for="name">Tu nombre</label>
                            <input type="text" id="name" name="name" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Correo electrónico</label>
                            <input type="email" id="email" name="email" required>
                        </div>
                        <div class="form-group">
                            <label for="subject">Sujeto</label>
                            <input type="text" id="subject" name="subject" required>
                        </div>
                        <div class="form-group">
                            <label for="message">Mensaje</label>
                            <textarea id="message" name="message" required></textarea>
                        </div>
                        <button type="submit" class="submit-btn">Enviar mensaje</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- Login Section-->
    <section id="LogIn" class="section"> 
            <div class="MainLogIn">
                <div class="contenedor__todo">
                <!-- caja_trasera= recuadro azul-->
                    <div class="caja__trasera">
                        <div class="caja__trasera_login">
                            <h3> Ya tienes una cuenta?</h3>
                            <p>Inicia sesión para entrar en la pagina</p>
                            <button id="btn__iniciar-sesion">Iniciar Sesión</button>
                        </div>
                        <div class="caja__trasera_register">
                            <h3> Aun no tienes una cuenta?</h3>
                            <p>Registrate para poder iniciar sesión</p>
                            <button id="btn__registrarse">Registrarse</button>
                        </div>
                    </div>
                    <!--Contenedor de login y register-->
                    <div class="contenedor__login-register">
                        <!--Contenedor de login-->
                        <form action="php/login.php" method="POST" class="formulario__login">
                            <h2>Iniciar Sesión</h2>
                            <input type="text" placeholder="Usuario" name="correo">
                            <input type="password" placeholder="Contraseña" name="passw0rd">
                            <button>Entrar</button>
                        </form>
                        <!--Contenedor de register-->
                        <form action="php/registro_usuario_be.php" method="POST" class="formulario__register">
                            <h2>Registrarse</h2>
                            <input type="text" placeholder="Nombre Completo" name="nombre_completo">
                            <input type="text" placeholder="Correo Electronico" name="correo">
                            <input type="text" placeholder="Numero de telefono" name="Telefono">
                            <input type="password" placeholder="Contraseña" name="passw0rd">
                            <label for="TipoUsuario">Elija o escriba el tipo de usuario con el que se identifique:</label>
                            <input list="opciones" id="TipoUsuario" name="TipoUsuario" required>
                            <datalist id="opciones">
                                <option value="Pertenezco a una empresa">Soy una empresa que busca brindar sus servicios</option>
                                <option value="Busco un servicio">Soy una persona que busca un servicio</option>
                            </datalist>
                            <button>Registrarse</button>
                        </form>
                    </div>
                </div>
            </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="footer-content">
            <div class="footer-copyright">
                © 2025 OptiConstruct. Todos los derechos reservados.
                <!-- Designed by <a href="https://templatemo.com" target="_blank" rel="noopener noreferrer">TemplateMo</a> -->
            </div>
            <div class="footer-links">
                <a href="#privacy" onclick="event.preventDefault(); alert('Privacy Policy page would go here');">Políticas de privacidad</a>
                <a href="#terms" onclick="event.preventDefault(); alert('Terms of Service page would go here');">Términos de uso</a>
            </div>
        </div>
    </footer>

    <!-- Scroll to top button -->
    <div class="scroll-to-top" id="scrollToTop">
        <span>↑</span>
    </div>

    <script src="templatemo-3d-coverflow-scripts.js"></script>

</body>

</html>