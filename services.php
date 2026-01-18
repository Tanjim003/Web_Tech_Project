<?php
require_once 'config.php';
$pageTitle = 'Our Services';
$additionalCSS = ['services.css'];
$additionalJS = ['services.js'];
include 'includes/header.php';
?>

<section class="services-hero">
    <h1>Our Community Services</h1>
    <p>Making a difference across Bangladesh through these initiatives</p>
</section>

<section class="services-container">
    <!-- Service Cards -->
    <div class="service-card" id="doctor-service">
        <div class="service-icon">
            <i class="fas fa-user-md"></i>
        </div>
        <h2>Medical Volunteers</h2>
        <p>Volunteer your medical skills to help underserved communities.</p>
        <button class="service-btn" data-target="doctorForm">Get Started</button>
    </div>
    <div class="service-card" id="donator-program">
        <div class="service-icon">
            <i class="fas fa-hand-holding-heart"></i>
        </div>
        <h2>Become a Donator</h2>
        <p>Support our causes through financial contributions or material donations.</p>
        <button class="service-btn" data-target="donationForm">Learn More</button>
    </div>

    <div class="service-card" id="tree-plantation">
        <div class="service-icon">
            <i class="fas fa-tree"></i>
        </div>
        <h2>Tree Plantation</h2>
        <p>Join our green initiative to plant trees across urban and rural areas.</p>
        <button class="service-btn" data-target="treeForm">Join Program</button>
    </div>
    <div class="service-card" id="animal-welfare">
        <div class="service-icon">
            <i class="fas fa-paw"></i>
        </div>
        <h2>Animal Compassion Program</h2>
        <p>Help protect and care for street animals and wildlife in our communities.</p>
        <button class="service-btn" data-target="animalForm">Get Involved</button>
    </div>
    <div class="service-card" id="food-support">
        <div class="service-icon">
            <i class="fas fa-utensils"></i>
        </div>
        <h2>Community Food Share</h2>
        <p>Join our efforts to provide nutritious meals to families in need.</p>
        <button class="service-btn" data-target="foodForm">Volunteer/Donate</button>
    </div>
    <div class="service-card" id="farmer-service">
        <div class="service-icon">
            <i class="fas fa-tractor"></i>
        </div>
        <h2>Programs for Farmer</h2>
        <p>Apply for our modern and designed farming program help to boost farming</p>
        <button class="service-btn" data-target="farmerForm">Get Started</button>
    </div>
</section>

<!-- Service Modals -->
<div class="service-modal" id="donationForm">
    <div class="modal-content">
        <span class="close-modal">&times;</span>
        <h3>Donation Form</h3>
        <form class="service-form" data-service="donation">
            <div class="form-group">
                <label>Full Name</label>
                <input type="text" name="full_name" placeholder="Your name" required>
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" placeholder="your@email.com" required>
            </div>
            <div class="form-group">
                <label>Phone</label>
                <input type="tel" name="phone" placeholder="Your phone number" required>
            </div>
            <div class="form-group">
                <label>Donation Type</label>
                <select name="donation_type" required>
                    <option value="">Select type</option>
                    <option value="Financial">Financial</option>
                    <option value="Material Goods">Material Goods</option>
                    <option value="Both">Both</option>
                </select>
            </div>
            <div class="form-group">
                <label>Amount/Items</label>
                <input type="text" name="amount_items" placeholder="Amount or items description" required>
            </div>
            <button type="submit" class="primary-btn">Submit Donation</button>
            <div class="thank-you-message" style="display: none;">
                Thank you for your generosity! We'll contact you shortly.
            </div>
        </form>
    </div>
</div>

<div class="service-modal" id="doctorForm">
    <div class="modal-content">
        <span class="close-modal">&times;</span>
        <h3>Medical Volunteer Registration</h3>
        <form class="service-form" data-service="doctor">
            <div class="form-group">
                <label>Full Name</label>
                <input type="text" name="full_name" placeholder="Dr. Full Name" required>
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" placeholder="your@email.com" required>
            </div>
            <div class="form-group">
                <label>Phone</label>
                <input type="tel" name="phone" placeholder="Your phone number" required>
            </div>
            <div class="form-group">
                <label>Specialization</label>
                <select name="specialization" required>
                    <option value="">Select option</option>
                    <option value="Cardiology">Cardiology</option>
                    <option value="Oncologist">Oncologist</option>
                    <option value="Dermatology">Dermatology</option>
                    <option value="Emergency medicine">Emergency medicine</option>
                    <option value="Obstetrics and gynaecology">Obstetrics and gynaecology</option>
                    <option value="Gastroenterology">Gastroenterology</option>
                </select>
            </div>
            <div class="form-group">
                <label>Medical License Number</label>
                <input type="text" name="medical_license" placeholder="License number" required>
            </div>
            <div class="form-group">
                <label>Availability</label>
                <input type="text" name="availability" placeholder="Days/times you can volunteer" required>
            </div>
            <button type="submit" class="primary-btn">Register as Volunteer</button>
            <div class="thank-you-message" style="display: none;">
                Thank you for your application! We'll review your credentials shortly.
            </div>
        </form>
    </div>
