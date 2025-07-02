<template>
  <div>
    <headerPro></headerPro>
    <menuBar class="z-20"></menuBar>
    <section class="flex w-full lg:w-4/5 mx-auto px-2 lg:px-0">
      <!--Nội dung chính của web-->

      <article class="flex-1 w-full bg-white p-2 sm:p-4 lg:p-6">
        <!--Nội dung chính -->
        <div class="flex flex-col lg:flex-row">
          <aside class="w-2/6 hidden lg:block bg-transparent p-0 pr-0.5 rounded-2xl ">
            <router-link class="h-1/3" :to="{ name: 'productDetail', params: { id: 74 } }">
              <img src="/images/ads4.png" alt="" class="rounded-2xl object-cover" />
            </router-link>
            <router-link :to="{ name: 'productDetail', params: { id: 73 } }">
              <img
                src="/images/ads5.png"
                alt=""
                class="mt-1 rounded-2xl object-cover"
              />
            </router-link>
            <router-link class="h-1/3" :to="{ name: 'productDetail', params: { id: 73 } }">
              <img
                src="/images/ads5.png"
                alt=""
                class="mt-1 rounded-2xl object-cover"
              />
            </router-link>
          </aside>
          <carosel class="z-10"></carosel>
          <aside class="w-2/6 hidden lg:block bg-transparent p-0 pl-0.5">
            <router-link class="h-1/3" :to="{ name: 'productDetail', params: { id: 8 } }">
              <img
                src="/images/galaxyM55Ads.png"
                alt=""
                class="rounded-2xl  object-cover"
              />
            </router-link>
            <router-link class="h-1/3" :to="{ name: 'productDetail', params: { id: 73 } }">
              <img
                src="/images/ads5.png"
                alt=""
                class="mt-1 rounded-2xl object-cover"
              />
            </router-link>
            <router-link class="h-1/3" :to="{ name: 'productDetail', params: { id: 73 } }">
              <img
                src="/images/ads5.png"
                alt=""
                class="mt-1 rounded-2xl  object-cover"
              />
            </router-link>
          </aside>
        </div>

        <!-- Countdown Clock -->
        <div class="my-4">
          <cowndownClock></cowndownClock>
        </div>

        <!-- Special GIF -->
        <div class="my-4">
          <img
            src="/images/special.gif"
            alt="Special Offer"
            class="w-full h-auto rounded-lg"
          />
        </div>

        <div class="flex flex-col space-y-8">
          <!-- Điện thoại nổi bật -->
          <div
            class="bg-gradient-to-r from-red-700 to-red-800 rounded-xl shadow-lg overflow-hidden"
          >
            <div
              class="flex flex-col sm:flex-row items-center justify-between px-4 sm:px-6 py-4 bg-red-700 gap-2"
            >
              <h2
                class="text-xl sm:text-2xl lg:text-3xl font-bold uppercase text-white flex items-center"
              >
                <svg
                  class="w-6 h-6 sm:w-8 sm:h-8 mr-2 sm:mr-3 text-yellow-300"
                  fill="currentColor"
                  viewBox="0 0 20 20"
                >
                  <path
                    d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"
                  />
                </svg>
                Điện thoại nổi bật
              </h2>
              <router-link
                :to="{ name: 'allProducts', params: { categoryId: 1 } }"
                class="text-yellow-300 hover:text-yellow-100 font-semibold text-lg sm:text-xl transition-colors duration-300 flex items-center group"
              >
                Xem tất cả
                <svg
                  class="w-4 h-4 sm:w-5 sm:h-5 ml-2 group-hover:translate-x-1 transition-transform"
                  fill="none"
                  stroke="currentColor"
                  viewBox="0 0 24 24"
                >
                  <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M9 5l7 7-7 7"
                  ></path>
                </svg>
              </router-link>
            </div>

            <!-- Carousel cho điện thoại -->
            <div class="relative bg-white px-2 sm:px-4 py-4 sm:py-6">
              <!-- Nút điều hướng trái - Ẩn trên mobile -->
              <button
                @click="previousPhones"
                :disabled="phoneCurrentIndex === 0"
                class="absolute left-1 sm:left-2 top-1/2 transform -translate-y-1/2 z-10 bg-red-700 hover:bg-red-800 text-white shadow-xl rounded-full p-2 sm:p-3 transition-all duration-300 disabled:opacity-50 disabled:cursor-not-allowed disabled:bg-gray-400 hidden sm:block"
              >
                <svg
                  class="w-4 h-4 sm:w-6 sm:h-6"
                  fill="none"
                  stroke="currentColor"
                  viewBox="0 0 24 24"
                >
                  <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M15 19l-7-7 7-7"
                  ></path>
                </svg>
              </button>

              <!-- Container sản phẩm -->
              <div class="overflow-hidden mx-0 sm:mx-8 lg:mx-12">
                <div
                  class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-2 sm:gap-4 lg:gap-6 sm:flex sm:transition-transform sm:duration-500 sm:ease-in-out"
                  :class="{ 'sm:flex': true }"
                  :style="
                    window.innerWidth >= 640
                      ? {
                          transform: `translateX(-${
                            phoneCurrentIndex * (100 / getVisibleItems())
                          }%)`,
                        }
                      : {}
                  "
                >
                  <div
                    v-for="(product, index) in phoneProducts"
                    :key="product.id"
                    class="w-full sm:w-1/3 lg:w-1/4 xl:w-1/5 sm:flex-shrink-0"
                    :class="{
                      hidden:
                        window.innerWidth >= 640 &&
                        index >= getVisibleItems() + phoneCurrentIndex,
                    }"
                  >
                    <div
                      class="bg-white h-full border-2 border-red-100 hover:border-red-300 hover:shadow-2xl transform scale-100 hover:scale-105 shadow-lg rounded-xl p-3 sm:p-4 lg:p-6 transition-all duration-300 flex flex-col group"
                    >
                      <router-link
                        :to="{
                          name: 'productDetail',
                          params: { id: product.id },
                        }"
                        class="flex flex-col h-full"
                      >
                        <!-- Container hình ảnh với chiều cao cố định -->
                        <div
                          class="relative overflow-hidden rounded-lg mb-3 bg-gray-50 flex-shrink-0 "
                          style="height: 120px; sm:height: 150px; lg:height: 180px;"
                        >
                          <img
                            :src="product.src"
                            :alt="product.title"
                            class="max-w-full max-h-full mx-auto object-contain group-hover:scale-110 transition-transform duration-300"
                          />
                          <div
                            class="absolute top-1 right-1 sm:top-2 sm:right-2 bg-red-700 text-white text-xs px-1 sm:px-2 py-1 rounded-full font-bold"
                          >
                            HOT
                          </div>
                        </div>

                        <!-- Container nội dung với flex-grow để đẩy giá xuống dưới -->
                        <div class="flex flex-col flex-grow">
                          <!-- Tiêu đề sản phẩm -->
                          <p
                            class="text-sm sm:text-base lg:text-lg font-bold text-gray-800 mb-3 group-hover:text-red-700 transition-colors flex-grow line-clamp-2"
                          >
                            {{ product.title }}
                          </p>

                          <!-- Container giá - luôn ở dưới cùng -->
                          <div
                            class="bg-red-50 rounded-lg p-2 sm:p-3 border-l-4 border-red-700 mt-auto"
                          >
                            <span
                              v-if="product.price == 0"
                              class="text-red-700 text-sm sm:text-lg lg:text-xl font-bold"
                            >
                              Liên Hệ
                            </span>
                            <span
                              v-else-if="product.quantity == 0"
                              class="text-red-700 text-sm sm:text-lg lg:text-xl font-bold"
                            >
                              Hết hàng
                            </span>
                            <span
                              class="text-red-700 text-sm sm:text-lg lg:text-xl font-bold"
                              v-else
                            >
                              {{ formatPrice(product.price) }} VNĐ
                            </span>
                          </div>
                        </div>
                      </router-link>
                    </div>
                  </div>
                </div>
              </div>

              <!-- Nút điều hướng phải - Ẩn trên mobile -->
              <button
                @click="nextPhones"
                :disabled="
                  phoneCurrentIndex >= phoneProducts.length - getVisibleItems()
                "
                class="absolute right-1 sm:right-2 top-1/2 transform -translate-y-1/2 z-10 bg-red-700 hover:bg-red-800 text-white shadow-xl rounded-full p-2 sm:p-3 transition-all duration-300 disabled:opacity-50 disabled:cursor-not-allowed disabled:bg-gray-400 hidden sm:block"
              >
                <svg
                  class="w-4 h-4 sm:w-6 sm:h-6"
                  fill="none"
                  stroke="currentColor"
                  viewBox="0 0 24 24"
                >
                  <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M9 5l7 7-7 7"
                  ></path>
                </svg>
              </button>
            </div>
          </div>

          <!-- Laptop nổi bật -->
          <div
            class="bg-gradient-to-r from-red-700 to-red-800 rounded-xl shadow-lg overflow-hidden"
          >
            <div
              class="flex flex-col sm:flex-row items-center justify-between px-4 sm:px-6 py-4 bg-red-700 gap-2"
            >
              <h2
                class="text-xl sm:text-2xl lg:text-3xl font-bold uppercase text-white flex items-center"
              >
                <svg
                  class="w-6 h-6 sm:w-8 sm:h-8 mr-2 sm:mr-3 text-yellow-300"
                  fill="currentColor"
                  viewBox="0 0 20 20"
                >
                  <path
                    fill-rule="evenodd"
                    d="M3 5a2 2 0 012-2h10a2 2 0 012 2v8a2 2 0 01-2 2h-2.22l.123.489.804.804A1 1 0 0113 18H7a1 1 0 01-.707-1.707l.804-.804L7.22 15H5a2 2 0 01-2-2V5zm5.771 7H5V5h10v7H8.771z"
                    clip-rule="evenodd"
                  />
                </svg>
                Laptop nổi bật
              </h2>
              <router-link
                :to="{ name: 'allProducts', params: { categoryId: 2 } }"
                class="text-yellow-300 hover:text-yellow-100 font-semibold text-lg sm:text-xl transition-colors duration-300 flex items-center group"
              >
                Xem tất cả
                <svg
                  class="w-4 h-4 sm:w-5 sm:h-5 ml-2 group-hover:translate-x-1 transition-transform"
                  fill="none"
                  stroke="currentColor"
                  viewBox="0 0 24 24"
                >
                  <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M9 5l7 7-7 7"
                  ></path>
                </svg>
              </router-link>
            </div>

            <!-- Carousel cho laptop -->
            <div class="relative bg-white px-2 sm:px-4 py-4 sm:py-6">
              <!-- Nút điều hướng trái -->
              <button
                @click="previousLaptops"
                :disabled="laptopCurrentIndex === 0"
                class="absolute left-1 sm:left-2 top-1/2 transform -translate-y-1/2 z-10 bg-red-700 hover:bg-red-800 text-white shadow-xl rounded-full p-2 sm:p-3 transition-all duration-300 disabled:opacity-50 disabled:cursor-not-allowed disabled:bg-gray-400 hidden sm:block"
              >
                <svg
                  class="w-4 h-4 sm:w-6 sm:h-6"
                  fill="none"
                  stroke="currentColor"
                  viewBox="0 0 24 24"
                >
                  <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M15 19l-7-7 7-7"
                  ></path>
                </svg>
              </button>

              <!-- Container sản phẩm -->
              <div class="overflow-hidden mx-0 sm:mx-8 lg:mx-12">
                <div
                  class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-2 sm:gap-4 lg:gap-6 sm:flex sm:transition-transform sm:duration-500 sm:ease-in-out"
                  :style="
                    window.innerWidth >= 640
                      ? {
                          transform: `translateX(-${
                            laptopCurrentIndex * (100 / getVisibleItems())
                          }%)`,
                        }
                      : {}
                  "
                >
                  <div
                    v-for="(product, index) in laptopProducts"
                    :key="product.id"
                    class="w-full sm:w-1/3 lg:w-1/4 xl:w-1/5 sm:flex-shrink-0"
                  >
                    <div
                      class="bg-white h-full border-2 border-red-100 hover:border-red-300 hover:shadow-2xl transform scale-100 hover:scale-105 shadow-lg rounded-xl p-3 sm:p-4 lg:p-6 transition-all duration-300 flex flex-col group"
                    >
                      <router-link
                        :to="{
                          name: 'productDetail',
                          params: { id: product.id },
                        }"
                        class="flex flex-col h-full"
                      >
                        <div
                          class="relative overflow-hidden rounded-lg mb-3 bg-gray-50 flex-shrink-0"
                          style="height: 120px; sm:height: 150px; lg:height: 180px;"
                        >
                          <img
                            :src="product.src"
                            :alt="product.title"
                            class="max-w-full max-h-full mx-auto object-contain group-hover:scale-110 transition-transform duration-300"
                          />
                          <div
                            class="absolute top-1 right-1 sm:top-2 sm:right-2 bg-red-700 text-white text-xs px-1 sm:px-2 py-1 rounded-full font-bold"
                          >
                            HOT
                          </div>
                        </div>

                        <div class="flex flex-col flex-grow">
                          <p
                            class="text-sm sm:text-base lg:text-lg font-bold text-gray-800 mb-3 group-hover:text-red-700 transition-colors flex-grow line-clamp-2"
                          >
                            {{ product.title }}
                          </p>

                          <div
                            class="bg-red-50 rounded-lg p-2 sm:p-3 border-l-4 border-red-700 mt-auto"
                          >
                            <span
                              v-if="product.price == 0"
                              class="text-red-700 text-sm sm:text-lg lg:text-xl font-bold"
                            >
                              Liên Hệ
                            </span>
                            <span
                              v-else-if="product.quantity == 0"
                              class="text-red-700 text-sm sm:text-lg lg:text-xl font-bold"
                            >
                              Hết hàng
                            </span>
                            <span
                              class="text-red-700 text-sm sm:text-lg lg:text-xl font-bold"
                              v-else
                            >
                              {{ formatPrice(product.price) }} VNĐ
                            </span>
                          </div>
                        </div>
                      </router-link>
                    </div>
                  </div>
                </div>
              </div>

              <!-- Nút điều hướng phải -->
              <button
                @click="nextLaptops"
                :disabled="
                  laptopCurrentIndex >=
                  laptopProducts.length - getVisibleItems()
                "
                class="absolute right-1 sm:right-2 top-1/2 transform -translate-y-1/2 z-10 bg-red-700 hover:bg-red-800 text-white shadow-xl rounded-full p-2 sm:p-3 transition-all duration-300 disabled:opacity-50 disabled:cursor-not-allowed disabled:bg-gray-400 hidden sm:block"
              >
                <svg
                  class="w-4 h-4 sm:w-6 sm:h-6"
                  fill="none"
                  stroke="currentColor"
                  viewBox="0 0 24 24"
                >
                  <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M9 5l7 7-7 7"
                  ></path>
                </svg>
              </button>
            </div>
          </div>

          <!-- Camera nổi bật -->
          <div
            class="bg-gradient-to-r from-red-700 to-red-800 rounded-xl shadow-lg overflow-hidden"
          >
            <div
              class="flex flex-col sm:flex-row items-center justify-between px-4 sm:px-6 py-4 bg-red-700 gap-2"
            >
              <h2
                class="text-xl sm:text-2xl lg:text-3xl font-bold uppercase text-white flex items-center"
              >
                <svg
                  class="w-6 h-6 sm:w-8 sm:h-8 mr-2 sm:mr-3 text-yellow-300"
                  fill="currentColor"
                  viewBox="0 0 20 20"
                >
                  <path
                    fill-rule="evenodd"
                    d="M4 5a2 2 0 00-2 2v8a2 2 0 002 2h12a2 2 0 002-2V7a2 2 0 00-2-2h-1.586l-.707-.707A1 1 0 0013 4H7a1 1 0 00-.707.293L5.586 5H4zm6 9a3 3 0 100-6 3 3 0 000 6z"
                    clip-rule="evenodd"
                  />
                </svg>
                Camera nổi bật
              </h2>
              <router-link
                :to="{ name: 'allProducts', params: { categoryId: 3 } }"
                class="text-yellow-300 hover:text-yellow-100 font-semibold text-lg sm:text-xl transition-colors duration-300 flex items-center group"
              >
                Xem tất cả
                <svg
                  class="w-4 h-4 sm:w-5 sm:h-5 ml-2 group-hover:translate-x-1 transition-transform"
                  fill="none"
                  stroke="currentColor"
                  viewBox="0 0 24 24"
                >
                  <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M9 5l7 7-7 7"
                  ></path>
                </svg>
              </router-link>
            </div>

            <div class="relative bg-white px-2 sm:px-4 py-4 sm:py-6">
              <!-- Nút điều hướng trái -->
              <button
                @click="previousCams"
                :disabled="camCurrentIndex === 0"
                class="absolute left-1 sm:left-2 top-1/2 transform -translate-y-1/2 z-10 bg-red-700 hover:bg-red-800 text-white shadow-xl rounded-full p-2 sm:p-3 transition-all duration-300 disabled:opacity-50 disabled:cursor-not-allowed disabled:bg-gray-400 hidden sm:block"
              >
                <svg
                  class="w-4 h-4 sm:w-6 sm:h-6"
                  fill="none"
                  stroke="currentColor"
                  viewBox="0 0 24 24"
                >
                  <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M15 19l-7-7 7-7"
                  ></path>
                </svg>
              </button>

              <!-- Container sản phẩm -->
              <div class="overflow-hidden mx-0 sm:mx-8 lg:mx-12">
                <div
                  class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-2 sm:gap-4 lg:gap-6 sm:flex sm:transition-transform sm:duration-500 sm:ease-in-out"
                  :style="
                    window.innerWidth >= 640
                      ? {
                          transform: `translateX(-${
                            camCurrentIndex * (100 / getVisibleItems())
                          }%)`,
                        }
                      : {}
                  "
                >
                  <div
                    v-for="(product, index) in camProducts"
                    :key="product.id"
                    class="w-full sm:w-1/3 lg:w-1/4 xl:w-1/5 sm:flex-shrink-0"
                  >
                    <div
                      class="bg-white h-full border-2 border-red-100 hover:border-red-300 hover:shadow-2xl transform scale-100 hover:scale-105 shadow-lg rounded-xl p-3 sm:p-4 lg:p-6 transition-all duration-300 flex flex-col group"
                    >
                      <router-link
                        :to="{
                          name: 'productDetail',
                          params: { id: product.id },
                        }"
                        class="flex flex-col h-full"
                      >
                        <div
                          class="relative overflow-hidden rounded-lg mb-3 bg-gray-50 flex-shrink-0 "
                          style="height: 120px; sm:height: 150px; lg:height: 180px;"
                        >
                          <img
                            :src="product.src"
                            :alt="product.title"
                            class="max-w-full max-h-full mx-auto object-contain group-hover:scale-110 transition-transform duration-300"
                          />
                          <div
                            class="absolute top-1 right-1 sm:top-2 sm:right-2 bg-red-700 text-white text-xs px-1 sm:px-2 py-1 rounded-full font-bold"
                          >
                            HOT
                          </div>
                        </div>

                        <div class="flex flex-col flex-grow">
                          <p
                            class="text-sm sm:text-base lg:text-lg font-bold text-gray-800 mb-3 group-hover:text-red-700 transition-colors flex-grow line-clamp-2"
                          >
                            {{ product.title }}
                          </p>

                          <div
                            class="bg-red-50 rounded-lg p-2 sm:p-3 border-l-4 border-red-700 mt-auto"
                          >
                            <span
                              class="text-red-700 text-sm sm:text-lg lg:text-xl font-bold"
                              v-if="product.price === '0'"
                            >
                              Liên Hệ
                            </span>
                            <span
                              v-else-if="product.quantity == 0"
                              class="text-red-700 text-sm sm:text-lg lg:text-xl font-bold"
                            >
                              Hết hàng
                            </span>
                            <span
                              class="text-red-700 text-sm sm:text-lg lg:text-xl font-bold"
                              v-else
                            >
                              {{ formatPrice(product.price) }} VNĐ
                            </span>
                          </div>
                        </div>
                      </router-link>
                    </div>
                  </div>
                </div>
              </div>

              <!-- Nút điều hướng phải -->
              <button
                @click="nextCams"
                :disabled="
                  camCurrentIndex >= camProducts.length - getVisibleItems()
                "
                class="absolute right-1 sm:right-2 top-1/2 transform -translate-y-1/2 z-10 bg-red-700 hover:bg-red-800 text-white shadow-xl rounded-full p-2 sm:p-3 transition-all duration-300 disabled:opacity-50 disabled:cursor-not-allowed disabled:bg-gray-400 hidden sm:block"
              >
                <svg
                  class="w-4 h-4 sm:w-6 sm:h-6"
                  fill="none"
                  stroke="currentColor"
                  viewBox="0 0 24 24"
                >
                  <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    stroke-width="2"
                    d="M9 5l7 7-7 7"
                  ></path>
                </svg>
              </button>
            </div>
          </div>

          <!-- Các carousel bổ sung cho camera -->
          <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
            <cameraCarolsel :categoryId="3"></cameraCarolsel>
            <cameraCarolsel :categoryId="3"></cameraCarolsel>
          </div>

          <!-- Footer Ads -->
          <div class="space-y-4">
            <img
              src="/images/footerAds.png"
              class="w-full h-auto rounded-lg"
              alt="Footer Advertisement"
            />
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
              <img
                src="/images/footerAds3.png"
                class="w-full h-auto rounded-lg"
                alt="Footer Advertisement 3"
              />
              <img
                src="/images/footerAds2.png"
                class="w-full h-auto rounded-lg"
                alt="Footer Advertisement 2"
              />
            </div>
            <img
              src="/images/footerAds5.png"
              class="w-full h-auto rounded-lg"
              alt="Footer Advertisement 5"
            />
          </div>
        </div>
      </article>
    </section>
  </div>
