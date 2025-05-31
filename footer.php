<footer class="footer"> 
  <div class="footer-container">

    <!-- Contact Us -->
    <div class="footer-column contact-info">
      <h3>Contact Us</h3>
      <ul class="contact-list">
        <li><i class="fas fa-map-marker-alt"></i> Sir Calachi Road Jampur</li>
        <li><i class="fas fa-envelope"></i> <a href="mailto:info@alibabaclothhouseonline.com">info@alibabaclothhouseonline.com</a></li>
        <li><i class="fas fa-phone"></i> +92 317 6450772</li>
      </ul>
    </div>

    <!-- Information -->
    <div class="footer-column">
      <h3>Information</h3>
      <ul>
        <li><a href="#">About Us</a></li>
        <li><a href="#">Privacy Policy</a></li>
        <li><a href="#">Terms & Conditions</a></li>
      </ul>
    </div>

    <!-- Customer Services -->
    <div class="footer-column">
      <h3>Customer Services</h3>
      <ul>
        <li><a href="#">Contact Us</a></li>
        <li><a href="#">Return & Exchange Policy</a></li>
      </ul>
    </div>

    <!-- Newsletter -->
    <div class="footer-column">
      <h3>Newsletter Signup</h3>
      <p>Subscribe to our newsletter and get the latest updates.</p>
      <form action="suscribers.php" method="POST" class="subscribe-form">
        <input type="email" name="email" placeholder="Your email address" required>
        <button type="submit">Subscribe</button>
      </form>
      <?php if (isset($_GET['subscribed'])): ?>
        <p class="success-message">Thank you for subscribing!</p>
      <?php endif; ?>
      <div class="social-icons">
        <a href="https://facebook.com/alibabaclothhouse" target="_blank" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
        <a href="https://instagram.com/alibabaclothhouse" target="_blank" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
        <a href="https://wa.me/923176450772" target="_blank" aria-label="WhatsApp"><i class="fab fa-whatsapp"></i></a>
      </div>
    </div>

  </div>

  <!-- Copyright -->
  <div class="footer-bottom">
    &copy; 2025 Alibaba Cloth House. All rights reserved.
  </div>
</footer>
