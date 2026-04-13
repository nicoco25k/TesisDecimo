<!DOCTYPE html>
<html lang="es">

<head>
    <title>Nicolás Salazar — Desarrollador de Software</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Portafolio profesional de Nicolás Salazar, desarrollador de software e ingeniero de sistemas.">
    <link rel="shortcut icon" type="image/x-icon" href="files/img/LOGO_BLANCO_X.png">
    <link rel="stylesheet" href="files/css/bootstrap.min.css">
    <script src="https://kit.fontawesome.com/3a5bbe002b.js" crossorigin="anonymous"></script>
    <style>
        :root {
            --verde: #1a7a4a;
            --verde-claro: #e8f5ee;
            --texto: #1a1a1a;
            --texto-suave: #555;
            --borde: #e0e0e0;
        }

        * {
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', system-ui, sans-serif;
            color: var(--texto);
            background: #fff;
            margin: 0;
        }

        /* NAV */
        nav {
            position: sticky;
            top: 0;
            z-index: 100;
            background: #fff;
            border-bottom: 1px solid var(--borde);
            padding: 1rem 0;
        }

        .nav-inner {
            max-width: 960px;
            margin: 0 auto;
            padding: 0 1.5rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .nav-logo {
            font-size: 1.1rem;
            font-weight: 700;
            color: var(--verde);
            text-decoration: none;
            letter-spacing: -0.3px;
        }

        .nav-links {
            display: flex;
            gap: 2rem;
            list-style: none;
            margin: 0;
            padding: 0;
        }

        .nav-links a {
            font-size: 0.9rem;
            color: var(--texto-suave);
            text-decoration: none;
            transition: color .2s;
        }

        .nav-links a:hover {
            color: var(--verde);
        }

        /* HERO */
        .hero {
            max-width: 960px;
            margin: 0 auto;
            padding: 5rem 1.5rem 4rem;
            display: grid;
            grid-template-columns: 1fr auto;
            gap: 3rem;
            align-items: center;
        }

        .hero-badge {
            display: inline-block;
            background: var(--verde-claro);
            color: var(--verde);
            font-size: 0.8rem;
            font-weight: 600;
            padding: 4px 12px;
            border-radius: 20px;
            margin-bottom: 1rem;
            letter-spacing: 0.3px;
        }

        .hero h1 {
            font-size: clamp(1.8rem, 4vw, 2.8rem);
            font-weight: 700;
            line-height: 1.2;
            margin: 0 0 1rem;
            letter-spacing: -0.5px;
        }

        .hero h1 span {
            color: var(--verde);
        }

        .hero p {
            font-size: 1.05rem;
            color: var(--texto-suave);
            line-height: 1.7;
            margin: 0 0 2rem;
            max-width: 480px;
        }

        .hero-btns {
            display: flex;
            gap: 1rem;
            flex-wrap: wrap;
        }

        .btn-primary-custom {
            background: var(--verde);
            color: #fff;
            padding: 0.7rem 1.5rem;
            border-radius: 8px;
            text-decoration: none;
            font-size: 0.9rem;
            font-weight: 600;
            border: 2px solid var(--verde);
            transition: background .2s;
        }

        .btn-primary-custom:hover {
            background: #155c38;
            color: #fff;
        }

        .btn-outline-custom {
            color: var(--verde);
            padding: 0.7rem 1.5rem;
            border-radius: 8px;
            text-decoration: none;
            font-size: 0.9rem;
            font-weight: 600;
            border: 2px solid var(--verde);
            transition: background .2s;
        }

        .btn-outline-custom:hover {
            background: var(--verde-claro);
        }

        .hero-avatar {
            width: 140px;
            height: 140px;
            border-radius: 50%;
            background: var(--verde-claro);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 3rem;
            font-weight: 700;
            color: var(--verde);
            flex-shrink: 0;
            border: 3px solid var(--borde);
        }

        /* SECCIONES */
        section {
            border-top: 1px solid var(--borde);
            padding: 4rem 0;
        }

        .section-inner {
            max-width: 960px;
            margin: 0 auto;
            padding: 0 1.5rem;
        }

        .section-label {
            font-size: 0.75rem;
            font-weight: 700;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            color: var(--verde);
            margin-bottom: 0.5rem;
        }

        .section-title {
            font-size: 1.6rem;
            font-weight: 700;
            margin: 0 0 2.5rem;
            letter-spacing: -0.3px;
        }

        /* SKILLS */
        .skills-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1rem;
        }

        .skill-card {
            border: 1px solid var(--borde);
            border-radius: 10px;
            padding: 1.25rem;
            transition: border-color .2s;
        }

        .skill-card:hover {
            border-color: var(--verde);
        }

        .skill-icon {
            width: 38px;
            height: 38px;
            background: var(--verde-claro);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 0.75rem;
            color: var(--verde);
            font-size: 1rem;
        }

        .skill-card h4 {
            font-size: 0.95rem;
            font-weight: 700;
            margin: 0 0 0.25rem;
        }

        .skill-card p {
            font-size: 0.82rem;
            color: var(--texto-suave);
            margin: 0;
            line-height: 1.5;
        }

        /* PROYECTOS */
        .projects-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 1.25rem;
        }

        .project-card {
            border: 1px solid var(--borde);
            border-radius: 12px;
            padding: 1.5rem;
            display: flex;
            flex-direction: column;
            gap: 0.75rem;
            transition: border-color .2s, transform .2s;
        }

        .project-card:hover {
            border-color: var(--verde);
            transform: translateY(-2px);
        }

        .project-lang {
            display: inline-block;
            font-size: 0.75rem;
            font-weight: 600;
            padding: 3px 10px;
            border-radius: 20px;
            background: var(--verde-claro);
            color: var(--verde);
            width: fit-content;
        }

        .project-card h4 {
            font-size: 1rem;
            font-weight: 700;
            margin: 0;
        }

        .project-card p {
            font-size: 0.85rem;
            color: var(--texto-suave);
            margin: 0;
            line-height: 1.6;
            flex: 1;
        }

        .project-link {
            font-size: 0.82rem;
            color: var(--verde);
            text-decoration: none;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 4px;
        }

        .project-link:hover {
            text-decoration: underline;
        }

        /* CONTACTO */
        .contact-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 1rem;
        }

        .contact-item {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 1rem 1.25rem;
            border: 1px solid var(--borde);
            border-radius: 10px;
            text-decoration: none;
            color: var(--texto);
            transition: border-color .2s;
        }

        .contact-item:hover {
            border-color: var(--verde);
            color: var(--texto);
        }

        .contact-icon {
            width: 36px;
            height: 36px;
            background: var(--verde-claro);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--verde);
            flex-shrink: 0;
        }

        .contact-item span {
            font-size: 0.85rem;
            color: var(--texto-suave);
            display: block;
        }

        .contact-item strong {
            font-size: 0.9rem;
            display: block;
        }

        /* FOOTER */
        footer {
            background: #0f0f0f;
            color: #aaa;
            text-align: center;
            padding: 2rem 1.5rem;
            font-size: 0.85rem;
        }

        footer a {
            color: #fff;
            text-decoration: none;
        }

        /* RESPONSIVE */
        @media (max-width: 640px) {
            .hero {
                grid-template-columns: 1fr;
                padding: 3rem 1.5rem 2.5rem;
                text-align: center;
            }

            .hero-avatar {
                width: 90px;
                height: 90px;
                font-size: 2rem;
                margin: 0 auto;
                order: -1;
            }

            .hero p {
                max-width: 100%;
            }

            .hero-btns {
                justify-content: center;
            }

            .nav-links {
                display: none;
            }
        }
    </style>