</template>

<script>
import menuBar from "./baseComponent/menuBar.vue";
import carosel from "./baseComponent/carosel.vue";
import cameraCarolsel from "./baseComponent/cameraCarolsel.vue";
import cowndownClock from "./baseComponent/cowdownClock.vue";
import search from "./baseComponent/search.vue";
import headerPro from "./baseComponent/headerPro.vue";
import footerPro from "./baseComponent/footerPro.vue";
import useCartStore from "../stores/cartStore";

export default {
  components: {
    cameraCarolsel,
    menuBar,
    carosel,
    cowndownClock,
    search,
    headerPro,
    footerPro,
  },
  data() {
    return {
      allProducts: [],
      phoneProducts: [],
      laptopProducts: [],
      camProducts: [],
      cart: null,
      phoneCurrentIndex: 0,
      laptopCurrentIndex: 0,
      camCurrentIndex: 0,
      window: {
        innerWidth: window.innerWidth,
      },
    };
  },
  created() {
    this.cart = useCartStore();
    // Lắng nghe sự kiện resize window
    window.addEventListener("resize", this.handleResize);
  },
  beforeDestroy() {
    window.removeEventListener("resize", this.handleResize);
  },
  methods: {
    handleResize() {
      this.window.innerWidth = window.innerWidth;
    },

    getVisibleItems() {
      if (this.window.innerWidth >= 1280) return 5; // xl
      if (this.window.innerWidth >= 1024) return 4; // lg
      if (this.window.innerWidth >= 640) return 3; // sm
      return 2; // mobile
    },

    async loadProduct() {
      let res = await fetch("http://localhost:3000/API/index.php");
      this.allProducts = await res.json();
      console.log(localStorage.getItem("username"));
      this.phoneProducts = this.allProducts
        .filter((p) => p.category === 1)
        .slice(0, 15);
      this.laptopProducts = this.allProducts
        .filter((p) => p.category === 2)
        .slice(0, 15);
      this.camProducts = this.allProducts
        .filter((p) => p.category === 3)
        .slice(0, 15);
    },

    formatPrice(value) {
      if (typeof value !== "number") return "N/A";
      return value.toLocaleString("vi-VN");
    },

    addProduct(product) {
      this.cart.addToCart(product);
      console.log(this.cart.cart);
    },

    // Điều hướng cho điện thoại
    nextPhones() {
      const maxIndex = Math.max(
        0,
        this.phoneProducts.length - this.getVisibleItems()
      );
      if (this.phoneCurrentIndex < maxIndex) {
        this.phoneCurrentIndex++;
      }
    },

    previousPhones() {
      if (this.phoneCurrentIndex > 0) {
        this.phoneCurrentIndex--;
      }
    },

    // Điều hướng cho laptop
    nextLaptops() {
      const maxIndex = Math.max(
        0,
        this.laptopProducts.length - this.getVisibleItems()
      );
      if (this.laptopCurrentIndex < maxIndex) {
        this.laptopCurrentIndex++;
      }
    },

    previousLaptops() {
      if (this.laptopCurrentIndex > 0) {
        this.laptopCurrentIndex--;
      }
    },

    // Điều hướng camera
    nextCams() {
      const maxIndex = Math.max(
        0,
        this.camProducts.length - this.getVisibleItems()
      );
      if (this.camCurrentIndex < maxIndex) {
        this.camCurrentIndex++;
      }
    },

    previousCams() {
      if (this.camCurrentIndex > 0) {
        this.camCurrentIndex--;
      }
    },
  },

  mounted() {
    this.loadProduct();
  },
};
</script>

