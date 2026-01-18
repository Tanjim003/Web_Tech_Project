    <footer>
        <div class="footer-content">
            <div class="footer-section">
                <h3>E-Welfare Bangladesh</h3>
                <p>Connecting communities through compassion and action across all 64 districts.</p>
                <div class="social-icons">
                    <a href="#"><i class="fab fa-facebook"></i></a>
                    <a href="#"><i class="fab fa-twitter"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                </div>
            </div>
            <div class="footer-section">
                <h3>Our Locations</h3>
                <ul>
                    <li><i class="fas fa-map-marker-alt"></i> Dhaka Head Office</li>
                    <li><i class="fas fa-map-marker-alt"></i> Chittagong Chapter</li>
                    <li><i class="fas fa-map-marker-alt"></i> Sylhet Volunteers</li>
                    <li><i class="fas fa-map-marker-alt"></i> Rajshahi Network</li>
                </ul>
            </div>
            <div class="footer-section">
                <h3>Contact Us</h3>
                <p><i class="fas fa-phone"></i> +880 2 9876543</p>
                <p><i class="fas fa-envelope"></i> info@ewelfare-bd.org</p>
                <p><i class="fas fa-clock"></i> Sun-Thu: 9AM-5PM</p>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; <?php echo date('Y'); ?> E-Welfare Bangladesh. All rights reserved.</p>
        </div>
    </footer>

    <?php if (isset($additionalJS)): ?>
        <?php foreach ($additionalJS as $js): ?>
            <script src="<?php echo $js; ?>"></script>
        <?php endforeach; ?>
    <?php endif; ?>
    <script src="navigation.js"></script>
</body>
</html>
