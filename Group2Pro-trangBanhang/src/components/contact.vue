<template>
  <section class="bg-red-50 dark:bg-slate-800" id="contact">
    <div class="mx-auto max-w-7xl px-4 py-16 sm:px-6 lg:px-8 lg:py-20">
      <div class="mb-4">
        <div class="mb-6 max-w-3xl text-center sm:text-center md:mx-auto md:mb-12">
          <p class="text-base font-semibold uppercase tracking-wide text-red-700 dark:text-red-300">
            Contact
          </p>
          <h2 class="font-heading mb-4 font-bold tracking-tight text-gray-900 dark:text-white text-3xl sm:text-5xl">
            Get in Touch
          </h2>
          <p class="mx-auto mt-4 max-w-3xl text-xl text-gray-600 dark:text-slate-400">
            Phản hồi trải nghiệm của bạn giúp chúng tôi cải thiện dịch vụ tốt hơn
          </p>
        </div>
      </div>

      <div class="flex items-stretch justify-center">
        <div class="grid md:grid-cols-2">
          <div class="h-full pr-6">
            <p class="mt-3 mb-12 text-lg text-gray-600 dark:text-slate-400">
              Mọi phản hồi xin gửi tới địa chỉ sau
            </p>
            <ul class="mb-6 md:mb-0">
              <li class="flex">
                <div class="flex h-10 w-10 items-center justify-center rounded bg-red-700 text-gray-50">
                  <i class="fa-solid fa-location-dot"></i>
                </div>
                <div class="ml-4 mb-4">
                  <h3 class="mb-2 text-lg font-medium leading-6 text-gray-900 dark:text-white">
                    Our Address
                  </h3>
                  <p class="text-gray-600 dark:text-slate-400">141 Chiến thắng - Tân Triều - Thanh Trì - Hà Nội</p>
                  <p class="text-gray-600 dark:text-slate-400">Việt Nam</p>
                </div>
              </li>

              <li class="flex">
                <div class="flex h-10 w-10 items-center justify-center rounded bg-red-700 text-gray-50">
                  <i class="fa-solid fa-phone"></i>
                </div>
                <div class="ml-4 mb-4">
                  <h3 class="mb-2 text-lg font-medium leading-6 text-gray-900 dark:text-white">Contact</h3>
                  <p class="text-gray-600 dark:text-slate-400">Mobile: +84 0123456789</p>
                  <p class="text-gray-600 dark:text-slate-400">Mail: Group2@gmail.com</p>
                </div>
              </li>

              <li class="flex">
                <div class="flex h-10 w-10 items-center justify-center rounded bg-red-700 text-gray-50">
                  <i class="fa-solid fa-clock"></i>
                </div>
                <div class="ml-4 mb-4">
                  <h3 class="mb-2 text-lg font-medium leading-6 text-gray-900 dark:text-white">Working hours</h3>
                  <p class="text-gray-600 dark:text-slate-400">Monday - Friday: 08:00 - 17:00</p>
                  <p class="text-gray-600 dark:text-slate-400">Saturday & Sunday: 08:00 - 12:00</p>
                </div>
              </li>
            </ul>
          </div>

          <div class="card h-fit max-w-6xl p-5 md:p-12" id="form">
            <h2 class="mb-4 text-2xl font-bold dark:text-white">Ready to Get Started?</h2>
            <form id="contactForm">
              <div class="mb-6">
                <div class="mx-0 mb-1 sm:mb-4">
                  <div class="mx-0 mb-1 sm:mb-4">
                    <input
                      type="text"
                      id="name"
                      autocomplete="given-name"
                      placeholder="Your name"
                      class="mb-2 w-full rounded-md border border-red-700 py-2 pl-2 pr-4 shadow-md dark:text-gray-300 sm:mb-0"
                      name="name"
                    />
                  </div>
                  <div class="mx-0 mb-1 sm:mb-4">
                    <input
                      type="email"
                      id="email"
                      autocomplete="email"
                      placeholder="Your email address"
                      class="mb-2 w-full rounded-md border border-red-700 py-2 pl-2 pr-4 shadow-md dark:text-gray-300 sm:mb-0"
                      name="email"
                    />
                  </div>
                </div>
                <div class="mx-0 mb-1 sm:mb-4">
                  <textarea
                    id="textarea"
                    name="textarea"
                    cols="30"
                    rows="5"
                    placeholder="Write your message..."
                    class="mb-2 w-full rounded-md border border-red-700 py-2 pl-2 pr-4 shadow-md dark:text-gray-300 sm:mb-0"
                  ></textarea>
                </div>
              </div>
              <div class="text-center">
                <button
                  type="submit"
                  class="w-full bg-red-700 hover:bg-red-600 text-white px-6 py-3 font-xl rounded-md transition-all duration-300"
                >
                  Send Message
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </section>
</template>

<script>
export default {};
</script>
