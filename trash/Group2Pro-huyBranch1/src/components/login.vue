<script setup>
import { useRouter, useRoute } from 'vue-router'

const route = useRoute()
const router = useRouter()

const token = route.query.accessToken

if (token) {
  localStorage.setItem("accessToken", token)

  // Sau khi lưu token xong, redirect về trang cần (ví dụ: cart)
  router.replace('/cart')
}
</script>
