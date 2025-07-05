<template>
  <div class="company-page">
    <!-- Header -->
    <header class="header">
      <div class="container">
        <div class="nav">
          <div class="logo">
            <img src="https://images.unsplash.com/photo-1560472354-b33ff0c44a43?w=50&h=50&fit=crop&crop=center" alt="Whaler Logo" class="logo-img">
            <span class="logo-text">Whaler Technology</span>
          </div>
          
        </div>
      </div>
    </header>

    <!-- Hero Section -->
    <section class="hero-section">
      <div class="hero-background">
        <img src="https://images.unsplash.com/photo-1451187580459-43490279c0fa?w=1920&h=800&fit=crop" alt="Technology Background" class="hero-img">
        <div class="hero-overly"></div>
      </div>
      <div class="hero-content">
        <div class="container">
          <h1 class="hero-title">Whaler Technology</h1>
          <p class="hero-subtitle">Đối tác công nghệ đáng tin cậy - Kiến tạo tương lai số</p>
          <div class="hero-stats">
            <div class="stat-item">
              <div class="stat-number">15+</div>
              <div class="stat-label">Năm kinh nghiệm</div>
            </div>
            <div class="stat-item">
              <div class="stat-number">500+</div>
              <div class="stat-label">Dự án thành công</div>
            </div>
            <div class="stat-item">
              <div class="stat-number">200+</div>
              <div class="stat-label">Khách hàng tin tưởng</div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- About Section -->
    <section id="about" class="about-section">
      <div class="container">
        <div class="section-header">
          <h2 class="section-title">Về Whaler Technology</h2>
          <p class="section-subtitle">Chúng tôi là công ty hàng đầu trong lĩnh vực cung cấp giải pháp công nghệ</p>
        </div>
        
        <div class="about-content">
          <div class="about-text">
            <div class="about-card">
              <div class="card-icon">
                <i class="fas fa-bullseye"></i>
              </div>
              <h3>Sứ mệnh</h3>
              <p>Cung cấp các giải pháp công nghệ tiên tiến, giúp doanh nghiệp chuyển đổi số thành công và phát triển bền vững trong kỷ nguyên 4.0.</p>
            </div>
            
            <div class="about-card">
              <div class="card-icon">
                <i class="fas fa-eye"></i>
              </div>
              <h3>Tầm nhìn</h3>
              <p>Trở thành công ty công nghệ hàng đầu Việt Nam, được công nhận quốc tế về chất lượng dịch vụ và sản phẩm công nghệ.</p>
            </div>
            
            <div class="about-card">
              <div class="card-icon">
                <i class="fas fa-heart"></i>
              </div>
              <h3>Giá trị cốt lõi</h3>
              <p>Đổi mới - Chất lượng - Tận tâm - Minh bạch. Chúng tôi cam kết mang đến giá trị tốt nhất cho khách hàng và đối tác.</p>
            </div>
          </div>
          
          <div class="about-image">
            <img src="https://images.unsplash.com/photo-1552664730-d307ca884978?w=600&h=400&fit=crop" alt="Team Meeting" class="team-img">
          </div>
        </div>
      </div>
    </section>

    <!-- Business Areas Section -->
    <section class="business-areas">
      <div class="container">
        <div class="section-header">
          <h2 class="section-title">Lĩnh vực hoạt động</h2>
          <p class="section-subtitle">Chúng tôi hoạt động đa dạng trong nhiều lĩnh vực công nghệ</p>
        </div>
        
        <div class="areas-grid">
          <div class="area-card" v-for="area in businessAreas" :key="area.id">
            <div class="area-image">
              <img :src="area.image" :alt="area.title">
              <div class="area-overlay">
                <i :class="area.icon"></i>
              </div>
            </div>
            <div class="area-content">
              <h3>{{ area.title }}</h3>
              <p>{{ area.description }}</p>
              <ul class="area-features">
                <li v-for="feature in area.features" :key="feature">{{ feature }}</li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Services Section -->
    <section id="services" class="services-section">
      <div class="container">
        <div class="section-header">
          <h2 class="section-title">Dịch vụ cung cấp</h2>
          <p class="section-subtitle">Giải pháp toàn diện cho mọi nhu cầu công nghệ của doanh nghiệp</p>
        </div>
        
        <div class="services-grid">
          <div class="service-card" v-for="service in services" :key="service.id">
            <div class="service-icon">
              <i :class="service.icon"></i>
            </div>
            <h3>{{ service.title }}</h3>
            <p>{{ service.description }}</p>
            <div class="service-details">
              <h4>Bao gồm:</h4>
              <ul>
                <li v-for="detail in service.details" :key="detail">{{ detail }}</li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Achievements Section -->
    <section id="achievements" class="achievements-section">
      <div class="container">
        <div class="section-header">
          <h2 class="section-title">Chứng chỉ & Giải thưởng</h2>
          <p class="section-subtitle">Sự công nhận về chất lượng và uy tín của chúng tôi</p>
        </div>
        
        <!-- Certificates -->
        <div class="certificates-section">
          <h3 class="subsection-title">Chứng chỉ</h3>
          <div class="certificates-grid">
            <div class="certificate-card" v-for="cert in certificates" :key="cert.id">
              <div class="cert-image">
                <img :src="cert.image" :alt="cert.name">
              </div>
              <div class="cert-info">
                <h4>{{ cert.name }}</h4>
                <p class="cert-org">{{ cert.organization }}</p>
                <p class="cert-year">{{ cert.year }}</p>
                <p class="cert-desc">{{ cert.description }}</p>
              </div>
            </div>
          </div>
        </div>
        
        <!-- Awards -->
        <div class="awards-section">
          <h3 class="subsection-title">Giải thưởng</h3>
          <div class="awards-grid">
            <div class="award-card" v-for="award in awards" :key="award.id">
              <div class="award-icon">
                <i :class="award.icon"></i>
              </div>
              <div class="award-info">
                <h4>{{ award.title }}</h4>
                <p class="award-org">{{ award.organization }}</p>
                <p class="award-year">{{ award.year }}</p>
                <p class="award-desc">{{ award.description }}</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Partners Section -->
    <section class="partners-section">
      <div class="container">
        <div class="section-header">
          <h2 class="section-title">Đối tác chiến lược</h2>
          <p class="section-subtitle">Chúng tôi tự hào hợp tác cùng những thương hiệu hàng đầu</p>
        </div>
        
        <div class="partners-grid">
          <div class="partner-logo" v-for="partner in partners" :key="partner.id">
            <img :src="partner.logo" :alt="partner.name" :title="partner.name">
          </div>
        </div>
      </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="contact-section">
      <div class="container">
        <div class="contact-content">
          <div class="contact-info">
            <h2>Liên hệ với chúng tôi</h2>
            <p>Sẵn sàng đồng hành cùng doanh nghiệp của bạn</p>
            
            <div class="contact-details">
              <div class="contact-item">
                <i class="fas fa-map-marker-alt"></i>
                <div>
                  <h4>Địa chỉ</h4>
                  <p>Tầng 15, Tòa nhà ABC, 123 Đường XYZ<br>Quận 1, TP. Hồ Chí Minh</p>
                </div>
              </div>
              
              <div class="contact-item">
                <i class="fas fa-phone"></i>
                <div>
                  <h4>Điện thoại</h4>
                  <p>+84 28 1234 5678<br>+84 901 234 567</p>
                </div>
              </div>
              
              <div class="contact-item">
                <i class="fas fa-envelope"></i>
                <div>
                  <h4>Email</h4>
                  <p>info@whaler-tech.com<br>sales@whaler-tech.com</p>
                </div>
              </div>
              
              <div class="contact-item">
                <i class="fas fa-clock"></i>
                <div>
                  <h4>Giờ làm việc</h4>
                  <p>Thứ 2 - Thứ 6: 8:00 - 18:00<br>Thứ 7: 8:00 - 12:00</p>
                </div>
              </div>
            </div>
          </div>
          
          <div class="contact-image">
            <img src="https://images.unsplash.com/photo-1556761175-b413da4baf72?w=500&h=600&fit=crop" alt="Office Building">
          </div>
        </div>
      </div>
    </section>

    <!-- Footer -->
   
  </div>
