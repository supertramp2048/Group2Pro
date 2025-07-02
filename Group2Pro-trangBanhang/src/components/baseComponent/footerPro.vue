<template>
  <footer class="footer">
    <div class="footer-container">
      <!-- Thông tin công ty -->
      <div class="footer-section">
        <h3 class="footer-title">Thông tin công ty</h3>
        <div class="company-info">
          <p><strong>Công ty TNHH Thương mại Điện tử WHALER</strong></p>
          <p>
            <i class="fas fa-map-marker-alt"></i>
            Địa chỉ: 141 Chiến thắng - Tân Triều - Thanh Trì - Hà Nội
          </p>
          <p>
            <i class="fas fa-phone"></i>
            Điện thoại: +84 24 3999 9999
          </p>
          <p>
            <i class="fas fa-envelope"></i>
            Email: Group2.com.vn
          </p>
        </div>
      </div>

      <!-- Thông tin nhà phát triển -->
      <div class="footer-section">
        <h3 class="footer-title">Nhà phát triển</h3>
        <div class="developer-info">
          <p><strong>Nhóm phát triển Group2</strong></p>
          <p>
            <i class="fas fa-envelope"></i>
            Email: Group2@actvn.edu.vn
          </p>
          <p>
            <i class="fas fa-code"></i>
            Phát triển bởi Group2
          </p>
        </div>
      </div>

      <!-- Liên kết mạng xã hội -->
      <div class="footer-section">
        <h3 class="footer-title">Theo dõi chúng tôi</h3>
        <div class="social-links">
          <a href="https://www.facebook.com/long.nguyen.375517" class="social-link facebook" target="_blank" rel="noopener noreferrer">
            <i class="fab fa-facebook-f"></i>
            <span>Facebook</span>
          </a>
          <a href="https://www.instagram.com/jiyong.bgdrgn/" class="social-link instagram" target="_blank" rel="noopener noreferrer">
            <i class="fab fa-instagram"></i>
            <span>Instagram</span>
          </a>
          <a href="https://www.youtube.com/watch?v=k4V3Mo61fJM&list=RDk4V3Mo61fJM&start_radio=1" class="social-link youtube" target="_blank" rel="noopener noreferrer">
            <i class="fab fa-youtube"></i>
            <span>YouTube</span>
          </a>
          <a href="https://zalo.me/yourpage" class="social-link zalo" target="_blank" rel="noopener noreferrer">
            <i class="fas fa-comments"></i>
            <span>Zalo</span>
          </a>
        </div>
      </div>

      <!-- Liên kết hữu ích -->
      
    </div>

    <!-- Thông tin giấy phép và bản quyền -->
    <div class="footer-bottom">
      <div class="footer-container">
        <div class="license-info">
          <div class="license-section">
            <p><strong>Giấy phép kinh doanh:</strong> Số 0123456789 do Sở Kế hoạch và Đầu tư Hà Nội cấp ngày 01/01/2024</p>
            <p><strong>Mã số thuế:</strong> 0123456789</p>
          </div>
          <div class="copyright-section">
            <p>&copy; {{ currentYear }} Công ty TNHH Thương mại Điện tử WHALER. Tất cả quyền được bảo lưu.</p>
            <p>Phát triển bởi Group2</p>
          </div>
        </div>
      </div>
    </div>
  </footer>
</template>

<script>
export default {
  name: 'FooterComponent',
  data() {
    return {
      currentYear: new Date().getFullYear()
    };
  },
}
</script>

<style scoped>
.footer {
  background: linear-gradient(135deg, #151515 0%, #0e0e0e 100%);
  color: #ecf0f1;
  padding: 40px 0 0;
  margin-top: 30px;
}

.footer-container {
  max-width: 1200px;
  margin: 0 auto;
  padding: 0 20px;
}

.footer-section {
  display: flex;
  flex-direction: column;
  margin-bottom: 30px;
}

.footer-title {
  color: #3498db;
  font-size: 18px;
  font-weight: 600;
  margin-bottom: 15px;
  border-bottom: 2px solid #3498db;
  padding-bottom: 8px;
}

.company-info p,
.developer-info p {
  margin: 8px 0;
  display: flex;
  align-items: center;
  line-height: 1.6;
}

.company-info i,
.developer-info i {
  margin-right: 10px;
  color: #3498db;
  width: 16px;
}

.social-links {
  display: flex;
  flex-direction: column;
  gap: 12px;
}

.social-link {
  display: flex;
  align-items: center;
  color: #ecf0f1;
  text-decoration: none;
  padding: 8px 12px;
  border-radius: 6px;
  transition: all 0.3s ease;
  background: rgba(255, 255, 255, 0.1);
}

.social-link:hover {
  transform: translateX(5px);
  background: rgba(255, 255, 255, 0.2);
}

.social-link i {
  margin-right: 10px;
  font-size: 18px;
}

.social-link.facebook:hover {
  background: #1877f2;
}

.social-link.instagram:hover {
  background: linear-gradient(45deg, #405de6, #5851db, #833ab4, #c13584, #e1306c, #fd1d1d);
}

.social-link.youtube:hover {
  background: #ff0000;
}

.social-link.zalo:hover {
  background: #0068ff;
}

.useful-links {
  display: flex;
  flex-direction: column;
  gap: 8px;
}

.footer-link {
  color: #bdc3c7;
  text-decoration: none;
  padding: 5px 0;
  transition: color 0.3s ease;
  border-bottom: 1px solid transparent;
}

.footer-link:hover {
  color: #3498db;
  border-bottom-color: #3498db;
}

.footer-bottom {
  background: rgba(0, 0, 0, 0.3);
  margin-top: 30px;
  padding: 20px 0;
  border-top: 1px solid rgba(255, 255, 255, 0.1);
}

.license-info {
  text-align: center;
  font-size: 14px;
  line-height: 1.6;
}

.license-section {
  margin-bottom: 15px;
  color: #bdc3c7;
}

.copyright-section {
  color: #95a5a6;
}

.copyright-section p {
  margin: 5px 0;
}

/* Responsive Design */
@media (min-width: 768px) {
  .footer-container {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 30px;
  }
  
  .social-links {
    flex-direction: row;
    flex-wrap: wrap;
    gap: 10px;
  }
  
  .social-link {
    flex: 0 0 auto;
  }
}

@media (min-width: 1024px) {
  .footer-container {
    grid-template-columns: repeat(3, 1fr);
  }
  
  .license-info {
    display: flex;
    justify-content: space-between;
    align-items: center;
    text-align: left;
  }
  
  .copyright-section {
    text-align: right;
  }
}

@media (max-width: 767px) {
  .footer {
    padding: 30px 0 0;
  }
  
  .footer-container {
    padding: 0 15px;
  }
  
  .footer-title {
    font-size: 16px;
  }
  
  .social-links {
    flex-direction: row;
    flex-wrap: wrap;
    gap: 8px;
  }
  
  .social-link {
    flex: 1;
    min-width: calc(50% - 4px);
    justify-content: center;
  }
}
</style>