<style scoped>
/* Custom CSS để đảm bảo responsive tốt hơn */
.line-clamp-2 {
  display: -webkit-box;
  -webkit-line-clamp: 2;
  -webkit-box-orient: vertical;
  overflow: hidden;
}

/* Đảm bảo grid responsive hoạt động tốt */
@media (max-width: 639px) {
  .grid-cols-2 > * {
    min-height: 300px;
  }
}

@media (min-width: 640px) and (max-width: 1023px) {
  .sm:grid-cols-3 > * {
    min-height: 450px;
  }
}

@media (min-width: 1024px) {
  .lg:grid-cols-4 > *,
  .xl:grid-cols-5 > * {
    min-height: 500px;
  }
}

/* Hiệu ứng hover mượt mà hơn */
.group:hover .group-hover\:scale-110 {
  transform: scale(1.1);
}

.group:hover .group-hover\:text-red-700 {
  color: #b91c1c;
}

/* Đảm bảo nút navigation luôn ở vị trí phù hợp */
.absolute {
  z-index: 10;
}

/* Responsive cho các phần tử nhỏ */
@media (max-width: 480px) {
  .text-xl {
    font-size: 1.125rem;
  }

  .text-2xl {
    font-size: 1.25rem;
  }

  .text-3xl {
    font-size: 1.5rem;
  }
}

/* Đảm bảo hình ảnh không bị méo */
img {
  max-width: 100%;
  height: auto;
  object-fit: contain;
}

/* Flexbox layout cải tiến */
.flex-grow {
  flex-grow: 1;
}

.flex-shrink-0 {
  flex-shrink: 0;
}

/* Container sản phẩm với chiều cao đồng đều */
.product-container {
  display: flex;
  flex-direction: column;
  height: 100%;
}

.product-image-container {
  flex-shrink: 0;
}

.product-content {
  flex-grow: 1;
  display: flex;
  flex-direction: column;
}

.product-title {
  flex-grow: 1;
}

.product-price {
  margin-top: auto;
}
</style>