</template>

<script>
export default {
  name: 'WhalerCompanyIntro',
  data() {
    return {
      businessAreas: [
        {
          id: 1,
          title: 'Phát triển phần mềm',
          description: 'Xây dựng các ứng dụng web, mobile và desktop chuyên nghiệp',
          icon: 'fas fa-code',
          image: 'https://images.unsplash.com/photo-1461749280684-dccba630e2f6?w=400&h=300&fit=crop',
          features: [
            'Web Application Development',
            'Mobile App Development',
            'Desktop Software',
            'API Integration'
          ]
        },
        {
          id: 2,
          title: 'Cloud Computing',
          description: 'Giải pháp điện toán đám mây an toàn và hiệu quả',
          icon: 'fas fa-cloud',
          image: 'https://images.unsplash.com/photo-1451187580459-43490279c0fa?w=400&h=300&fit=crop',
          features: [
            'Cloud Migration',
            'Infrastructure as Code',
            'DevOps Services',
            'Cloud Security'
          ]
        },
        {
          id: 3,
          title: 'Bảo mật thông tin',
          description: 'Bảo vệ dữ liệu và hệ thống với các giải pháp bảo mật tiên tiến',
          icon: 'fas fa-shield-alt',
          image: 'https://images.unsplash.com/photo-1550751827-4bd374c3f58b?w=400&h=300&fit=crop',
          features: [
            'Penetration Testing',
            'Security Audit',
            'Incident Response',
            'Compliance Consulting'
          ]
        },
        {
          id: 4,
          title: 'AI & Machine Learning',
          description: 'Ứng dụng trí tuệ nhân tạo để tự động hóa và tối ưu hóa quy trình',
          icon: 'fas fa-robot',
          image: 'https://images.unsplash.com/photo-1555255707-c07966088b7b?w=400&h=300&fit=crop',
          features: [
            'Predictive Analytics',
            'Natural Language Processing',
            'Computer Vision',
            'Deep Learning Solutions'
          ]
        }
      ],
      services: [
        {
          id: 1,
          title: 'Tư vấn IT',
          description: 'Tư vấn chiến lược công nghệ thông tin cho doanh nghiệp',
          icon: 'fas fa-lightbulb',
          details: [
            'Phân tích và đánh giá hệ thống hiện tại',
            'Xây dựng roadmap công nghệ',
            'Tư vấn chuyển đổi số',
            'Tối ưu hóa quy trình làm việc'
          ]
        },
        {
          id: 2,
          title: 'Phát triển ứng dụng',
          description: 'Thiết kế và phát triển ứng dụng theo yêu cầu riêng',
          icon: 'fas fa-mobile-alt',
          details: [
            'Ứng dụng web responsive',
            'Ứng dụng mobile iOS/Android',
            'Progressive Web Apps (PWA)',
            'Tích hợp API và dịch vụ bên thứ 3'
          ]
        },
        {
          id: 3,
          title: 'Hạ tầng IT',
          description: 'Thiết kế và triển khai hạ tầng công nghệ thông tin',
          icon: 'fas fa-server',
          details: [
            'Thiết kế kiến trúc hệ thống',
            'Triển khai server và network',
            'Backup và disaster recovery',
            'Monitoring và maintenance'
          ]
        },
        {
          id: 4,
          title: 'Đào tạo & Hỗ trợ',
          description: 'Đào tạo nhân sự và hỗ trợ kỹ thuật 24/7',
          icon: 'fas fa-graduation-cap',
          details: [
            'Đào tạo sử dụng phần mềm',
            'Workshop về công nghệ mới',
            'Hỗ trợ kỹ thuật 24/7',
            'Tài liệu hướng dẫn chi tiết'
          ]
        }
      ],
      certificates: [
        {
          id: 1,
          name: 'ISO 27001:2013',
          organization: 'International Organization for Standardization',
          year: '2023',
          description: 'Chứng chỉ quản lý bảo mật thông tin quốc tế',
          image: 'https://images.unsplash.com/photo-1554224155-8d04cb21cd6c?w=200&h=150&fit=crop'
        },
        {
          id: 2,
          name: 'CMMI Level 3',
          organization: 'CMMI Institute',
          year: '2022',
          description: 'Chứng chỉ về quy trình phát triển phần mềm',
          image: 'https://images.unsplash.com/photo-1586864387967-d02ef85d93e8?w=200&h=150&fit=crop'
        },
        {
          id: 3,
          name: 'AWS Partner',
          organization: 'Amazon Web Services',
          year: '2023',
          description: 'Đối tác chính thức của Amazon Web Services',
          image: 'https://images.unsplash.com/photo-1523474253046-8cd2748b5fd2?w=200&h=150&fit=crop'
        },
        {
          id: 4,
          name: 'Microsoft Gold Partner',
          organization: 'Microsoft Corporation',
          year: '2023',
          description: 'Đối tác vàng của Microsoft',
          image: 'https://images.unsplash.com/photo-1633356122544-f134324a6cee?w=200&h=150&fit=crop'
        }
      ],
      awards: [
        {
          id: 1,
          title: 'Sao Khuê 2023',
          organization: 'Hiệp hội Phần mềm và Dịch vụ CNTT Việt Nam',
          year: '2023',
          description: 'Giải thưởng cho sản phẩm phần mềm xuất sắc',
          icon: 'fas fa-trophy text-yellow-500'
        },
        {
          id: 2,
          title: 'Top 10 ICT Company',
          organization: 'Vietnam Report',
          year: '2023',
          description: 'Top 10 công ty ICT uy tín nhất Việt Nam',
          icon: 'fas fa-medal text-blue-500'
        },
        {
          id: 3,
          title: 'Innovation Award',
          organization: 'Vietnam Tech Awards',
          year: '2022',
          description: 'Giải thưởng đổi mới sáng tạo công nghệ',
          icon: 'fas fa-lightbulb text-purple-500'
        },
        {
          id: 4,
          title: 'Best Employer',
          organization: 'Great Place to Work',
          year: '2023',
          description: 'Môi trường làm việc tốt nhất trong ngành IT',
          icon: 'fas fa-users text-green-500'
        }
      ],
      partners: [
        {
          id: 1,
          name: 'Microsoft',
          logo: 'https://images.unsplash.com/photo-1633356122544-f134324a6cee?w=120&h=60&fit=crop'
        },
        {
          id: 2,
          name: 'Amazon AWS',
          logo: 'https://images.unsplash.com/photo-1523474253046-8cd2748b5fd2?w=120&h=60&fit=crop'
        },
        {
          id: 3,
          name: 'Google Cloud',
          logo: 'https://images.unsplash.com/photo-1573804633927-bfcbcd909acd?w=120&h=60&fit=crop'
        },
        {
          id: 4,
          name: 'Oracle',
          logo: 'https://images.unsplash.com/photo-1611224923853-80b023f02d71?w=120&h=60&fit=crop'
        },
        {
          id: 5,
          name: 'IBM',
          logo: 'https://images.unsplash.com/photo-1599305445671-ac291c95aaa9?w=120&h=60&fit=crop'
        },
        {
          id: 6,
          name: 'Salesforce',
          logo: 'https://images.unsplash.com/photo-1614680376573-df3480f0c6ff?w=120&h=60&fit=crop'
        }
      ]
    }
  }
}
</script>