</div>

<div class="service-modal" id="animalForm">
    <div class="modal-content">
        <span class="close-modal">&times;</span>
        <h3>Animal Compassion Program</h3>
        <form class="service-form" data-service="animal_welfare">
            <div class="form-group">
                <label>Your Name</label>
                <input type="text" name="full_name" placeholder="Full name" required>
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" placeholder="your@email.com" required>
            </div>
            <div class="form-group">
                <label>Phone</label>
                <input type="tel" name="phone" placeholder="Your phone number" required>
            </div>
            <div class="form-group">
                <label>Interest Area</label>
                <select name="interest_area" required>
                    <option value="">Select option</option>
                    <option value="Rescue Operations">Rescue Operations</option>
                    <option value="Shelter Volunteering">Shelter Volunteering</option>
                    <option value="Veterinary Support">Veterinary Support</option>
                    <option value="Adoption Services">Adoption Services</option>
                </select>
            </div>
            <div class="form-group">
                <label>Availability</label>
                <input type="text" name="availability" placeholder="Days/times available" required>
            </div>
            <button type="submit" class="primary-btn">Join Program</button>
            <div class="thank-you-message" style="display: none;">
                Thank you for your compassion! Our team will contact you soon.
            </div>
        </form>
    </div>
</div>

<div class="service-modal" id="foodForm">
    <div class="modal-content">
        <span class="close-modal">&times;</span>
        <h3>Community Food Share</h3>
        <form class="service-form" data-service="food_support">
            <div class="form-group">
                <label>Your Name</label>
                <input type="text" name="full_name" placeholder="Full name" required>
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" placeholder="your@email.com" required>
            </div>
            <div class="form-group">
                <label>Phone</label>
                <input type="tel" name="phone" placeholder="Your phone number" required>
            </div>
            <div class="form-group">
                <label>Participation Type</label>
                <select name="participation_type" required>
                    <option value="">Select option</option>
                    <option value="Volunteer at Distribution">Volunteer at Distribution</option>
                    <option value="Donate Food Items">Donate Food Items</option>
                    <option value="Sponsor a Meal">Sponsor a Meal</option>
                    <option value="All of the above">All of the above</option>
                </select>
            </div>
            <div class="form-group">
                <label>Preferred Location</label>
                <input type="text" name="preferred_location" placeholder="Nearest community center" required>
            </div>
            <button type="submit" class="primary-btn">Submit</button>
            <div class="thank-you-message" style="display: none;">
                Thank you for fighting hunger! We'll send you details shortly.
            </div>
        </form>
    </div>
</div>

<div class="service-modal" id="farmerForm">
    <div class="modal-content">
        <span class="close-modal">&times;</span>
        <h3>Farmer Support Program</h3>
        <form class="service-form" data-service="farmer">
            <div class="form-group">
                <label>Your Full Name</label>
                <input type="text" name="full_name" placeholder="Type your name here" required>
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" placeholder="your@email.com" required>
            </div>
            <div class="form-group">
                <label>Mobile Number</label>
                <input type="tel" name="phone" placeholder="11-digit phone number" required pattern="[0-9]{11}">
            </div>
            <div class="form-group">
                <label>What crops or animals do you grow?</label>
                <input type="text" name="crops_animals" placeholder="Example: Rice, Vegetables, Cows, Goats" required>
            </div>
            <div class="form-group">
                <label>What help do you need?</label>
                <select name="help_needed" required>
                    <option value="">Choose one</option>
                    <option value="Modern farming advice">Modern farming advice</option>
                    <option value="Seeds or tools support">Seeds or tools support</option>
                    <option value="Loan or financial help">Loan or financial help</option>
                    <option value="All of the above">All of the above</option>
                </select>
            </div>
            <div class="form-group">
                <label>Which area/village are you from?</label>
                <input type="text" name="area_village" placeholder="Write your village or area name" required>
            </div>
            <button type="submit" class="primary-btn">Apply Now</button>
            <div class="thank-you-message" style="display: none;">
                Thank you for applying! Our team will contact you very soon.
            </div>
        </form>
    </div>
</div>

<div class="service-modal" id="treeForm">
    <div class="modal-content">
        <span class="close-modal">&times;</span>
        <h3>Tree Plantation Program</h3>
        <form class="service-form" data-service="tree_plantation">
            <div class="form-group">
                <label>Your Full Name</label>
                <input type="text" name="full_name" placeholder="Your name" required>
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" placeholder="your@email.com" required>
            </div>
            <div class="form-group">
                <label>Phone</label>
                <input type="tel" name="phone" placeholder="Your phone number" required>
            </div>
            <div class="form-group">
                <label>Preferred Location</label>
                <input type="text" name="location" placeholder="Area for tree plantation" required>
            </div>
            <div class="form-group">
                <label>Number of Trees</label>
                <input type="number" name="tree_count" placeholder="Estimated number of trees" min="1" required>
            </div>
            <button type="submit" class="primary-btn">Join Program</button>
            <div class="thank-you-message" style="display: none;">
                Thank you for joining our green initiative! We'll contact you soon.
            </div>
        </form>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
