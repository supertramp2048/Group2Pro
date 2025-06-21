<script setup>
import { useRouter, useRoute } from 'vue-router'
import { computed } from 'vue';
import { useUserStore } from '../stores/user';

const route = useRoute()
const router = useRouter()

const token = route.query.accessToken

const userStore = useUserStore();

if (token) {
  localStorage.setItem("accessToken", token)

  // Sau khi lưu token xong, redirect về trang cần
  router.replace('/')
}
</script>