</head>

<body>

    <!-- NAV -->
    <nav>
        <div class="nav-inner">
            <a href="#" class="nav-logo">Nicolás Salazar</a>
            <ul class="nav-links">
                <li><a href="#skills">Habilidades</a></li>
                <li><a href="#proyectos">Proyectos</a></li>
                <li><a href="#contacto">Contacto</a></li>
            </ul>
        </div>
    </nav>

    <!-- HERO -->
    <div style="max-width:960px;margin:0 auto;padding:0 1.5rem;">
        <div class="hero" style="padding-left:0;padding-right:0;">
            <div>
                <span class="hero-badge">Ingeniero de Sistemas</span>
                <h1>Hola, soy <span>Nicolás</span>.<br>Desarrollo software a medida.</h1>
                <p>Diseño y construyo soluciones digitales personalizadas para potenciar tu negocio — desde aplicaciones web hasta plataformas de gestión completas.</p>
                <div class="hero-btns">
                    <a href="#proyectos" class="btn-primary-custom">Ver proyectos</a>
                    <a href="#contacto" class="btn-outline-custom">Contactarme</a>
                </div>
            </div>
            <div class="hero-avatar">NS</div>
        </div>
    </div>

    <!-- SKILLS -->
    <section id="skills">
        <div class="section-inner">
            <p class="section-label">Tecnologías</p>
            <h2 class="section-title">Habilidades técnicas</h2>
            <div class="skills-grid">
                <div class="skill-card">
                    <div class="skill-icon"><i class="fa fa-code"></i></div>
                    <h4>Frontend</h4>
                    <p>HTML, CSS, Bootstrap, JavaScript — interfaces responsivas y modernas.</p>
                </div>
                <div class="skill-card">
                    <div class="skill-icon"><i class="fa fa-server"></i></div>
                    <h4>Backend</h4>
                    <p>PHP, manejo de bases de datos MySQL y arquitectura MVC.</p>
                </div>
                <div class="skill-card">
                    <div class="skill-icon"><i class="fa fa-database"></i></div>
                    <h4>Bases de datos</h4>
                    <p>Diseño y administración de bases de datos relacionales.</p>
                </div>
                <div class="skill-card">
                    <div class="skill-icon"><i class="fab fa-github"></i></div>
                    <h4>Control de versiones</h4>
                    <p>Git y GitHub para gestión de código y flujos de trabajo colaborativos.</p>
                </div>
                <div class="skill-card">
                    <div class="skill-icon"><i class="fa fa-globe"></i></div>
                    <h4>Diseño web</h4>
                    <p>Diseño de páginas web y administración de sitios completos.</p>
                </div>
                <div class="skill-card">
                    <div class="skill-icon"><i class="fa fa-cogs"></i></div>
                    <h4>CI/CD</h4>
                    <p>Configuración de pipelines de integración y despliegue continuo.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- PROYECTOS -->
    <section id="proyectos">
        <div class="section-inner">
            <p class="section-label">GitHub</p>
            <h2 class="section-title">Proyectos destacados</h2>
            <div class="projects-grid">
                <div class="project-card">
                    <span class="project-lang">PHP</span>
                    <h4>TesisDecimo</h4>
                    <p>Plataforma web para la gestión de información de una organización de protección animal. Sistema completo con autenticación, roles y administración de datos.</p>
                    <a href="https://github.com/nicoco25k/TesisDecimo" target="_blank" class="project-link">
                        Ver repositorio <i class="fa fa-arrow-right" style="font-size:11px;"></i>
                    </a>
                </div>
                <div class="project-card">
                    <span class="project-lang">JavaScript</span>
                    <h4>Task-3</h4>
                    <p>Desafío de desarrollo front-end que pone en práctica habilidades de maquetación e interacción con JavaScript moderno.</p>
                    <a href="https://github.com/nicoco25k/Task-3" target="_blank" class="project-link">
                        Ver repositorio <i class="fa fa-arrow-right" style="font-size:11px;"></i>
                    </a>
                </div>
                <div class="project-card">
                    <span class="project-lang">HTML</span>
                    <h4>Task-4</h4>
                    <p>Simulación de un pipeline CI/CD para el despliegue de una aplicación web simple — automatización de flujos de trabajo de desarrollo.</p>
                    <a href="https://github.com/nicoco25k/Task-4" target="_blank" class="project-link">
                        Ver repositorio <i class="fa fa-arrow-right" style="font-size:11px;"></i>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- SERVICIOS -->
    <section>
        <div class="section-inner">
            <p class="section-label">Servicios</p>
            <h2 class="section-title">¿En qué puedo ayudarte?</h2>
            <div class="skills-grid">
                <div class="skill-card">
                    <div class="skill-icon"><i class="fa fa-laptop"></i></div>
                    <h4>Diseño de páginas web</h4>
                    <p>Sitios modernos, rápidos y responsivos adaptados a tu negocio.</p>
                </div>
                <div class="skill-card">
                    <div class="skill-icon"><i class="fa fa-wrench"></i></div>
                    <h4>Administración de sitios</h4>
                    <p>Mantenimiento, actualizaciones y soporte técnico continuo.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- CONTACTO -->
    <section id="contacto">
        <div class="section-inner">
            <p class="section-label">Contacto</p>
            <h2 class="section-title">Hablemos</h2>
            <div class="contact-grid">
                <a href="tel:+573143459698" class="contact-item">
                    <div class="contact-icon"><i class="fa fa-phone"></i></div>
                    <div>
                        <span>Teléfono</span>
                        <strong>+57 314 345 9698</strong>
                    </div>
                </a>
                <a href="mailto:gamernico703@gmail.com" class="contact-item">
                    <div class="contact-icon"><i class="fa fa-envelope"></i></div>
                    <div>
                        <span>Correo electrónico</span>
                        <strong>gamernico703@gmail.com</strong>
                    </div>
                </a>
                <a href="https://github.com/nicoco25k" target="_blank" class="contact-item">
                    <div class="contact-icon"><i class="fab fa-github"></i></div>
                    <div>
                        <span>GitHub</span>
                        <strong>nicoco25k</strong>
                    </div>
                </a>
            </div>
        </div>
    </section>

    <!-- FOOTER -->
    <footer>
        <p>© 2026 <a href="#">Nicolás Salazar</a> · Todos los derechos reservados</p>
    </footer>

    <!-- Scripts -->
    <script src="files/js/bootstrap.bundle.min.js"></script>
    <script src="files/js/templatemo.js"></script>
    <script src="files/js/custom.js"></script>

</body>

</html>