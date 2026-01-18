<?php
require_once 'config.php';
$pageTitle = 'Home';
$additionalJS = ['dash.js'];
include 'includes/header.php';
?>

<section class="hero">
    <div class="hero-content">
        <h1>Welcome to E-Welfare Bangladesh</h1>
        <p>Connecting communities across Bangladesh through volunteerism, healthcare, and sustainable support systems.</p>
        <div class="hero-buttons">
            <button class="primary-btn">Learn More</button>
            <button class="secondary-btn">Watch Video <i class="fas fa-play"></i></button>
        </div>
    </div>
    <div class="hero-image">
        <img src="cover.jpg" alt="Bangladeshi community helping hands">
    </div>
</section>

<section class="stats">
    <div class="stat-item">
        <h3>1,200+</h3>
        <p>Bangladeshi Volunteers</p>
    </div>
    <div class="stat-item">
        <h3>350+</h3>
        <p>Local Doctors</p>
    </div>
    <div class="stat-item">
        <h3>64</h3>
        <p>Districts Covered</p>
    </div>
</section>

<section class="cards">
    <h2 class="section-title">Our Bangladeshi Community</h2>
    <p class="section-subtitle">Meet some of our dedicated members</p>
    
    <div class="card-container">
        <div class="card">
            <div class="card-icon">
                <i class="fas fa-hands-helping"></i>
            </div>
            <img src="https://www.ifrc.org/sites/default/files/styles/article_press_release_featured_image/public/2024-08/minara_helps_facilitate_block-level_awareness_sessions.jpeg?itok=PNcMBD5f" alt="Volunteer">
            <div class="card-content">
                <h3>Raima Begum</h3>
                <p>Dhaka-based volunteer for 3 years. "Helping my community gives me purpose."</p>
                <button class="card-btn">Read Story</button>
            </div>
        </div>
        <div class="card">
            <div class="card-icon">
                <i class="fas fa-user-md"></i>
            </div>
            <img src="https://www.hmmgo.com/wp-content/uploads/2023/05/Dr.-Nahid-Hakim-768x958.webp" alt="Doctor">
            <div class="card-content">
                <h3>Dr. Nahid Hakim</h3>
                <p>Provides free medical camps in slum areas monthly.</p>
                <button class="card-btn">Read Story</button>
            </div>
        </div>
        <div class="card">
            <div class="card-icon">
                <i class="fas fa-tractor"></i>
            </div>
            <img src="https://images.unsplash.com/photo-1630390077969-abc328259b00?q=80&w=3087&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="Farmer">
            <div class="card-content">
                <h3>Mohammad Ali</h3>
                <p>Received agricultural training and support in Barisal.</p>
                <button class="card-btn">Read Story</button>
            </div>
        </div>
    </div>
</section>

<section class="testimonials">
    <h2 class="section-title">Success Stories from Bangladesh</h2>
    <p class="section-subtitle">Hear from those we've helped across the country</p>
    
    <div class="testimonial-container">
        <div class="testimonial">
            <div class="quote">"E-Welfare connected me with medical care when my child was sick. They saved his life."</div>
            <div class="author">
                <img src="https://images.unsplash.com/photo-1622632405663-f43782a098b5?q=80&w=3087&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="Ayesha Begum">
                <div>
                    <h4>Ayesha Begum</h4>
                    <p>Mother from Sylhet</p>
                </div>
            </div>
        </div>
        <div class="testimonial">
            <div class="quote">"As a university student in Dhaka, volunteering has taught me the real meaning of community."</div>
            <div class="author">
                <img src="https://plus.unsplash.com/premium_photo-1682089877310-b2308b0dc719?q=80&w=2940&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D" alt="Rahim Khan">
                <div>
                    <h4>Raihan Ferdous</h4>
                    <p>AIUB Student & Volunteer</p>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="cta">
    <div class="cta-content">
        <h2>Ready to Serve Bangladesh?</h2>
        <p>Join our growing network of Bangladeshis helping Bangladeshis.</p>
        <?php if (!isLoggedIn()): ?>
            <button id="signUpBtn">Sign Up Now</button>
        <?php else: ?>
            <a href="services.php" class="primary-btn">Explore Services</a>
        <?php endif; ?>
    </div>
</section>

<!-- Sign Up Modal -->
<?php if (!isLoggedIn()): ?>
<div id="signupModal" class="modal">
  <div class="modal-content">
    <span class="close">&times;</span>
    <h2>Join E-Welfare Bangladesh</h2>
    <form id="signupForm">
      <div class="form-group">
        <label for="name">Full Name</label>
        <input type="text" id="name" name="name" required>
      </div>
      <div class="form-group">
        <label for="username">Username</label>
        <input type="text" id="username" name="username" required>
      </div>
      <div class="form-group">
        <label for="email">Email</label>
        <input type="email" id="email" name="email" required>
      </div>
      <div class="form-group">
        <label for="phone">Phone Number</label>
        <input type="tel" id="phone" name="phone" required>
      </div>
      <div class="form-group">
        <label for="password">Password <span style="color: #666; font-weight: normal; font-size: 0.85rem;">(Minimum 6 characters)</span></label>
        <div style="position: relative;">
          <input type="password" id="password" name="password" required minlength="6" style="padding-right: 45px;">
          <span class="toggle-password" id="togglePasswordSignup" style="position: absolute; right: 15px; top: 50%; transform: translateY(-50%); cursor: pointer; color: #666; font-size: 1.1rem;">
            <i class="far fa-eye"></i>
          </span>
        </div>
        <small style="color: #666; font-size: 0.85rem; display: block; margin-top: 5px;">Password must be at least 6 characters long</small>
      </div>
      <div class="form-group">
        <label for="role">I want to join as:</label>
        <select id="role" name="role" required>
          <option value="">Select role</option>
          <option value="volunteer">Volunteer</option>
          <option value="doctor">Medical Professional</option>
          <option value="farmer">Farmer</option>
          <option value="supporter">Community Supporter</option>
        </select>
      </div>
      <div class="form-group">
        <label for="district">District</label>
        <select id="district" name="district" required>
          <option value="">Select District</option>
          <option value="dhaka">Dhaka</option>
          <option value="chittagong">Chittagong</option>
          <option value="sylhet">Sylhet</option>
          <option value="khulna">Khulna</option>
          <option value="barishal">Barishal</option>
          <option value="rajshahi">Rajshahi</option>
          <option value="rangpur">Rangpur</option>
          <option value="mymensingh">Mymensingh</option>
          <!-- Add all 64 districts as needed -->
        </select>
      </div>
      <div id="signupError" class="error-message" style="display: none;"></div>
      <button type="submit" class="primary-btn">Register Now</button>
    </form>
    <div id="successMessage" style="display: none;">
      <div class="success-icon">
        <i class="fas fa-check-circle"></i>
      </div>
      <h3>Registration Successful!</h3>
      <p>Welcome <span id="successName"></span> (<span id="successUsername"></span>)</p>
      <p>You've joined as a <span id="successRole"></span> from <span id="successDistrict"></span> district.</p>
      <div class="success-buttons">
        <button id="continueBtn" class="primary-btn">Continue to Dashboard</button>
        <button id="closeBtn" class="secondary-btn">Close</button>
      </div>
    </div>
  </div>
</div>
<?php endif; ?>

<?php include 'includes/footer.php'; ?>