<style scoped>
* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}

.company-page {
  font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
  line-height: 1.6;
  color: #333;
}

.container {
  max-width: 1200px;
  margin: 0 auto;
  padding: 0 20px;
}

/* Header */
.header {
  background: white;
  box-shadow: 0 2px 20px rgba(0,0,0,0.1);
  position: fixed;
  top: 0;
  left: 0;
  right: 0;
  z-index: 1000;
}

.nav {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 1rem 0;
}

.logo {
  display: flex;
  align-items: center;
  font-size: 1.5rem;
  font-weight: bold;
  color: #2563eb;
}

.logo-img {
  width: 40px;
  height: 40px;
  border-radius: 8px;
  margin-right: 0.75rem;
}

.navigation {
  display: flex;
  gap: 2rem;
}

.nav-link {
  text-decoration: none;
  color: #333;
  font-weight: 500;
  transition: color 0.3s;
  position: relative;
}

.nav-link:hover {
  color: #2563eb;
}

.nav-link::after {
  content: '';
  position: absolute;
  bottom: -5px;
  left: 0;
  width: 0;
  height: 2px;
  background: #2563eb;
  transition: width 0.3s;
}

.nav-link:hover::after {
  width: 100%;
}

/* Hero Section */
.hero-section {
  position: relative;
  height: 100vh;
  display: flex;
  align-items: center;
  justify-content: center;
  color: white;
  text-align: center;
  overflow: hidden;
}

