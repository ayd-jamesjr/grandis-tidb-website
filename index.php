<?php
// Include Database Connection
require_once 'db.php';

$success_message = '';
$error_message = '';

// Handle Form Submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name    = trim($_POST['name'] ?? '');
    $email   = trim($_POST['email'] ?? '');
    $service = trim($_POST['service'] ?? 'General Inquiry');
    $message = trim($_POST['message'] ?? '');

    // Server-side Validation
    if (empty($name) || empty($email) || empty($message)) {
        $error_message = "Please fill in all required fields.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $error_message = "Please enter a valid email address.";
    } else {
        try {
            // Insert inquiry safely using Prepared Statements (Prevents SQL Injection)
            $stmt = $pdo->prepare("INSERT INTO inquiries (name, email, service, message) VALUES (:name, :email, :service, :message)");
            $stmt->execute([
                ':name'    => $name,
                ':email'   => $email,
                ':service' => $service,
                ':message' => $message
            ]);
            $success_message = "Thank you, $name! Your inquiry has been saved successfully to our TiDB Cloud database.";
        } catch (PDOException $e) {
            $error_message = "Database Error: Unable to record inquiry. Please try again later.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Grandis | Build. Scale. Evolve.</title>
    <link rel="stylesheet" href="style.css">
    <!-- FontAwesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>

    <!-- Header & Navigation -->
    <header class="header">
        <div class="container nav-container">
            <a href="#hero" class="logo">
                <span class="brand-name">Grandis</span>
                <span class="tagline">Build. Scale. Evolve.</span>
            </a>
            <nav class="navbar" id="navbar">
                <ul class="nav-links">
                    <li><a href="#hero">Home</a></li>
                    <li><a href="#about">About</a></li>
                    <li><a href="#services">Services</a></li>
                    <li><a href="#approach">Our Approach</a></li>
                    <li><a href="#why-us">Why Grandis</a></li>
                    <li><a href="#contact">Contact</a></li>
                </ul>
            </nav>
            <div class="nav-right">
                <a href="#contact" class="btn btn-primary nav-cta">Let's Talk</a>
                <div class="menu-toggle" id="mobile-menu" aria-label="Toggle Navigation">
                    <i class="fas fa-bars"></i>
                </div>
            </div>
        </div>
    </header>

    <!-- Hero Section -->
    <section id="hero" class="hero">
        <div class="container hero-content">
            <div class="hero-text">
                <div class="hero-badge">
                    <span title="Liberia">🇱🇷</span> <span title="Rwanda">🇷🇼</span>
                    <span>Liberian Resilience &bull; Rwandan Innovation</span>
                </div>
                <h1>We Build Digital Solutions That Move Businesses Forward.</h1>
                <p>From web development and intelligent automation to cloud systems and digital strategy, Grandis helps businesses turn ideas into practical digital solutions.</p>
                <div class="hero-btns">
                    <a href="#services" class="btn btn-primary">Explore Our Services</a>
                    <a href="#contact" class="btn btn-secondary">Start a Conversation</a>
                </div>
            </div>
            <div class="hero-visual">
                <div class="tech-card-glass">
                    <div class="card-header-dots">
                        <span></span><span></span><span></span>
                    </div>
                    <div class="code-snippet">
                        <code>
                            <span class="keyword">class</span> <span class="class-name">GrandisSolution</span> {<br>
                            &nbsp;&nbsp;<span class="keyword">constructor</span>() {<br>
                            &nbsp;&nbsp;&nbsp;&nbsp;this.vision = <span class="string">"Build. Scale. Evolve."</span>;<br>
                            &nbsp;&nbsp;&nbsp;&nbsp;this.database = <span class="string">"TiDB Cloud Engine"</span>;<br>
                            &nbsp;&nbsp;}<br>
                            }
                        </code>
                    </div>
                    <div class="card-footer-info">
                        <i class="fas fa-database"></i> Cloud Distributed SQL &bull; TiDB Powered
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- About Grandis Section -->
    <section id="about" class="about">
        <div class="container">
            <div class="section-title">
                <h2>About Grandis</h2>
                <p>Engineering robust digital solutions with global standards and local African impact.</p>
            </div>
            <div class="about-grid">
                <div class="about-card">
                    <div class="about-icon"><i class="fas fa-bullseye"></i></div>
                    <h3>Our Mission</h3>
                    <p>To help businesses and entrepreneurs use technology to build better products, improve operations, and grow sustainably in the modern economy.</p>
                </div>
                <div class="about-card">
                    <div class="about-icon"><i class="fas fa-eye"></i></div>
                    <h3>Our Vision</h3>
                    <p>To emerge as a trusted technology partner across Africa and internationally, connecting engineering excellence with practical business value.</p>
                </div>
                <div class="about-card">
                    <div class="about-icon"><i class="fas fa-heart"></i></div>
                    <h3>Core Values</h3>
                    <p>Innovation, integrity, simplicity, excellence, and growth form the foundation of every system we design and deploy.</p>
                </div>
            </div>
            <div class="cultural-bridge-box">
                <div class="bridge-flags">
                    <span title="Liberia">🇱🇷</span> <span title="Rwanda">🇷🇼</span>
                </div>
                <div class="bridge-text">
                    <h3>The African Innovation Identity</h3>
                    <p>Grandis draws inspiration from the unyielding entrepreneurial resilience of Liberia and the rapid, tech-driven structural transformation of Rwanda. We unite these cultural pillars to deliver digital systems that are adaptable, precise, and built for long-term evolution.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Services Section -->
    <section id="services" class="services">
        <div class="container">
            <div class="section-title">
                <h2>Our Professional Services</h2>
                <p>Tailored technology solutions designed to elevate your business operations and online presence.</p>
            </div>
            <div class="services-grid">
                <div class="service-card">
                    <div class="service-icon"><i class="fas fa-code"></i></div>
                    <h3>1. Web Development</h3>
                    <p>Responsive business websites, landing pages, portfolio platforms, website maintenance, and clean business web applications.</p>
                    <a href="#contact" class="service-link" onclick="selectService('Web Development')">Discuss This Service <i class="fas fa-arrow-right"></i></a>
                </div>
                <div class="service-card">
                    <div class="service-icon"><i class="fas fa-brain"></i></div>
                    <h3>2. AI and Automation</h3>
                    <p>Practical AI integration, workflow automation, business process improvement, and AI-powered productivity solutions.</p>
                    <a href="#contact" class="service-link" onclick="selectService('AI and Automation')">Discuss This Service <i class="fas fa-arrow-right"></i></a>
                </div>
                <div class="service-card">
                    <div class="service-icon"><i class="fas fa-cloud"></i></div>
                    <h3>3. Cloud Systems</h3>
                    <p>Cloud deployment guidance, application hosting configuration, basic cloud architecture, and performance optimization.</p>
                    <a href="#contact" class="service-link" onclick="selectService('Cloud Systems')">Discuss This Service <i class="fas fa-arrow-right"></i></a>
                </div>
                <div class="service-card">
                    <div class="service-icon"><i class="fas fa-chart-line"></i></div>
                    <h3>4. Digital Strategy</h3>
                    <p>Digital transformation planning, technology stack recommendations, online business presence, and MVP planning for startups.</p>
                    <a href="#contact" class="service-link" onclick="selectService('Digital Strategy')">Discuss This Service <i class="fas fa-arrow-right"></i></a>
                </div>
            </div>
        </div>
    </section>

    <!-- Our Approach Section -->
    <section id="approach" class="approach">
        <div class="container">
            <div class="section-title">
                <h2>Our Approach</h2>
                <p>A simple, transparent four-step methodology ensuring clarity, precision, and delivery success.</p>
            </div>
            <div class="approach-grid">
                <div class="approach-step">
                    <div class="step-number">01</div>
                    <h3>Discover</h3>
                    <p>Understand the client's unique business needs, operational challenges, and strategic goals.</p>
                </div>
                <div class="approach-step">
                    <div class="step-number">02</div>
                    <h3>Plan</h3>
                    <p>Define the exact technical solution, project scope, milestones, and technological priorities.</p>
                </div>
                <div class="approach-step">
                    <div class="step-number">03</div>
                    <h3>Build</h3>
                    <p>Develop, configure, and rigorously test the agreed solution with clean code and high standards.</p>
                </div>
                <div class="approach-step">
                    <div class="step-number">04</div>
                    <h3>Evolve</h3>
                    <p>Deploy, review, and iteratively improve the solution as the business scales and grows.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Why Grandis Section -->
    <section id="why-us" class="why-us">
        <div class="container">
            <div class="section-title">
                <h2>Why Choose Grandis?</h2>
                <p>Built on principles of clarity, practical value, and sustainable technological growth.</p>
            </div>
            <div class="why-grid">
                <div class="why-card">
                    <i class="fas fa-check-circle"></i>
                    <h3>Practical Solutions</h3>
                    <p>We focus on goal-oriented digital products that solve real business problems without unnecessary complexity.</p>
                </div>
                <div class="why-card">
                    <i class="fas fa-bolt"></i>
                    <h3>Simple Technology</h3>
                    <p>We write clean, understandable code that is easy to maintain, scale, and audit by technical teams.</p>
                </div>
                <div class="why-card">
                    <i class="fas fa-hand-holding-usd"></i>
                    <h3>Business Value</h3>
                    <p>Every engineering decision is aligned with cost efficiency, usability, and return on investment for your enterprise.</p>
                </div>
                <div class="why-card">
                    <i class="fas fa-globe-africa"></i>
                    <h3>African Perspective</h3>
                    <p>A growth-oriented mindset attuned to the dynamic realities of African markets and international digital standards.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="contact">
        <div class="container">
            <div class="section-title">
                <h2>Get In Touch</h2>
                <p>Ready to build or scale your next project? Reach out to discuss your ideas with our team.</p>
            </div>
            <div class="contact-wrapper">
                <div class="contact-info">
                    <h3>Let's Start a Conversation</h3>
                    <p>Fill out the form with your project details. Your inquiry will be stored directly in our TiDB Cloud database for immediate processing.</p>
                    <div class="info-item">
                        <i class="fas fa-envelope"></i>
                        <span>contact@grandis-tech.com</span>
                    </div>
                    <div class="info-item">
                        <i class="fas fa-map-marker-alt"></i>
                        <span>Kigali, Rwanda &bull; Monrovia, Liberia</span>
                    </div>
                    <div class="info-notice">
                        <i class="fas fa-server"></i>
                        <small>Connected Engine: PHP PDO Drivers with TiDB Distributed Cloud Database.</small>
                    </div>
                </div>
                <form id="contact-form" class="contact-form" action="index.php#contact" method="POST">
                    <?php if (!empty($success_message)): ?>
                        <div class="form-feedback success"><?php echo htmlspecialchars($success_message); ?></div>
                    <?php endif; ?>
                    <?php if (!empty($error_message)): ?>
                        <div class="form-feedback error"><?php echo htmlspecialchars($error_message); ?></div>
                    <?php endif; ?>

                    <div class="form-group">
                        <label for="name">Your Name <span class="required">*</span></label>
                        <input type="text" id="name" name="name" required placeholder="Enter your full name" value="<?php echo htmlspecialchars($_POST['name'] ?? ''); ?>">
                    </div>
                    <div class="form-group">
                        <label for="email">Your Email <span class="required">*</span></label>
                        <input type="email" id="email" name="email" required placeholder="Enter your email address" value="<?php echo htmlspecialchars($_POST['email'] ?? ''); ?>">
                    </div>
                    <div class="form-group">
                        <label for="service-select">Interested Service</label>
                        <select id="service-select" name="service">
                            <option value="General Inquiry">General Inquiry</option>
                            <option value="Web Development">1. Web Development</option>
                            <option value="AI and Automation">2. AI and Automation</option>
                            <option value="Cloud Systems">3. Cloud Systems</option>
                            <option value="Digital Strategy">4. Digital Strategy</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="message">Your Message <span class="required">*</span></label>
                        <textarea id="message" name="message" rows="5" required placeholder="Describe your project, goals, or questions..."><?php echo htmlspecialchars($_POST['message'] ?? ''); ?></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Submit Inquiry to Cloud DB</button>
                </form>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container footer-content">
            <div class="footer-col">
                <div class="footer-logo">Grandis</div>
                <p class="footer-tagline">Build. Scale. Evolve.</p>
                <p class="footer-desc">Empowering African and global businesses through practical software engineering, cloud systems, and intelligent automation.</p>
                <div class="footer-flags" aria-label="Liberian and Rwandan flags">
                    <span title="Liberia">🇱🇷</span> <span title="Rwanda">🇷🇼</span>
                </div>
            </div>
            <div class="footer-col">
                <h4>Quick Links</h4>
                <ul class="footer-links">
                    <li><a href="#hero">Home</a></li>
                    <li><a href="#about">About</a></li>
                    <li><a href="#services">Services</a></li>
                    <li><a href="#approach">Our Approach</a></li>
                    <li><a href="#contact">Contact</a></li>
                </ul>
            </div>
            <div class="footer-col">
                <h4>Services</h4>
                <ul class="footer-links">
                    <li><a href="#services">Web Development</a></li>
                    <li><a href="#services">AI and Automation</a></li>
                    <li><a href="#services">Cloud Systems</a></li>
                    <li><a href="#services">Digital Strategy</a></li>
                </ul>
            </div>
            <div class="footer-col">
                <h4>Contact Info</h4>
                <p><i class="fas fa-envelope"></i> contact@grandis-tech.com</p>
                <p><i class="fas fa-map-marker-alt"></i> Kigali, Rwanda | Monrovia, Liberia</p>
            </div>
        </div>
        <div class="footer-bottom">
            <div class="container">
                <p>&copy; <span id="current-year">2026</span> Grandis. All rights reserved. Powered by TiDB Cloud Engine.</p>
            </div>
        </div>
    </footer>

    <script src="script.js"></script>
</body>
</html>
