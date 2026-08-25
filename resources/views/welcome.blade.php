<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nemo Security Lab - Securing Your Digital World</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        :root {
            --navy: #0a1e3c;
            --navy-light: #10315e;
            --blue: #2563eb;
            --blue-light: #60a5fa;
            --bg-light: #f8fafc;
            --text-dark: #1e293b;
            --text-muted: #64748b;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: var(--bg-light);
            color: var(--text-dark);
        }

        .navbar-landing {
            background: linear-gradient(135deg, var(--navy) 0%, var(--navy-light) 100%);
            box-shadow: 0 2px 10px rgba(0,0,0,0.15);
        }
        .navbar-brand {
            font-weight: 700;
            color: #fff !important;
            letter-spacing: 0.5px;
        }
        .navbar-brand i {
            color: var(--blue-light);
        }
        .navbar-nav .nav-link {
            color: #cbd5e1 !important;
            font-weight: 500;
        }
        .navbar-nav .nav-link:hover,
        .navbar-nav .nav-link.active {
            color: #ffffff !important;
        }
        .btn-outline-light:hover {
            background-color: rgba(255,255,255,0.1);
        }

        .hero {
            background: linear-gradient(135deg, #0a1e3c 0%, #10315e 50%, #1e40af 100%);
            color: #fff;
            padding: 100px 0;
            position: relative;
            overflow: hidden;
        }
        .hero::after {
            content: "";
            position: absolute;
            top: -30%;
            right: -5%;
            width: 500px;
            height: 500px;
            background: rgba(96, 165, 250, 0.1);
            border-radius: 50%;
            pointer-events: none;
        }
        .hero h1 {
            font-weight: 700;
            font-size: 3rem;
            line-height: 1.3;
        }
        .hero p {
            font-size: 1.2rem;
            color: #cbd5e1;
        }
        .btn-primary-custom {
            background: var(--blue);
            border: none;
            border-radius: 30px;
            padding: 12px 30px;
            font-weight: 600;
            transition: 0.3s;
        }
        .btn-primary-custom:hover {
            background: #1d4ed8;
            transform: translateY(-2px);
        }

        .section-title {
            font-weight: 700;
            color: var(--navy);
        }
        .feature-card,
        .service-card {
            background: #fff;
            border: none;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
            transition: 0.3s;
            height: 100%;
        }
        .feature-card:hover,
        .service-card:hover {
            box-shadow: 0 10px 25px rgba(0,0,0,0.08);
            transform: translateY(-5px);
        }
        .feature-icon,
        .service-icon {
            width: 60px;
            height: 60px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 28px;
            margin-bottom: 20px;
            background: rgba(37, 99, 235, 0.1);
            color: var(--blue);
        }

        .contact-info i {
            color: var(--blue);
            margin-right: 10px;
        }

        .faq .accordion-button:not(.collapsed) {
            background-color: #e8f0fe;
            color: var(--navy);
        }

        .footer {
            background: var(--navy);
            color: #cbd5e1;
            padding: 40px 0 20px;
        }
        .footer h5 {
            color: #fff;
        }
        .footer a {
            color: #cbd5e1;
            text-decoration: none;
        }
        .footer a:hover {
            color: #fff;
        }
        .newsletter .form-control {
            border-radius: 30px 0 0 30px;
        }
        .newsletter .btn {
            border-radius: 0 30px 30px 0;
        }

        .cyber-threat {
            background: #0f172a;
            color: #cbd5e1;
        }
        .cyber-threat h2 {
            color: #fff;
        }
        .cyber-threat .stat-number {
            font-size: 2.5rem;
            font-weight: 700;
            color: #60a5fa;
        }
    </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark navbar-landing">
    <div class="container">
        <a class="navbar-brand" href="{{ route('welcome') }}">
            <i class="bi bi-shield-lock-fill"></i> Nemo Security
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mx-auto">
                <li class="nav-item"><a class="nav-link" href="#home">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="#about">About</a></li>
                <li class="nav-item"><a class="nav-link" href="#services">Our Services</a></li>
                <li class="nav-item"><a class="nav-link" href="#threats">Threat Landscape</a></li>
                <li class="nav-item"><a class="nav-link" href="#contact">Contact</a></li>
            </ul>
            <ul class="navbar-nav">
                @auth
                    <li class="nav-item">
                        <a class="btn btn-outline-light btn-sm me-2" href="{{ route('dashboard') }}">
                            <i class="bi bi-speedometer2"></i> Dashboard
                        </a>
                    </li>
                    <li class="nav-item">
                        <form method="POST" action="{{ route('logout') }}" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-outline-light btn-sm">
                                <i class="bi bi-box-arrow-right"></i> Logout
                            </button>
                        </form>
                    </li>
                @else
                    <li class="nav-item">
                        <!-- Open Redirect vulnerability: parameter redirect -->
                        <a class="btn btn-outline-light btn-sm" href="{{ route('login') }}?redirect={{ request()->get('redirect') ?? '/' }}">
                            <i class="bi bi-box-arrow-in-right"></i> Sign In
                        </a>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>

<!-- Hero Section -->
<section class="hero" id="home">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-7">
                <h1>Securing Your Digital World</h1>
                <p class="lead mt-3">
                    Your Trusted Partner in Data Protection with Cutting Edge Solutions for Data Security.
                </p>
                <div class="mt-4">
                    <a href="#contact" class="btn btn-primary-custom btn-lg">
                        <i class="bi bi-chat-dots"></i> Contact Us
                    </a>
                    @auth
                        <a href="{{ route('dashboard') }}" class="btn btn-outline-light btn-lg ms-2">
                            <i class="bi bi-speedometer2"></i> Open Dashboard
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-outline-light btn-lg ms-2">
                            <i class="bi bi-box-arrow-in-right"></i> Sign In
                        </a>
                    @endauth
                </div>
            </div>
            <div class="col-lg-5 text-center">
                <i class="bi bi-shield-lock-fill" style="font-size: 130px; color: #60a5fa;"></i>
            </div>
        </div>
    </div>
</section>

<!-- About Section -->
<section class="py-5" id="about">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <h2 class="section-title mb-3">About Nemo Security</h2>
                <p class="text-muted">
                    Nemo Security is a leading cybersecurity company dedicated to protecting organizations from evolving digital threats. We provide comprehensive security assessments, penetration testing, vulnerability management, and incident response services.
                </p>
                <p class="text-muted">
                    Our team of certified experts uses cutting-edge technology and industry best practices to identify weaknesses, secure your infrastructure, and ensure compliance with international standards.
                </p>
            </div>
            <div class="col-lg-6">
                <div class="row g-3">
                    <div class="col-6">
                        <div class="feature-card p-3 text-center">
                            <i class="bi bi-award fs-1 text-primary"></i>
                            <h5 class="mt-2">Certified Experts</h5>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="feature-card p-3 text-center">
                            <i class="bi bi-shield-check fs-1 text-primary"></i>
                            <h5 class="mt-2">Trusted Protection</h5>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="feature-card p-3 text-center">
                            <i class="bi bi-graph-up fs-1 text-primary"></i>
                            <h5 class="mt-2">Proven Results</h5>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="feature-card p-3 text-center">
                            <i class="bi bi-globe fs-1 text-primary"></i>
                            <h5 class="mt-2">Global Reach</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Services Section -->
<section class="py-5 bg-white" id="services">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="section-title">Our Services</h2>
            <p class="text-muted">Comprehensive cybersecurity solutions for your business</p>
        </div>
        <div class="row g-4">
            <div class="col-md-3">
                <div class="service-card p-4">
                    <div class="service-icon"><i class="bi bi-bug"></i></div>
                    <h5>Penetration Testing</h5>
                    <p class="text-muted">Simulate real-world attacks to uncover vulnerabilities.</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="service-card p-4">
                    <div class="service-icon"><i class="bi bi-shield-check"></i></div>
                    <h5>Security Assessment</h5>
                    <p class="text-muted">Evaluate your security posture and compliance.</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="service-card p-4">
                    <div class="service-icon"><i class="bi bi-lightning-charge"></i></div>
                    <h5>Incident Response</h5>
                    <p class="text-muted">Rapid response to security breaches and threats.</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="service-card p-4">
                    <div class="service-icon"><i class="bi bi-journal-check"></i></div>
                    <h5>Compliance Audit</h5>
                    <p class="text-muted">Ensure compliance with industry standards.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Cyber Threat Landscape Section -->
<section class="py-5 cyber-threat" id="threats">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="section-title text-white">Cyber Threat Landscape</h2>
            <p class="text-muted">Understanding today's digital risks</p>
        </div>
        <div class="row text-center g-4">
            <div class="col-md-3">
                <div class="stat-number">$6T</div>
                <p>Estimated global cybercrime damage annually</p>
            </div>
            <div class="col-md-3">
                <div class="stat-number">30B</div>
                <p>Data records breached each year</p>
            </div>
            <div class="col-md-3">
                <div class="stat-number">74%</div>
                <p>Of breaches involve human element</p>
            </div>
            <div class="col-md-3">
                <div class="stat-number">280d</div>
                <p>Average time to identify & contain breach</p>
            </div>
        </div>
    </div>
</section>

<!-- Why Choose Us Section -->
<section class="py-5 bg-white">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="section-title">Why Choose Nemo Security</h2>
        </div>
        <div class="row g-4">
            <div class="col-md-4">
                <div class="service-card p-4">
                    <i class="bi bi-person-check fs-1 text-primary"></i>
                    <h5 class="mt-3">Expert Team</h5>
                    <p class="text-muted">Certified professionals with years of real-world experience.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="service-card p-4">
                    <i class="bi bi-tools fs-1 text-primary"></i>
                    <h5 class="mt-3">Advanced Tools</h5>
                    <p class="text-muted">We use industry-leading tools and proprietary methodologies.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="service-card p-4">
                    <i class="bi bi-clock-history fs-1 text-primary"></i>
                    <h5 class="mt-3">24/7 Support</h5>
                    <p class="text-muted">Round-the-clock monitoring and rapid incident response.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Contact Section -->
<section class="py-5" id="contact">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="section-title">Contact</h2>
            <p class="text-muted">Write us a message. Our team is ready to assist you promptly.</p>
        </div>
        <div class="row g-4">
            <div class="col-lg-5">
                <div class="card p-4 h-100 contact-info">
                    <h5>Contact Information</h5>
                    <p class="mb-4">Send us a message anytime.</p>
                    <div class="mb-3">
                        <i class="bi bi-geo-alt"></i>
                        <strong>Office:</strong><br>
                        18 Office Park Building, 21th Floor Unit C<br>
                        Jl. TB Simatupang No.18, Jakarta 12520
                    </div>
                    <div class="mb-3">
                        <i class="bi bi-telephone"></i>
                        <strong>Phone:</strong><br>
                        (+62) 811-4441-1988
                    </div>
                    <div class="mb-3">
                        <i class="bi bi-envelope"></i>
                        <strong>Email:</strong><br>
                        sales@nemosecurity.com
                    </div>
                </div>
            </div>
            <div class="col-lg-7">
                <div class="card p-4 h-100">
                    <form>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">Full Name</label>
                                <input type="text" class="form-control" placeholder="Enter your full name">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Email</label>
                                <input type="email" class="form-control" placeholder="Example@gmail.com">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Company Name</label>
                                <input type="text" class="form-control" placeholder="Enter your company name">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Company Website</label>
                                <input type="text" class="form-control" placeholder="company.com or https://company.com">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Industry</label>
                                <select class="form-select">
                                    <option>Select your option</option>
                                    <option>Finance</option>
                                    <option>Healthcare</option>
                                    <option>Technology</option>
                                    <option>Government</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Main Area of Operations</label>
                                <select class="form-select">
                                    <option>Select your option</option>
                                    <option>Indonesia</option>
                                    <option>Asia Pacific</option>
                                    <option>Global</option>
                                </select>
                            </div>
                            <div class="col-12">
                                <label class="form-label">Product & Services</label>
                                <select class="form-select">
                                    <option>Select your option</option>
                                    <option>Penetration Testing</option>
                                    <option>Security Assessment</option>
                                    <option>Incident Response</option>
                                    <option>Compliance Audit</option>
                                </select>
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary-custom btn-lg">
                                    <i class="bi bi-send"></i> Submit
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- FAQ Section -->
<section class="py-5 bg-white faq">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="section-title">Got Questions?</h2>
            <p class="text-muted">Frequently Asked Questions</p>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="accordion" id="faqAccordion">
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#faq1">
                                What services does your company provide?
                            </button>
                        </h2>
                        <div id="faq1" class="accordion-collapse collapse show" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">We provide penetration testing, security assessment, incident response, and compliance audit services.</div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq2">
                                Who can benefit from your services?
                            </button>
                        </h2>
                        <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">Any organization that values data security, from startups to enterprises, across all industries.</div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq3">
                                How do you ensure the security of client data?
                            </button>
                        </h2>
                        <div id="faq3" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">We follow strict confidentiality agreements and use secure communication channels throughout the engagement.</div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq4">
                                Do you offer customized security solutions?
                            </button>
                        </h2>
                        <div id="faq4" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">Yes, every solution is tailored to the specific needs and risk profile of the client.</div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq5">
                                How can we get started with your services?
                            </button>
                        </h2>
                        <div id="faq5" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body">Simply contact us via the form above, and our team will reach out to discuss your requirements.</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Footer -->
<footer class="footer">
    <div class="container">
        <div class="row g-4">
            <div class="col-md-4">
                <h5><i class="bi bi-shield-lock-fill"></i> Nemo Security</h5>
                <p>Securing Your Digital World: Your Trusted Partner in Data Protection with Cutting Edge Solutions for Data Security.</p>
                <!-- Information Disclosure: menampilkan versi aplikasi -->
                <small>App version: 1.0.0 (debug mode: {{ config('app.debug') ? 'true' : 'false' }})</small>
            </div>
            <div class="col-md-2">
                <h5>Menu</h5>
                <ul class="list-unstyled">
                    <li><a href="#home">Home</a></li>
                    <li><a href="#about">About</a></li>
                    <li><a href="#services">Services</a></li>
                    <li><a href="#contact">Contact</a></li>
                </ul>
            </div>
            <div class="col-md-3">
                <h5>Contact</h5>
                <ul class="list-unstyled">
                    <li><i class="bi bi-geo-alt"></i> 18 Office Park Building, Jakarta</li>
                    <li><i class="bi bi-telephone"></i> (+62) 811-4441-1988</li>
                    <li><i class="bi bi-envelope"></i> sales@nemosecurity.com</li>
                </ul>
            </div>
            <div class="col-md-3">
                <h5>Subscribe to Our Newsletter!</h5>
                <p>Stay informed with our latest security insights - subscribe today!</p>
                <form class="newsletter d-flex">
                    <input type="email" class="form-control" placeholder="Your Email">
                    <button class="btn btn-primary" type="submit">Send</button>
                </form>
            </div>
        </div>
        <hr class="mt-4" style="border-color:#334155;">
        <div class="text-center">
            <small>&copy; 2026. NemoSecurity</small>
        </div>
    </div>
</footer>

<!-- Reflected XSS via search query parameter -->
<div id="search-result" class="d-none">{{ request()->get('search') }}</div>
<script>
    // Menampilkan hasil pencarian tanpa sanitasi (Reflected XSS)
    var searchParam = new URLSearchParams(window.location.search).get('search');
    if (searchParam) {
        document.write('<div class="container mt-3"><div class="alert alert-warning">Search result for: ' + searchParam + '</div></div>');
    }
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>