.hero-background {
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  z-index: -2;
}

.hero-img {
  width: 100%;
  height: 100%;
  object-fit: cover;
}

.hero-overlay {
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background: linear-gradient(135deg, rgba(37, 99, 235, 0.8), rgba(139, 69, 19, 0.6));
  z-index: -1;
}

.hero-content {
  z-index: 1;
}

.hero-title {
  font-size: 4rem;
  font-weight: bold;
  margin-bottom: 1rem;
  text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
}

.hero-subtitle {
  font-size: 1.5rem;
  margin-bottom: 3rem;
  opacity: 0.9;
}

.hero-stats {
  display: flex;
  justify-content: center;
  gap: 4rem;
}

.stat-item {
  text-align: center;
}

.stat-number {
  font-size: 3rem;
  font-weight: bold;
  color: #fbbf24;
}

.stat-label {
  font-size: 1.1rem;
  opacity: 0.9;
}

/* Section Common Styles */
.section-header {
  text-align: center;
  margin-bottom: 4rem;
}

.section-title {
  font-size: 2.5rem;
  font-weight: bold;
  color: #1f2937;
  margin-bottom: 1rem;
}

.section-subtitle {
  font-size: 1.2rem;
  color: #6b7280;
  max-width: 600px;
  margin: 0 auto;
}

