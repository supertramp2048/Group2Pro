<template>
  <div class="consultation-page">
    <div class="header">
      <h1>Dịch vụ tư vấn mua hàng</h1>
      <p>Đội ngũ chuyên gia của chúng tôi sẵn sàng hỗ trợ bạn chọn sản phẩm phù hợp nhất</p>
    </div>

    <div class="consultation-form">
      <div class="form-section">
        <h2>Thông tin khách hàng</h2>
        <div class="form-group">
          <label for="name">Họ và tên*</label>
          <input type="text" id="name" v-model="formData.name" placeholder="Nhập họ và tên">
        </div>
        
        <div class="form-group">
          <label for="phone">Số điện thoại*</label>
          <input type="tel" id="phone" v-model="formData.phone" placeholder="Nhập số điện thoại">
        </div>
        
        <div class="form-group">
          <label for="email">Email</label>
          <input type="email" id="email" v-model="formData.email" placeholder="Nhập email">
        </div>
      </div>

      <div class="form-section">
        <h2>Nhu cầu mua sắm</h2>
        
        <div class="form-group">
          <label>Danh mục sản phẩm quan tâm*</label>
          <div class="checkbox-group">
            <label><input type="checkbox" v-model="formData.categories" value="laptop"> Laptop/Máy tính xách tay</label>
            <label><input type="checkbox" v-model="formData.categories" value="smartphone"> Điện thoại thông minh</label>
            <label><input type="checkbox" v-model="formData.categories" value="tablet"> Máy tính bảng</label>
            <label><input type="checkbox" v-model="formData.categories" value="pc"> PC/Máy tính để bàn</label>
            <label><input type="checkbox" v-model="formData.categories" value="accessories"> Phụ kiện</label>
          </div>
        </div>
        
        <div class="form-group">
          <label for="budget">Mức ngân sách (VND)</label>
          <select id="budget" v-model="formData.budget">
            <option value="">Chọn mức ngân sách</option>
            <option value="under5">Dưới 5 triệu</option>
            <option value="5-10">5 - 10 triệu</option>
            <option value="10-20">10 - 20 triệu</option>
            <option value="20-30">20 - 30 triệu</option>
            <option value="over30">Trên 30 triệu</option>
          </select>
        </div>
        
        <div class="form-group">
          <label for="purpose">Mục đích sử dụng*</label>
          <textarea id="purpose" v-model="formData.purpose" placeholder="Ví dụ: Làm việc văn phòng, chơi game, đồ họa, học tập..."></textarea>
        </div>
        
        <div class="form-group">
          <label for="otherRequirements">Yêu cầu khác</label>
          <textarea id="otherRequirements" v-model="formData.otherRequirements" placeholder="Các yêu cầu đặc biệt khác..."></textarea>
        </div>
      </div>

      <div class="form-actions">
        <button class="submit-btn" @click="submitForm">Gửi yêu cầu tư vấn</button>
        <p class="note">* Thông tin bắt buộc</p>
      </div>
    </div>

    <div class="contact-info">
      <h3>Hoặc liên hệ trực tiếp</h3>
      <p><i class="fas fa-phone"></i> Hotline: 1900 1234</p>
      <p><i class="fas fa-envelope"></i> Email: support@company.com</p>
      <p><i class="fas fa-clock"></i> Giờ làm việc: 8:00 - 22:00 hàng ngày</p>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      formData: {
        name: '',
        phone: '',
        email: '',
        categories: [],
        budget: '',
        purpose: '',
        otherRequirements: ''
      }
    }
  },
  methods: {
    submitForm() {
      // Validate form
      if (!this.formData.name || !this.formData.phone || !this.formData.categories.length || !this.formData.purpose) {
        alert('Vui lòng điền đầy đủ các thông tin bắt buộc');
        return;
      }

      // Here you would typically send the data to your backend
      console.log('Form submitted:', this.formData);
      
      // Show success message
      alert('Cảm ơn bạn đã gửi yêu cầu! Chúng tôi sẽ liên hệ với bạn trong thời gian sớm nhất.');
      
      // Reset form
      this.resetForm();
    },
    resetForm() {
      this.formData = {
        name: '',
        phone: '',
        email: '',
        categories: [],
        budget: '',
        purpose: '',
        otherRequirements: ''
      };
    }
  }
}
</script>

<style scoped>
.consultation-page {
  max-width: 800px;
  margin: 0 auto;
  padding: 20px;
  font-family: 'Arial', sans-serif;
}

.header {
  text-align: center;
  margin-bottom: 30px;
}

.header h1 {
  color: #2c3e50;
  font-size: 28px;
}

.form-section {
  background: #f9f9f9;
  padding: 20px;
  border-radius: 8px;
  margin-bottom: 20px;
}

.form-section h2 {
  color: #3498db;
  font-size: 20px;
  margin-top: 0;
  margin-bottom: 20px;
}

.form-group {
  margin-bottom: 15px;
}

.form-group label {
  display: block;
  margin-bottom: 5px;
  font-weight: bold;
}

.form-group input[type="text"],
.form-group input[type="tel"],
.form-group input[type="email"],
.form-group select,
.form-group textarea {
  width: 100%;
  padding: 10px;
  border: 1px solid #ddd;
  border-radius: 4px;
  font-size: 16px;
}

.form-group textarea {
  height: 100px;
}

.checkbox-group {
  display: flex;
  flex-direction: column;
}

.checkbox-group label {
  display: flex;
  align-items: center;
  margin-bottom: 8px;
  font-weight: normal;
}

.checkbox-group input {
  margin-right: 10px;
}

.form-actions {
  text-align: center;
}

.submit-btn {
  background-color: #3498db;
  color: white;
  border: none;
  padding: 12px 25px;
  font-size: 16px;
  border-radius: 4px;
  cursor: pointer;
  transition: background-color 0.3s;
}

.submit-btn:hover {
  background-color: #2980b9;
}

.note {
  font-size: 14px;
  color: #7f8c8d;
  margin-top: 10px;
}

.contact-info {
  margin-top: 40px;
  text-align: center;
  padding: 20px;
  background: #f0f8ff;
  border-radius: 8px;
}

.contact-info h3 {
  color: #2c3e50;
  margin-top: 0;
}

.contact-info p {
  margin: 10px 0;
}

.contact-info i {
  margin-right: 10px;
  color: #3498db;
}

@media (max-width: 600px) {
  .consultation-page {
    padding: 10px;
  }
  
  .header h1 {
    font-size: 24px;
  }
}
</style>