/* About Section */
.about-section {
  padding: 6rem 0;
  background: #f8fafc;
}

.about-content {
  display: grid;
  grid-template-columns: 2fr 1fr;
  gap: 4rem;
  align-items: center;
}

.about-card {
  background: white;
  padding: 2rem;
  border-radius: 12px;
  box-shadow: 0 4px 20px rgba(0,0,0,0.05);
  margin-bottom: 2rem;
  transition: transform 0.3s;
}

.about-card:hover {
  transform: translateY(-5px);
}

.card-icon {
  width: 60px;
  height: 60px;
  background: linear-gradient(135deg, #2563eb, #1d4ed8);
  border-radius: 12px;
  display: flex;
  align-items: center;
  justify-content: center;
  margin-bottom: 1rem;
}

.card-icon i {
  font-size: 1.5rem;
  color: white;
}

.about-card h3 {
  font-size: 1.5rem;
  font-weight: bold;
  color: #1f2937;
  margin-bottom: 1rem;
}

.about-card p {
  color: #6b7280;
  line-height: 1.6;
}

.team-img {
  width: 100%;
  border-radius: 12px;
  box-shadow: 0 10px 30px rgba(0,0,0,0.1);
}

/* Business Areas Section */
.business-areas {
  padding: 6rem 0;
}

.areas-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
  gap: 2rem;
}

.area-card {
  background: white;
  border-radius: 12px;
  overflow: hidden;
  box-shadow: 0 4px 20px
}
</style>